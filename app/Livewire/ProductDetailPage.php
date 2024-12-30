<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Traits\WithCartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Contracts\View\View;

#[Title('Product Detail')]
class ProductDetailPage extends Component
{
    use LivewireAlert;
    use WithCartManagement;

    public $product;
    public $quantity = 1;
    public $selectedImage;
    public $slug;
    public $selectedVariation = null;
    public $availableAttributes = [];
    public $title;
    public $metaDescription;

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

            // Find first available variation
            $this->selectedVariation = $this->product->variations
                ->first(function ($variation) {
                    return $this->isVariationAvailable($this->product, $variation);
                }) ?? $this->product->variations->first();
        }

        $this->title = "{$this->product->name} | Store | Rublevsky Studio";
        $this->metaDescription = "Shop {$this->product->name} from Rublevsky Studio. {$this->product->description}";
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->availableStock && $this->canAddToCart) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
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
    }

    public function render(): View
    {
        return view('livewire.product-detail-page', [
            'title' => $this->title,
            'metaDescription' => $this->metaDescription,
            'availableStock' => $this->availableStock,
            'canAddToCart' => $this->canAddToCart
        ]);
    }
}
