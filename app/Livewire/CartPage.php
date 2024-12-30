<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use App\Traits\WithCartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('Cart')]
class CartPage extends Component
{
    use WithCartManagement;
    use LivewireAlert;

    public $cart_items = [];
    public $grand_total;
    public $products = [];
    public $product = null;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        // Load all products and variations that are in the cart
        $productIds = collect($this->cart_items)->pluck('product_id')->unique();
        $this->products = Product::whereIn('id', $productIds)
            ->with(['variations.attributes'])
            ->get()
            ->keyBy('id');
    }

    public function removeItem($product_id, $variation_id = null)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id, $variation_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function increaseQty($product_id, $variation_id = null)
    {
        // Set context for WithCartManagement trait
        $this->product = $this->products[$product_id];
        $this->selectedVariation = $variation_id ? $this->product->variations->firstWhere('id', $variation_id) : null;

        // Get current quantity from cart
        $cartItem = collect($this->cart_items)
            ->where('product_id', $product_id)
            ->where('variation_id', $variation_id)
            ->first();

        $currentQty = $cartItem['quantity'] ?? 0;
        $totalStock = $this->selectedVariation ? $this->selectedVariation->stock : $this->product->stock;

        // Check if we can add one more
        if ($this->product->unlimited_stock || ($currentQty + 1) <= $totalStock) {
            // Update quantity directly in cart items
            foreach ($this->cart_items as $key => $item) {
                if (
                    $item['product_id'] == $product_id &&
                    (($variation_id && isset($item['variation_id']) && $item['variation_id'] == $variation_id) ||
                        (!$variation_id && !isset($item['variation_id'])))
                ) {
                    $this->cart_items[$key]['quantity'] = $currentQty + 1;
                    $this->cart_items[$key]['total_amount'] = $this->cart_items[$key]['quantity'] * $this->cart_items[$key]['unit_amount'];
                    break;
                }
            }

            // Save updated cart
            CartManagement::addCartItemsToCookie($this->cart_items);
            $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
            $this->dispatch('cart-updated');
        } else {
            $this->alert('error', 'Cannot add more items than available in stock', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
        }
    }

    public function decreaseQty($product_id, $variation_id = null)
    {
        // Get current quantity from cart
        $cartItem = collect($this->cart_items)
            ->where('product_id', $product_id)
            ->where('variation_id', $variation_id)
            ->first();

        $currentQty = $cartItem['quantity'] ?? 0;

        if ($currentQty > 1) {
            // Update quantity directly in cart items
            foreach ($this->cart_items as $key => $item) {
                if (
                    $item['product_id'] == $product_id &&
                    (($variation_id && isset($item['variation_id']) && $item['variation_id'] == $variation_id) ||
                        (!$variation_id && !isset($item['variation_id'])))
                ) {
                    $this->cart_items[$key]['quantity'] = $currentQty - 1;
                    $this->cart_items[$key]['total_amount'] = $this->cart_items[$key]['quantity'] * $this->cart_items[$key]['unit_amount'];
                    break;
                }
            }

            // Save updated cart
            CartManagement::addCartItemsToCookie($this->cart_items);
            $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
            $this->dispatch('cart-updated');
        }
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
