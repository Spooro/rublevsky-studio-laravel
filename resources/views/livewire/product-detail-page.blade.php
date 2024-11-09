@php
    use App\Helpers\CartManagement;
@endphp

@push('head')
    @foreach ($product->images as $image)
        <link rel="preload" as="image" href="{{ Storage::url($image) }}">
    @endforeach
@endpush

<div x-data="productGallery(@js($product->images), '{{ $selectedImage }}')" class="min-h-screen flex flex-col pb-20 lg:pb-0">
    <div class="flex items-start justify-center p-0 lg:p-4">
        <div class="w-full max-w-[95rem] flex flex-col lg:flex-row gap-4 lg:gap-10 items-start">
            <!-- Image gallery -->
            <div class="w-full lg:w-3/5 xl:w-2/3 flex flex-col lg:flex-row gap-2 lg:gap-4 lg:sticky lg:top-4 self-start">
                <!-- Thumbnail preview row/column -->
                <div class="order-2 lg:order-1 lg:w-24 flex-shrink-0">
                    <div id="image-preview-container"
                        class="flex lg:flex-col gap-2 overflow-x-auto lg:overflow-y-auto lg:max-h-[calc(100vh-2rem)] pb-2 lg:pb-0 no-scrollbar">
                        <template x-for="(image, index) in images" :key="image">
                            <div :class="{
                                'pl-2 lg:pl-0': index === 0,
                                'pr-2 lg:pr-0': index === images.length - 1
                            }"
                                class="flex-shrink-0">
                                <div :class="{ 'border-2 border-black': selectedImage === image }" class="rounded-lg">
                                    <img :src="'{{ Storage::url('') }}' + image" :alt="'{{ $product->name }}'"
                                        class="w-24 h-24 object-cover rounded-[calc(0.5rem-2px)] cursor-pointer hover:opacity-75 transition"
                                        @click="selectedImage = image; $nextTick(() => centerSelectedImage($event.target))">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <!-- Main image container -->
                <div
                    class="flex items-center justify-center lg:items-start lg:justify-start order-1 lg:order-2 lg:flex-grow">
                    <img :src="'{{ Storage::url('') }}' + selectedImage" :alt="'{{ $product->name }}'"
                        class="max-w-full w-full lg:w-auto max-h-[calc(100vh-5rem)] object-contain rounded-none lg:rounded-lg cursor-zoom-in"
                        @click="openGallery()">
                </div>
            </div>

            <!-- Product information -->
            <div
                class="w-full lg:w-2/5 xl:w-1/3 lg:min-h-[calc(100vh-5rem)] lg:flex lg:flex-col lg:justify-center px-4 lg:px-0">
                <div class="w-full">
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
                                            @elseif ($attributeName === 'size')
                                                Size <span class="font-normal">cm</span>
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

                        @if (!$product->unlimited_stock)
                            <div class="text-sm text-gray-500 mb-4">
                                In stock: {{ $availableStock }}
                            </div>
                        @endif

                        <!-- Quantity selector and Add to cart button -->
                        <div class="flex flex-wrap items-center gap-4" x-data="{
                            qty: @entangle('quantity').live,
                            maxStock: {{ $product->unlimited_stock ? 'Infinity' : $availableStock }},
                            decreaseQty() {
                                if (this.qty > 1) {
                                    this.qty--;
                                }
                            },
                            increaseQty() {
                                if (this.qty < this.maxStock) {
                                    this.qty++;
                                }
                            }
                        }">
                            <div class="flex items-center space-x-4">
                                <button @click="decreaseQty()" :class="{ 'opacity-50 cursor-not-allowed': qty <= 1 }"
                                    class="w-10 h-10 rounded-full hover:bg-gray-100 transition duration-300 ease-in-out flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 12H4" />
                                    </svg>
                                </button>
                                <h5 x-text="qty"></h5>
                                <button @click="increaseQty()"
                                    :class="{ 'opacity-50 cursor-not-allowed': qty >= maxStock }"
                                    class="w-10 h-10 rounded-full hover:bg-gray-100 transition duration-300 ease-in-out flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Add to Cart button with optimistic UI -->
                            <div x-data="{
                                isAdding: false,
                                cartCount: {{ count(CartManagement::getCartItemsFromCookie()) }},
                                async addToCart() {
                                    if (this.isAdding) return;
                            
                                    this.isAdding = true;
                                    // Optimistically update cart count
                                    this.cartCount += qty;
                            
                                    try {
                                        await $wire.addToCart();
                                    } catch (error) {
                                        // Revert optimistic update if failed
                                        this.cartCount -= qty;
                                    } finally {
                                        this.isAdding = false;
                                    }
                                }
                            }">
                                <button @click="addToCart()" class="main-button relative"
                                    :class="{ 'opacity-75': isAdding }"
                                    {{ $product->has_variations && !$selectedVariation ? 'disabled' : '' }}>
                                    <span x-show="!isAdding">Add to Cart</span>
                                    <span x-show="isAdding">Adding...</span>
                                    <span class="ml-2">
                                        @if ($product->has_variations && $selectedVariation)
                                            CAD{{ number_format($selectedVariation->price, 2) }}
                                        @else
                                            CAD{{ number_format($product->price, 2) }}
                                            @if ($product->has_volume && $product->volume && !$product->has_variations)
                                                <span class="font-light">/ {{ $product->volume }}</span>
                                            @endif
                                        @endif
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Product description -->
                        <div>
                            <p class="text-black">{!! Str::markdown($product->description) !!}</p>
                            <p class="text-gray-500 mt-4">Brand: {{ $product->brand->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox Gallery Component -->
    <x-lightbox-gallery />
</div>

<script>
    function centerSelectedImage(clickedImage) {
        const container = document.getElementById('image-preview-container');
        const isDesktop = window.innerWidth >= 1024;

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

    function getImageUrl(image) {
        return `{{ Storage::url('') }}${image}`;
    }

    function productGallery(images, initialImage) {
        return {
            images: images,
            selectedImage: initialImage,
            isOpen: false,
            currentIndex: 0,
            get currentImage() {
                return this.images[this.currentIndex];
            },
            openGallery() {
                this.currentIndex = this.images.indexOf(this.selectedImage);
                this.isOpen = true;
            },
            closeGallery() {
                this.isOpen = false;
            },
            nextImage() {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
                this.selectedImage = this.images[this.currentIndex];
            },
            prevImage() {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                this.selectedImage = this.images[this.currentIndex];
            }
        };
    }
</script>
