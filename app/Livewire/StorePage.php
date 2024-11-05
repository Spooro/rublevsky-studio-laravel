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

#[Title('Rublevsky Store')]
class StorePage extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $price_range = 100;

    #[Url]
    public $sort = 'latest';

    public $sortOptions = [
        'latest' => 'Sort by latest',
        'price_asc' => 'Price: Low to High',
        'price_desc' => 'Price: High to Low',
    ];

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

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1)
            ->with(['variations' => function ($query) {
                $query->orderBy('price', 'asc')->limit(1);
            }]);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
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
                'products' => $products,
                'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
                'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug'])
            ]
        );
    }

    public function toggleCategory($categoryId)
    {
        if (($key = array_search($categoryId, $this->selected_categories)) !== false) {
            unset($this->selected_categories[$key]);
        } else {
            $this->selected_categories[] = $categoryId;
        }
        $this->selected_categories = array_values($this->selected_categories);
    }

    public function updatedSort()
    {
        $this->resetPage();
    }
}
