<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;

class CartManagement
{

    // add item to cart
    static public function addItemToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($product->has_variations) {
            $variation = ProductVariation::where('product_id', $product_id)
                ->where('stock', '>', 0)
                ->orderBy('id')
                ->first();

            if ($variation) {
                return self::addVariationToCartWithQuantity($product_id, $variation->id, 1);
            }
            return false;
        }

        // Existing logic for products without variations
        $cart_items = self::getCartItemsFromCookie();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id && !isset($item['variation_id'])) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            if ($product) {
                $cart_items[] = [
                    'product_id'   => $product_id,
                    'name'         => $product->name,
                    'image'        => $product->images[0],
                    'quantity'     => 1,
                    'unit_amount'  => $product->price,
                    'total_amount' => $product->price,
                    'coming_soon'  => $product->coming_soon,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    // add item to cart with quantity
    static public function addItemToCartWithQuantity($product_id, $qty = 1)
    {
        $cart_items = self::getCartItemsFromCookie();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id && !isset($item['variation_id'])) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] += $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images', 'coming_soon']);
            if ($product) {
                $cart_items[] = [
                    'product_id'   => $product_id,
                    'name'         => $product->name,
                    'image'        => $product->images[0],
                    'quantity'     => $qty,
                    'unit_amount'  => $product->price,
                    'total_amount' => $qty * $product->price,
                    'coming_soon'  => $product->coming_soon,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        self::dispatchCartUpdateEvent();
        return count($cart_items);
    }

    // remove item from cart
    static public function removeCartItem($product_id, $variation_id = null)
    {
        $cart_items = self::getCartItemsFromCookie();

        $cart_items = array_filter($cart_items, function ($item) use ($product_id, $variation_id) {
            if ($variation_id !== null) {
                return !($item['product_id'] == $product_id && isset($item['variation_id']) && $item['variation_id'] == $variation_id);
            }
            return !($item['product_id'] == $product_id && !isset($item['variation_id']));
        });

        self::addCartItemsToCookie(array_values($cart_items));
        return $cart_items;
    }



    // add cart items to cookie
    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // clear cart items from cookie
    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // get all cart items from cookie
    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if (!$cart_items) {
            $cart_items = [];
        }
        return $cart_items;
    }


    // increment item quantity
    static public function incrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }





    //decrement item quantity
    static public function decrementQuantityToCartItem($product_id, $variation_id = null)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id && ($variation_id === null || $item['variation_id'] == $variation_id)) {
                if ($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
                break;
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    //calculate grand total
    static public function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }

    static public function addVariationToCartWithQuantity($product_id, $variation_id, $qty = 1)
    {
        $cart_items = self::getCartItemsFromCookie();

        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id && isset($item['variation_id']) && $item['variation_id'] == $variation_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] += $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'images', 'coming_soon']);
            $variation = ProductVariation::where('id', $variation_id)->with('attributes')->first();
            if ($product && $variation) {
                $cart_items[] = [
                    'product_id'   => $product_id,
                    'variation_id' => $variation_id,
                    'name'         => $product->name,
                    'image'        => $product->images[0],
                    'quantity'     => $qty,
                    'unit_amount'  => $variation->price,
                    'total_amount' => $qty * $variation->price,
                    'attributes'   => $variation->attributes->pluck('value', 'name')->toArray(),
                    'coming_soon'  => $product->coming_soon,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        self::dispatchCartUpdateEvent();
        return count($cart_items);
    }

    static public function getCartItemQuantity($product_id, $variation_id = null)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $item) {
            if ($item['product_id'] == $product_id) {
                if ($variation_id !== null) {
                    if (isset($item['variation_id']) && $item['variation_id'] == $variation_id) {
                        return $item['quantity'];
                    }
                } else if (!isset($item['variation_id'])) {
                    return $item['quantity'];
                }
            }
        }

        return 0;
    }

    static public function getAvailableQuantity($product, $variation = null)
    {
        if ($product->unlimited_stock) {
            return PHP_INT_MAX;
        }

        if ($product->has_volume && $product->has_variations) {
            $remainingVolume = (float) $product->volume;

            // Subtract volume of items already in cart
            $cartItems = self::getCartItemsFromCookie();
            foreach ($cartItems as $item) {
                if ($item['product_id'] == $product->id) {
                    $itemVariation = ProductVariation::find($item['variation_id']);
                    if (!$itemVariation) continue;

                    $volumeAttribute = $itemVariation->attributes
                        ->where('name', 'volume')
                        ->first();

                    if (!$volumeAttribute) continue;

                    $itemVolume = (float) $volumeAttribute->value;
                    if ($itemVolume <= 0) continue;

                    $remainingVolume -= ($itemVolume * (int) $item['quantity']);
                }
            }

            if ($variation) {
                $volumeAttribute = $variation->attributes
                    ->where('name', 'volume')
                    ->first();

                if (!$volumeAttribute) return 0;

                $variationVolume = (float) $volumeAttribute->value;
                if ($variationVolume <= 0) return 0;

                return max(0, floor($remainingVolume / $variationVolume));
            }
            return 0;
        }

        $baseStock = $variation ? $variation->stock : $product->stock;
        $cartQuantity = self::getCartItemQuantity($product->id, $variation ? $variation->id : null);

        return max(0, $baseStock - $cartQuantity);
    }

    static public function canAddToCart($product, $quantity = 1, $variation = null)
    {
        if ($product->unlimited_stock) {
            return true;
        }

        if ($product->has_variations && !$variation) {
            return false;
        }

        if ($product->has_volume && $product->has_variations) {
            // First check if the variation has a valid volume attribute
            if ($variation) {
                $volumeAttribute = $variation->attributes
                    ->where('name', 'volume')
                    ->first();

                if (!$volumeAttribute || (float) $volumeAttribute->value <= 0) {
                    return false;
                }
            }

            $availableQuantity = self::getAvailableQuantity($product, $variation);
            return ($quantity > 0 && $quantity <= $availableQuantity);
        }

        $baseStock = $variation ? $variation->stock : $product->stock;
        $cartQuantity = self::getCartItemQuantity(
            $product->id,
            $variation ? $variation->id : null
        );

        return ($cartQuantity + $quantity) <= $baseStock;
    }

    private static function dispatchCartUpdateEvent()
    {
        Event::dispatch('cart-updated');
    }
}
