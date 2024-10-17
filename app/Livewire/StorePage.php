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

    // add product to cart method
    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($product->has_variations) {
            $variation = ProductVariation::where('product_id', $product_id)
                ->where('stock', '>', 0)
                ->orderBy('id')
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
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if ($this->price_range !== null) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        switch ($this->sort) {
            case 'latest':
                $productQuery->latest();
                break;
            case 'price_asc':
                $productQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $productQuery->orderBy('price', 'desc');
                break;
        }

        return view(
            'livewire.store-page',
            [
                'products' => $productQuery->paginate(12),
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
