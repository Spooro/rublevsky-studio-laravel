<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;

#[Title('Cart')]
class CartPage extends Component
{
    public $cart_items = [];

    public $grand_total;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($product_id, $variation_id = null)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id, $variation_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function increaseQty($product_id, $variation_id = null)
    {
        if ($variation_id) {
            $this->cart_items = CartManagement::addVariationToCartWithQuantity($product_id, $variation_id, 1);
        } else {
            $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        }
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function decreaseQty($product_id, $variation_id = null)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id, $variation_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
