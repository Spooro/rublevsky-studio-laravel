<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('Product Detail')]
class ProductDetailPage extends Component
{
    use LivewireAlert;

    public $product;
    public $quantity = 1;
    public $selectedImage;
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product = Product::where('slug', $this->slug)->firstOrFail();
        $this->selectedImage = $this->product->images[0] ?? null;
    }

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {

        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function updatedQuantity($value)
    {
        $this->quantity = max(1, intval($value));
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCartWithQuantity($product_id, $this->quantity);
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
        return view('livewire.product-detail-page');
    }
}
