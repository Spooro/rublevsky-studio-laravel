<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-[95rem] p-8 mx-auto mb-20 h-[calc(100vh-5rem)]">
        <div class="flex flex-col md:flex-row md:space-x-8 h-full">
            <!-- Desktop layout remains unchanged -->
            <div class="hidden md:flex md:w-1/2 flex-col justify-between pr-4">
                <!-- New card wrapper -->
                <div class=" bg-white rounded-lg drop-shadow-2xl flex flex-col w-fit">
                    <div class="p-6 flex-grow">
                        <h2 class="mb-4">{{ $product->name }}</h2>

                        <!-- Product variants -->
                        <div class="mb-6">
                            <div class="flex space-x-2 mb-2">
                                <button class="px-4 py-2 bg-gray-200 rounded-full text-sm font-semibold">shirt</button>
                                <button class="px-4 py-2 bg-gray-100 rounded-full text-sm">hoodie</button>
                                <button class="px-4 py-2 bg-gray-100 rounded-full text-sm">sweater</button>
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 bg-gray-100 rounded-full text-sm">XL</button>
                                <button class="px-4 py-2 bg-gray-200 rounded-full text-sm font-semibold">XXL</button>
                                <button class="px-4 py-2 bg-gray-100 rounded-full text-sm">XXXXL</button>
                            </div>
                        </div>

                        <!-- Quantity selector -->
                        <div class="flex items-center space-x-4 mb-6">
                            <button wire:click="decreaseQty"
                                class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-xl font-semibold">-</button>
                            <span class="text-xl font-semibold">{{ $quantity }}</span>
                            <button wire:click="increaseQty"
                                class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-xl font-semibold">+</button>
                        </div>
                    </div>

                    <!-- Add to cart button -->
                    <button wire:click='addToCart({{ $product->id }})'
                        class="w-full py-3 bg-black text-white rounded-b-lg text-lg transition duration-300 ease-in-out hover:bg-gray-800">
                        <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Add to cart</span>
                        <span wire:loading wire:target='addToCart({{ $product->id }})'>Loading...</span>
                        <span class="ml-2">CAD{{ number_format($product->price, 2) }}</span>
                    </button>
                </div>

                <!-- Product description -->
                <div class="mt-8">
                    <p class="text-gray-600">
                        {!! Str::markdown($product->description) !!}
                    </p>
                </div>
            </div>

            <!-- Desktop image gallery -->
            <div class="hidden md:flex md:w-1/2 mt-8 md:mt-0 flex-col h-full items-end" x-data="{
                mainImage: '{{ url('storage', $product->images[0]) }}',
                selectedIndex: 0,
                scrollToSelected() {
                    this.$nextTick(() => {
                        this.$refs.previewContainer.children[this.selectedIndex].scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest',
                            inline: 'center'
                        });
                    });
                }
            }"
                x-init="scrollToSelected">
                <div class="w-[35rem] h-[49rem] mb-2 flex items-center justify-center overflow-hidden">
                    <img x-bind:src="mainImage" alt="{{ $product->name }}"
                        class="w-full h-full object-cover rounded-lg">
                </div>
                <div x-ref="previewContainer" class="w-[35rem] flex space-x-2 overflow-x-auto pb-2 snap-x no-scrollbar">
                    @foreach ($product->images as $index => $image)
                        <div class="w-28 h-28 flex-shrink-0 snap-center">
                            <img src="{{ url('storage', $image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                                x-bind:class="{ 'ring-4 ring-black ring-inset': selectedIndex === {{ $index }} }"
                                x-on:click="mainImage='{{ url('storage', $image) }}'; selectedIndex={{ $index }}; scrollToSelected()">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Mobile layout -->
            <div class="md:hidden w-full flex flex-col pt-12">
                <!-- Image gallery -->
                <div x-data="{
                    mainImage: '{{ url('storage', $product->images[0]) }}',
                    selectedIndex: 0,
                    scrollToSelected() {
                        this.$nextTick(() => {
                            this.$refs.previewContainer.children[this.selectedIndex].scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest',
                                inline: 'center'
                            });
                        });
                    }
                }" x-init="scrollToSelected" class="mb-6">
                    <div
                        class="w-full aspect-[5/7] mb-2 flex items-end justify-center overflow-hidden bg-gray-100 rounded-lg">
                        <img x-bind:src="mainImage" alt="{{ $product->name }}"
                            class="w-full h-auto object-cover">
                    </div>
                    <div x-ref="previewContainer"
                        class="w-full flex space-x-2 overflow-x-auto pb-2 snap-x no-scrollbar">
                        @foreach ($product->images as $index => $image)
                            <div class="w-16 h-16 flex-shrink-0 snap-center">
                                <img src="{{ url('storage', $image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                                    x-bind:class="{ 'ring-2 ring-black ring-inset': selectedIndex === {{ $index }} }"
                                    x-on:click="mainImage='{{ url('storage', $image) }}'; selectedIndex={{ $index }}; scrollToSelected()">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product name and price -->
                <div class="flex justify-between items-center mb-4">
                    <h2>{{ $product->name }}</h2>
                    <h4 class="">CAD{{ number_format($product->price, 2) }}</h4>
                </div>

                <!-- Quantity selector -->
                <div class="flex items-center space-x-4 mb-6">
                    <button wire:click="decreaseQty"
                        class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-xl font-semibold">-</button>
                    <span class="text-xl font-semibold">{{ $quantity }}</span>
                    <button wire:click="increaseQty"
                        class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-xl font-semibold">+</button>
                </div>

                <!-- Product variants -->
                <div class="mb-6">
                    <div class="flex space-x-2 mb-2">
                        <button class="px-4 py-2 bg-gray-200 rounded-full text-sm font-semibold">shirt</button>
                        <button class="px-4 py-2 bg-gray-100 rounded-full text-sm">hoodie</button>
                        <button class="px-4 py-2 bg-gray-100 rounded-full text-sm">sweater</button>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 bg-gray-100 rounded-full text-sm">XL</button>
                        <button class="px-4 py-2 bg-gray-200 rounded-full text-sm font-semibold">XXL</button>
                        <button class="px-4 py-2 bg-gray-100 rounded-full text-sm">XXXXL</button>
                    </div>
                </div>

                <!-- Product description -->
                <div class="mb-24">
                    <p class="text-gray-600">
                        {!! Str::markdown($product->description) !!}
                    </p>
                </div>

                <!-- Add to cart button (fixed at bottom with increased padding) -->
                <div class="fixed bottom-0 right-0   p-4 pb-20  w-min whitespace-nowrap">
                    <button wire:click='addToCart({{ $product->id }})'
                        class=" px-4 py-3 bg-black text-white rounded-2xl text-lg transition duration-300 ease-in-out hover:bg-gray-800">
                        <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Add to cart</span>
                        <span wire:loading wire:target='addToCart({{ $product->id }})'>Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
