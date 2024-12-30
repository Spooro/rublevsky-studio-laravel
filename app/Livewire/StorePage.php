<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Traits\WithCartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\ProductVariation;
use Illuminate\View\View;

#[Title('Rublevsky Store')]
class StorePage extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithCartManagement;

    public $title = "Store | Rublevsky Studio";
    public $metaDescription = "Shop our collection of unique designs, prints, and merchandise. Find original artwork, photography prints, and custom-designed products by Rublevsky Studio.";

    #[Url(as: 'categories')]
    public $selected_categories = '';

    #[Url]
    public $price_range = null;

    #[Url]
    public $sort = 'relevant';

    public $sortOptions = [
        'relevant' => 'Sort by relevant',
        'latest' => 'Sort by latest',
        'price_asc' => 'Price: Low to High',
        'price_desc' => 'Price: High to Low',
    ];

    public $max_price;
    public $products;
    public $selectedVariations = [];

    public function mount()
    {
        // Find the highest price among regular products and variations
        $this->max_price = max(
            Product::where('is_active', 1)
                ->where('has_variations', false)
                ->max('price'),
            ProductVariation::whereHas('product', function ($query) {
                $query->where('is_active', 1);
            })->max('price')
        );

        // Initialize price_range to max_price if not set
        if (!$this->price_range) {
            $this->price_range = $this->max_price;
        }

        $this->refreshProducts();
    }

    public function selectVariation($product_id, $attributeName, $attributeValue)
    {
        $product = $this->products->firstWhere('id', $product_id);
        if (!$product || !$product->variations) return;

        $currentVariation = $this->getSelectedVariation($product);

        // Get the current product type (if set)
        $currentProductType = $currentVariation
            ? $currentVariation->attributes->firstWhere('name', 'apparel_type')?->value
            : null;

        // Try to find a variation that matches the selected attribute and keeps the current product type
        $newVariation = $product->variations
            ->first(function ($variation) use ($attributeName, $attributeValue, $currentProductType) {
                $matchesAttribute = $variation->attributes
                    ->where('name', $attributeName)
                    ->where('value', $attributeValue)
                    ->isNotEmpty();

                $matchesProductType = $currentProductType
                    ? $variation->attributes
                    ->where('name', 'apparel_type')
                    ->where('value', $currentProductType)
                    ->isNotEmpty()
                    : true;

                return $matchesAttribute && $matchesProductType;
            });

        // If no matching variation found with the current product type, find any variation that matches the selected attribute
        if (!$newVariation) {
            $newVariation = $product->variations
                ->first(function ($variation) use ($attributeName, $attributeValue) {
                    return $variation->attributes
                        ->where('name', $attributeName)
                        ->where('value', $attributeValue)
                        ->isNotEmpty();
                });
        }

        if ($newVariation) {
            $this->selectedVariations[$product_id] = $newVariation->id;
        }
    }

    public function getSelectedVariation($product)
    {
        if (!isset($this->selectedVariations[$product->id])) {
            // Find first available variation
            $firstAvailable = $product->variations->first(function ($variation) use ($product) {
                return $this->isVariationAvailable($product, $variation);
            });

            if ($firstAvailable) {
                $this->selectedVariations[$product->id] = $firstAvailable->id;
            }
        }

        return $product->variations->firstWhere('id', $this->selectedVariations[$product->id] ?? null);
    }

    public function getAvailableStock($product)
    {
        if ($product->unlimited_stock) {
            return PHP_INT_MAX;
        }

        if ($product->has_variations) {
            $variation = $this->getSelectedVariation($product);
            if ($variation) {
                return CartManagement::getAvailableQuantity($product, $variation);
            }
            return 0;
        }

        return CartManagement::getAvailableQuantity($product, null);
    }

    public function canAddToCart($product)
    {
        if (!$product->has_variations) {
            return CartManagement::getAvailableQuantity($product, null) > 0;
        }

        $variation = $this->getSelectedVariation($product);
        if (!$variation) {
            return false;
        }

        return CartManagement::getAvailableQuantity($product, $variation) > 0;
    }

    public function addToCart($product_id)
    {
        $product = $this->products->firstWhere('id', $product_id);
        if (!$product) return;

        if ($product->has_variations) {
            $variation = $this->getSelectedVariation($product);
            if (!$variation) {
                $this->alert('error', 'Please select a variation', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return;
            }

            if (!$this->isVariationAvailable($product, $variation)) {
                $this->alert('error', 'Selected variation is not available', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return;
            }

            $total_count = CartManagement::addVariationToCartWithQuantity(
                $product_id,
                $variation->id,
                1
            );
        } else {
            if (CartManagement::getAvailableQuantity($product, null) <= 0) {
                $this->alert('error', 'Product is out of stock', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return;
            }

            $total_count = CartManagement::addItemToCartWithQuantity($product_id, 1);
        }

        $this->dispatch('update-cart-count', total_count: $total_count)->to('App\Livewire\Partials\Navbar');
        $this->dispatch('cart-updated');
        $this->refreshProducts();

        $this->alert('success', 'Product added to cart', [
            'position' => 'bottom-end',
            'timer' => 2000,
            'toast' => true,
        ]);
    }

    public function refreshProducts()
    {
        // Start with base query
        $productQuery = Product::query()
            ->where('is_active', 1)
            ->where('coming_soon', false)
            ->with([
                'variations' => function ($query) {
                    $query->orderBy('sort');
                },
                'variations.attributes'
            ]);

        // Apply category filter
        if ($this->selected_categories) {
            $categoryIds = Category::whereIn('slug', explode(',', $this->selected_categories))
                ->pluck('id')
                ->toArray();
            $productQuery->whereIn('category_id', $categoryIds);
        }

        // Apply price range filter
        if ($this->price_range !== null) {
            $productQuery->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('has_variations', false)
                        ->where('price', '<=', $this->price_range);
                })->orWhere(function ($q) {
                    $q->where('has_variations', true)
                        ->whereHas('variations', function ($subQ) {
                            $subQ->where('price', '<=', $this->price_range);
                        });
                });
            });
        }

        // Apply sorting
        switch ($this->sort) {
            case 'relevant':
                $productQuery->orderByRaw('CASE
                    WHEN is_featured = 1 THEN 0
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Apparel" LIMIT 1) THEN 1
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Posters" LIMIT 1) THEN 2
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Produce" LIMIT 1) THEN 3
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Tea" LIMIT 1) THEN 4
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Stickers" LIMIT 1) THEN 5
                    ELSE 6 END');
                break;
            case 'latest':
                $productQuery->latest();
                break;
            case 'price_asc':
                $minPriceSubquery = ProductVariation::selectRaw('MIN(price)')
                    ->whereColumn('product_variations.product_id', 'products.id')
                    ->limit(1);

                $productQuery->select('products.*')
                    ->selectSub($minPriceSubquery, 'min_variation_price')
                    ->orderByRaw('
                        CASE
                            WHEN has_variations = 1 THEN (
                                SELECT MIN(price)
                                FROM product_variations
                                WHERE product_variations.product_id = products.id
                            )
                            ELSE price
                        END ASC
                    ');
                break;
            case 'price_desc':
                $minPriceSubquery = ProductVariation::selectRaw('MIN(price)')
                    ->whereColumn('product_variations.product_id', 'products.id')
                    ->limit(1);

                $productQuery->select('products.*')
                    ->selectSub($minPriceSubquery, 'min_variation_price')
                    ->orderByRaw('
                        CASE
                            WHEN has_variations = 1 THEN (
                                SELECT MIN(price)
                                FROM product_variations
                                WHERE product_variations.product_id = products.id
                            )
                            ELSE price
                        END DESC
                    ');
                break;
        }

        $this->products = $productQuery->get();
    }

    public function render(): View
    {
        return view('livewire.store-page', [
            'title' => $this->title,
            'metaDescription' => $this->metaDescription,
            'products' => $this->products,
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug'])
        ]);
    }
}
