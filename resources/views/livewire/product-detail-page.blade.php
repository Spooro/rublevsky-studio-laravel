 <!-- TODO:
    1. Add hover-lense-zoom for the main product image
    2. finish mobile version
    ---
    1. Main Image Visibility:
   • Ensure the main image remains always visible on the screen.
   • Align the image to the top of the image gallery and keep it fully visible regardless of screen size or aspect ratio.
   • The main image should take up the maximum width available while maintaining the correct aspect ratio.
   • Prevent the image from being hidden when the screen height decreases, keeping it always visible at the top.
    2. Image Preview Column (Desktop):
   • Prevent the image preview column from exceeding 100vh in height.
   • If the column gets taller than the screen, implement a scroll bar to allow users to scroll through the previews.
    3. Image Previews Overflowing:
   • Limit the row of image previews from overflowing past the screen edges.
   • Add overflow: hidden and enable scrolling for the preview row.

-->

 <div class="min-h-screen flex flex-col">
     <div class="flex items-center justify-center p-4">
         <div class="w-full max-w-[95rem] flex flex-col lg:flex-row gap-10">
             <!-- Image gallery -->
             <div class="flex flex-col lg:flex-row gap-2 lg:gap-4">
                 <!-- Thumbnail preview row/column -->
                 <div class="lg: order-2 lg:order-1">
                     <div class="flex lg:flex-col gap-2">
                         @foreach ($product->images as $index => $image)
                             <div class="w-24 h-24 flex-shrink-0">
                                 <img src="{{ Storage::url($image) }}" alt="{{ $product->name }}"
                                     class="w-full h-full object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                                     wire:click="$set('selectedImage', '{{ $image }}')">
                             </div>
                         @endforeach
                     </div>
                 </div>
                 <!-- Main image container -->
                 <div class="flex items-center justify-center order-1 lg:order-2">
                     <img src="{{ Storage::url($selectedImage) }}" alt="{{ $product->name }}"
                         class="max-w-full max-h-[90vh] object-contain rounded-lg">
                 </div>
             </div>

             <!-- Product information -->
             <div class="flex-grow flex items-center justify-center">
                 <div class="w-full max-w-[40rem] space-y-8 overflow-y-auto">
                     <h3 class="">{{ $product->name }}</h3>

                     <!-- Variation selection -->
                     @if ($product->has_variations)
                         <div class="flex flex-wrap gap-8">
                             @foreach ($availableAttributes as $attributeName => $attributeValues)
                                 <div class="">
                                     <h4 class="text-lg font-semibold mb-3">
                                         @if ($attributeName === 'apparel_type')
                                             Type
                                         @else
                                             {{ ucfirst(str_replace('_', ' ', $attributeName)) }}
                                         @endif
                                     </h4>
                                     <div class="flex flex-wrap gap-2">
                                         @foreach ($attributeValues as $value)
                                             @php
                                                 $isAvailable = $product->variations->contains(function (
                                                     $variation,
                                                 ) use ($attributeName, $value, $selectedVariation) {
                                                     $matchesAttribute = $variation->attributes
                                                         ->where('name', $attributeName)
                                                         ->where('value', $value)
                                                         ->isNotEmpty();

                                                     if (!$selectedVariation) {
                                                         return $matchesAttribute;
                                                     }

                                                     $otherAttributes = $selectedVariation->attributes->where(
                                                         'name',
                                                         '!=',
                                                         $attributeName,
                                                     );
                                                     foreach ($otherAttributes as $otherAttribute) {
                                                         if (
                                                             !$variation->attributes
                                                                 ->where('name', $otherAttribute->name)
                                                                 ->where('value', $otherAttribute->value)
                                                                 ->isNotEmpty()
                                                         ) {
                                                             return false;
                                                         }
                                                     }

                                                     return $matchesAttribute;
                                                 });
                                                 $isSelected =
                                                     $selectedVariation &&
                                                     $selectedVariation->attributes
                                                         ->where('name', $attributeName)
                                                         ->where('value', $value)
                                                         ->isNotEmpty();
                                             @endphp
                                             <button
                                                 wire:click="selectVariation('{{ $attributeName }}', '{{ $value }}')"
                                                 class="px-4 py-2 border rounded-md {{ $isSelected ? 'bg-black text-white' : ($isAvailable ? 'bg-white text-black' : 'bg-gray-200 text-gray-600') }} transition-colors duration-200 {{ $isAvailable ? '' : 'opacity-50' }}"
                                                 title="{{ $isAvailable ? '' : 'This variation is currently unavailable' }}">
                                                 {{ $value }}
                                             </button>
                                         @endforeach
                                     </div>
                                 </div>
                             @endforeach
                         </div>
                     @endif

                     <!-- Stock information -->
                     <div class="text-sm text-gray-500 mb-4">
                         In stock: {{ $availableStock }}
                     </div>

                     <!-- Quantity selector and Add to cart button -->
                     <div class="flex flex-wrap items-center gap-4">
                         <div class="flex items-center space-x-4">
                             <button wire:click="decreaseQty"
                                 class="w-14 h-14 flex items-center justify-center text-2xl hover:bg-gray-100 rounded-full transition duration-300 ease-in-out">-</button>
                             <span class="text-2xl">{{ $quantity }}</span>
                             <button wire:click="increaseQty"
                                 class="w-14 h-14 flex items-center justify-center text-2xl hover:bg-gray-100 rounded-full transition duration-300 ease-in-out">+</button>
                         </div>
                         <button wire:click='addToCart'
                             class="flex-grow px-6 py-3 bg-black text-white rounded-full text-lg border-2 border-black transition duration-300 ease-in-out hover:bg-white hover:text-black"
                             {{ $product->has_variations && !$selectedVariation ? 'disabled' : '' }}>
                             <span wire:loading.remove wire:target='addToCart'>Add to Cart</span>
                             <span wire:loading wire:target='addToCart'>Loading...</span>
                             <span
                                 class="ml-2">CAD{{ number_format($product->has_variations && $selectedVariation ? $selectedVariation->price : $product->price, 2) }}</span>
                         </button>
                     </div>

                     <!-- Product description -->
                     <div class="text-gray-500">
                         <p>{!! Str::markdown($product->description) !!}</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
