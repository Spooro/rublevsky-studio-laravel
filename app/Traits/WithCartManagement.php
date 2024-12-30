<?php

namespace App\Traits;

use App\Helpers\CartManagement;
use App\Models\Product;

trait WithCartManagement
{
    public $selectedVariation = null;

    protected function getListeners()
    {
        return [
            'cart-updated' => 'handleCartUpdated'
        ];
    }

    public function handleCartUpdated()
    {
        // If we have a single active product (product detail page)
        if (isset($this->product) && $this->product) {
            $this->product = $this->product->fresh(['variations' => function ($query) {
                $query->orderBy('price', 'asc');
            }, 'variations.attributes']);
        }

        // For store page, refresh the entire products collection
        if (method_exists($this, 'refreshProducts')) {
            $this->refreshProducts();
        }
    }

    // Essential computed properties for product detail page
    public function getAvailableStockProperty()
    {
        if (!isset($this->product)) {
            return 0;
        }

        if ($this->product->unlimited_stock) {
            return PHP_INT_MAX;
        }

        if ($this->product->has_variations) {
            if ($this->selectedVariation) {
                return CartManagement::getAvailableQuantity($this->product, $this->selectedVariation);
            }
            return 0;
        }

        return CartManagement::getAvailableQuantity($this->product, null);
    }

    public function getCanAddToCartProperty()
    {
        if (!isset($this->product)) {
            return false;
        }

        if ($this->product->unlimited_stock) {
            return true;
        }

        if ($this->product->has_variations) {
            if ($this->selectedVariation) {
                return CartManagement::getAvailableQuantity($this->product, $this->selectedVariation) > 0;
            }
            return false;
        }

        return CartManagement::getAvailableQuantity($this->product, null) > 0;
    }

    // Shared utility method used by both pages
    public function isVariationAvailable($product, $variation)
    {
        return CartManagement::getAvailableQuantity($product, $variation) > 0;
    }

    // Used by both pages for variation selection
    public function selectVariation($product_id, $variation_id)
    {
        if (isset($this->products)) {
            // Store page context
            $product = $this->products->firstWhere('id', $product_id);
            if ($product && $product->variations) {
                $variation = $product->variations->firstWhere('id', $variation_id);
                if ($variation && $this->isVariationAvailable($product, $variation)) {
                    $this->selectedVariations[$product_id] = $variation_id;
                }
            }
        } else {
            // Product detail page context
            if ($this->product && $this->product->id === $product_id) {
                $this->selectedVariation = $this->product->variations->firstWhere('id', $variation_id);
            }
        }
    }

    // Used by both pages for adding to cart
    public function addToCart($product_id, $quantity = 1)
    {
        try {
            $product = null;
            $variation = null;

            if (isset($this->products)) {
                // Store page context
                $product = $this->products->firstWhere('id', $product_id);
                if ($product && $product->has_variations) {
                    $variation = $product->variations->firstWhere('id', $this->selectedVariations[$product->id] ?? null);
                }
            } else {
                // Product detail page context
                $product = $this->product;
                $variation = $this->selectedVariation;
            }

            if (!$product) {
                throw new \Exception('Product not found');
            }

            if ($product->has_variations) {
                if (!$variation) {
                    $this->alert('error', 'Please select a variation', [
                        'position' => 'bottom-end',
                        'timer' => 3000,
                        'toast' => true,
                        'showCancelButton' => false,
                        'showConfirmButton' => false,
                    ]);
                    return;
                }

                if (!$this->isVariationAvailable($product, $variation)) {
                    $this->alert('error', 'Selected variation is not available', [
                        'position' => 'bottom-end',
                        'timer' => 3000,
                        'toast' => true,
                        'showCancelButton' => false,
                        'showConfirmButton' => false,
                    ]);
                    return;
                }

                $total_count = CartManagement::addVariationToCartWithQuantity(
                    $product_id,
                    $variation->id,
                    $quantity
                );
            } else {
                if (CartManagement::getAvailableQuantity($product, null) <= 0) {
                    $this->alert('error', 'Product is out of stock', [
                        'position' => 'bottom-end',
                        'timer' => 3000,
                        'toast' => true,
                        'showCancelButton' => false,
                        'showConfirmButton' => false,
                    ]);
                    return;
                }

                $total_count = CartManagement::addItemToCartWithQuantity($product_id, $quantity);
            }

            $this->dispatch('update-cart-count', total_count: $total_count)->to('App\Livewire\Partials\Navbar');
            $this->dispatch('cart-updated');

            // Refresh products to update stock display
            if (method_exists($this, 'refreshProducts')) {
                $this->refreshProducts();
            }

            $this->alert('success', 'Product added to cart', [
                'position' => 'bottom-end',
                'timer' => 2000,
                'toast' => true,
                'text' => '',
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
        } catch (\Exception $e) {
            $this->alert('error', 'Failed to add product to cart', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
        }
    }
}
