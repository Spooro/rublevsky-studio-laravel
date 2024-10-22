 <!-- TODO:
    1. Add hover-lense-zoom for the main product image
-->

 <div class="min-h-screen flex flex-col pb-20 lg:pb-0">
     <div class="flex items-start justify-center p-4">
         <div class="w-full max-w-[95rem] flex flex-col lg:flex-row gap-10 items-start">
             <!-- Image gallery -->
             <div
                 class="w-full lg:w-3/5 xl:w-2/3 flex flex-col lg:flex-row gap-2 lg:gap-4 lg:sticky lg:top-4 self-start">
                 <!-- Thumbnail preview row/column -->
                 <div class="order-2 lg:order-1 lg:w-24 flex-shrink-0">
                     <div id="image-preview-container"
                         class="flex lg:flex-col gap-2 overflow-x-auto lg:overflow-y-auto lg:max-h-[calc(100vh-2rem)] pb-2 lg:pb-0 no-scrollbar">
                         @foreach ($product->images as $index => $image)
                             <div
                                 class="w-24 h-24 flex-shrink-0 {{ $selectedImage === $image ? 'p-0.5 bg-black rounded-lg' : '' }}">
                                 <img src="{{ Storage::url($image) }}" alt="{{ $product->name }}"
                                     class="w-full h-full object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                                     wire:click="$set('selectedImage', '{{ $image }}')"
                                     x-on:click="centerSelectedImage($event.target)">
                             </div>
                         @endforeach
                     </div>
                 </div>
                 <!-- Main image container -->
                 <div
                     class="flex items-center justify-center lg:items-start lg:justify-start order-1 lg:order-2 lg:flex-grow">
                     <img src="{{ Storage::url($selectedImage) }}" alt="{{ $product->name }}"
                         class="max-w-full w-full lg:w-auto max-h-[calc(100vh-2rem)] object-contain rounded-lg">
                 </div>
             </div>

             <!-- Product information -->
             <div class="w-full lg:w-2/5 xl:w-1/3 lg:flex lg:flex-col lg:justify-center">
                 <div class="w-full h-full">
                     <div class="w-full space-y-8">
                         <h3>{{ $product->name }}</h3>

                         <!-- Variation selection -->
                         @if ($product->has_variations)
                             <div class="flex gap-8">
                                 @foreach ($availableAttributes as $attributeName => $attributeValues)
                                     <div class="w-auto">
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
                                     class="w-10 h-10 rounded-full hover:bg-gray-100 transition duration-300 ease-in-out flex items-center justify-center">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke`-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                             d="M20 12H4" />
                                     </svg>
                                 </button>
                                 <h5>{{ $quantity }}</h5>
                                 <button wire:click="increaseQty"
                                     class="w-10 h-10 rounded-full hover:bg-gray-100 transition duration-300 ease-in-out flex items-center justify-center">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                             d="M12 4v16m8-8H4" />
                                     </svg>
                                 </button>
                             </div>
                             <button wire:click='addToCart' class="main-button"
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
 </div>

 <script>
     function centerSelectedImage(clickedImage) {
         const container = document.getElementById('image-preview-container');
         const isDesktop = window.innerWidth >= 1024; // Assuming 'lg' breakpoint is 1024px

         if (isDesktop) {
             const containerHeight = container.offsetHeight;
             const imageHeight = clickedImage.offsetHeight;
             const scrollTop = clickedImage.offsetTop - (containerHeight / 2) + (imageHeight / 2);

             container.scrollTo({
                 top: scrollTop,
                 behavior: 'smooth'
             });
         } else {
             const containerWidth = container.offsetWidth;
             const imageWidth = clickedImage.offsetWidth;
             const scrollLeft = clickedImage.offsetLeft - (containerWidth / 2) + (imageWidth / 2);

             container.scrollTo({
                 left: scrollLeft,
                 behavior: 'smooth'
             });
         }
     }

     document.addEventListener('livewire:load', function() {
         Livewire.on('imageSelected', function() {
             const selectedImage = document.querySelector('#image-preview-container img.ring-2');
             if (selectedImage) {
                 centerSelectedImage(selectedImage);
             }
         });
     });
 </script>
