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
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\ProductVariation;
use Illuminate\View\View;

#[Title('Rublevsky Store')]
class StorePage extends Component
{
    use LivewireAlert;
    use WithPagination;

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
    }

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($product->has_variations) {
            $variation = $product->variations()
                ->when(!$product->unlimited_stock, fn($query) => $query->where('stock', '>', 0))
                ->orderBy('price')
                ->first();

            if ($variation) {
                $total_count = CartManagement::addVariationToCartWithQuantity($product_id, $variation->id, 1);
            } else {
                $this->alert('error', 'No available variations for this product');
                return;
            }
        } else {
            $total_count = CartManagement::addItemToCart($product_id);
        }

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Product added to cart', [
            'position' => 'bottom-end',
            'timer' => 2000,
            'toast' => true,
            'text' => 'Product added to cart',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render(): View
    {
        $productQuery = Product::query()->where('is_active', 1)
            ->with(['variations' => function ($query) {
                $query->orderBy('price', 'asc')->limit(1);
            }]);

        if ($this->selected_categories) {
            $categoryIds = Category::whereIn('slug', explode(',', $this->selected_categories))
                ->pluck('id')
                ->toArray();
            $productQuery->whereIn('category_id', $categoryIds);
        }

        if ($this->price_range !== null) {
            $productQuery->where(function ($query) {
                $query->where(function ($q) {
                    // For products without variations, check the base price
                    $q->where('has_variations', false)
                        ->where('price', '<=', $this->price_range);
                })->orWhere(function ($q) {
                    // For products with variations, check the minimum variation price
                    $q->where('has_variations', true)
                        ->whereHas('variations', function ($subQ) {
                            $subQ->where('price', '<=', $this->price_range);
                        });
                });
            });
        }

        switch ($this->sort) {
            case 'relevant':
                $productQuery->orderByRaw('CASE
                    WHEN is_featured = 1 THEN 0
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Apparel" LIMIT 1) THEN 1
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Posters" LIMIT 1) THEN 2
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Produce" LIMIT 1) THEN 3
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Stickers" LIMIT 1) THEN 4
                    WHEN category_id = (SELECT id FROM categories WHERE name = "Tea" LIMIT 1) THEN 5
                    ELSE 5 END');
                break;
            case 'latest':
                $productQuery->latest();
                break;
            case 'price_asc':
                $productQuery->where(function ($query) {
                    $query->whereNull('has_variations')
                        ->orWhere('has_variations', false);
                })->orderBy('price', 'asc')
                    ->union(
                        Product::where('has_variations', true)
                            ->whereHas('variations')
                            ->select('products.*')
                            ->join('product_variations', 'products.id', '=', 'product_variations.product_id')
                            ->orderBy('product_variations.price', 'asc')
                    );
                break;
            case 'price_desc':
                $productQuery->where(function ($query) {
                    $query->whereNull('has_variations')
                        ->orWhere('has_variations', false);
                })->orderBy('price', 'desc')
                    ->union(
                        Product::where('has_variations', true)
                            ->whereHas('variations')
                            ->select('products.*')
                            ->join('product_variations', 'products.id', '=', 'product_variations.product_id')
                            ->orderBy('product_variations.price', 'desc')
                    );
                break;
        }

        $products = $productQuery->get();

        return view(
            'livewire.store-page',
            [
                'title' => $this->title,
                'metaDescription' => $this->metaDescription,
                'products' => $products,
                'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
                'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug'])
            ]
        );
    }

    private function getCategoryIdFromSlug($slug)
    {
        return Category::where('slug', $slug)->value('id');
    }

    private function getCategorySlugFromId($id)
    {
        return Category::where('id', $id)->value('slug');
    }

    public function toggleCategory($categoryId)
    {
        $categorySlug = $this->getCategorySlugFromId($categoryId);
        $categories = $this->selected_categories ? explode(',', $this->selected_categories) : [];

        if (($key = array_search($categorySlug, $categories)) !== false) {
            unset($categories[$key]);
        } else {
            $categories[] = $categorySlug;
        }

        // Convert back to comma-separated string
        $this->selected_categories = implode(',', array_filter($categories));
    }

    public function updatedSort($value)
    {
        // The sorting will happen automatically in the render method
        // No need to call resetPage() as it might cause unnecessary refreshes
    }
}
