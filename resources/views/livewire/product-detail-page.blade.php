 <!-- TODO:
    1. Add hover-lense-zoom for the main product image
    2. finish mobile version
-->

 <div class="min-h-screen flex items-center justify-center px-2">
     <div class="w-full max-w-[95rem] grid grid-cols-1 xl:grid-cols-2 gap-8 p-0">
         <!-- Image gallery -->
         <div class="flex flex-col xl:flex-row w-full h-full">
             <!-- Main image -->
             <div class="order-1 xl:order-2 mb-2 xl:mb-0 w-screen xl:w-auto -mx-4 sm:-mx-6 lg:-mx-8 xl:mx-0">
                 <div class="w-full h-full max-h-[80vh] aspect-w-1 aspect-h-1 xl:aspect-none relative overflow-hidden">
                     <img src="{{ url('storage', $selectedImage) }}" alt="{{ $product->name }}"
                         class="w-full h-full object-contain xl:object-cover">
                 </div>
             </div>
             <!-- Thumbnail preview column -->
             <div
                 class="flex -mx-2 xl:flex-col order-2 xl:order-1 space-x-2 xl:space-x-0 xl:space-y-2 h-24 xl:h-auto xl:w-24 overflow-x-auto xl:overflow-y-auto xl:overflow-x-hidden px-4 xl:px-0 xl:mr-2">
                 @foreach ($product->images as $index => $image)
                     <div class="w-24 h-24 flex-shrink-0">
                         <img src="{{ url('storage', $image) }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                             wire:click="$set('selectedImage', '{{ $image }}')">
                     </div>
                 @endforeach
             </div>
         </div>

         <!-- Product information -->
         <div class="flex items-center justify-left xl:justify-start xl:pl-16 px-4 sm:px-6 lg:px-8 xl:px-0">
             <div class="w-full max-w-[40rem] space-y-8">
                 <h3 class="">{{ $product->name }}</h3>

                 <!-- Quantity selector and Add to cart button -->
                 <div class="flex flex-wrap items-center gap-4">
                     <div class="flex items-center space-x-4">
                         <button wire:click="decreaseQty"
                             class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center text-2xl hover:bg-gray-200 transition duration-300 ease-in-out">-</button>
                         <span class="text-2xl">{{ $quantity }}</span>
                         <button wire:click="increaseQty"
                             class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center text-2xl hover:bg-gray-200 transition duration-300 ease-in-out">+</button>
                     </div>
                     <button wire:click='addToCart({{ $product->id }})'
                         class="px-6 py-3 bg-black text-white rounded-full text-lg transition duration-300 ease-in-out hover:bg-gray-800">
                         <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Add to Cart</span>
                         <span wire:loading wire:target='addToCart({{ $product->id }})'>Loading...</span>
                         <span class="ml-2">CAD{{ number_format($product->price, 2) }}</span>
                     </button>
                 </div>

                 <!-- Product description -->
                 <div class="text-gray-600 max-h-48 overflow-y-auto pb-64">
                     <p>{!! Str::markdown($product->description) !!}</p>
                 </div>
             </div>
         </div>
     </div>
 </div>
