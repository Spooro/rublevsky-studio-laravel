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
    public $selectedVariation = null;
    public $availableAttributes = [];
    public $availableStock;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product = Product::where('slug', $this->slug)->with('variations.attributes')->firstOrFail();
        $this->selectedImage = $this->product->images[0] ?? null;

        if ($this->product->has_variations) {
            $this->availableAttributes = $this->product->variations->flatMap->attributes
                ->groupBy('name')
                ->map(function ($group) {
                    return $group->pluck('value')->unique();
                });

            $this->selectedVariation = $this->product->variations->first();
        }

        $this->updateAvailableStock();
    }

    public function selectVariation($attributeName, $attributeValue)
    {
        // Get the current product type (if set)
        $currentProductType = $this->selectedVariation
            ? $this->selectedVariation->attributes->firstWhere('name', 'apparel_type')?->value
            : null;

        // Try to find a variation that matches the selected attribute and keeps the current product type
        $newVariation = $this->product->variations
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
            $newVariation = $this->product->variations
                ->first(function ($variation) use ($attributeName, $attributeValue) {
                    return $variation->attributes
                        ->where('name', $attributeName)
                        ->where('value', $attributeValue)
                        ->isNotEmpty();
                });
        }

        $this->selectedVariation = $newVariation;
        $this->updateAvailableStock();
    }

    public function addToCart()
    {
        try {
            // Validate stock before proceeding
            if (!$this->product->unlimited_stock && $this->quantity > $this->availableStock) {
                $this->alert('error', 'Not enough stock available', [
                    'position' => 'bottom-end',
                    'timer' => 3000,
                    'toast' => true,
                    'showCancelButton' => false,
                    'showConfirmButton' => false,
                ]);
                return;
            }

            if ($this->product->has_variations && $this->selectedVariation) {
                $total_count = CartManagement::addVariationToCartWithQuantity(
                    $this->product->id,
                    $this->selectedVariation->id,
                    $this->quantity
                );
                if (!$this->product->unlimited_stock) {
                    $this->selectedVariation->decrement('stock', $this->quantity);
                    $this->availableStock = $this->selectedVariation->fresh()->stock;
                }
            } else {
                $total_count = CartManagement::addItemToCartWithQuantity($this->product->id, $this->quantity);
                if (!$this->product->unlimited_stock) {
                    $this->product->decrement('stock', $this->quantity);
                    $this->availableStock = $this->product->fresh()->stock;
                }
            }

            $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

            $this->alert('success', 'Product added to cart', [
                'position' => 'bottom-end',
                'timer' => 2000,
                'toast' => true,
                'text' => '',
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

            // Reset quantity after successful addition
            $this->quantity = 1;
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

    public function updatedQuantity($value)
    {
        $this->quantity = max(1, min($this->availableStock, intval($value)));
    }

    public function render()
    {
        return view('livewire.product-detail-page');
    }

    public function updateAvailableStock()
    {
        // For unlimited stock products, set a high number or null
        if ($this->product->unlimited_stock) {
            $this->availableStock = PHP_INT_MAX; // Or any other large number
            return;
        }

        $this->availableStock = $this->product->has_variations && $this->selectedVariation
            ? $this->selectedVariation->stock
            : $this->product->stock;
    }
}
