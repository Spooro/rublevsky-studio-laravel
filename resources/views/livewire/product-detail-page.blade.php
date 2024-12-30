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
            <div
                class="w-full lg:w-3/5 xl:w-2/3 flex flex-col lg:flex-row gap-2 lg:gap-[0.833rem] lg:sticky lg:top-4 self-start">
                <div class="gallery-stack" wire:ignore>
                    <!-- Initial skeleton -->
                    <div class="flex flex-col lg:flex-row gap-2 lg:gap-[0.833rem] w-full skeleton-gallery">
                        <!-- Thumbnail skeleton -->
                        <div class="order-2 lg:order-1 lg:w-20 flex-shrink-0">
                            <div class="flex lg:flex-col gap-2 pb-2 lg:pb-0 pl-2 lg:pl-0">
                                @foreach ($product->images as $image)
                                    <div class="w-20 h-20 skeleton rounded-lg flex-shrink-0"></div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Main image skeleton -->
                        <div class="order-1 lg:order-2 lg:flex-grow">
                            <div class="w-full h-full">
                                <div class="w-full aspect-square skeleton rounded-none lg:rounded-lg"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Actual gallery -->
                    <div class="flex flex-col lg:flex-row gap-2 lg:gap-[0.833rem] w-full gallery-content">
                        <!-- Thumbnail preview row/column -->
                        <div class="order-2 lg:order-1 lg:w-20 flex-shrink-0">
                            <div id="image-preview-container"
                                class="flex lg:flex-col gap-2 overflow-x-auto lg:overflow-y-auto lg:max-h-[calc(100vh-2rem)] pb-2 lg:pb-0 no-scrollbar">
                                <template x-for="(image, index) in images" :key="image">
                                    <div :class="{
                                        'pl-2 lg:pl-0': index === 0,
                                        'pr-2 lg:pr-0': index === images.length - 1
                                    }"
                                        class="flex-shrink-0">
                                        <div class="preview-image-wrapper rounded-lg relative"
                                            :class="{
                                                'active': selectedImage === image,
                                                'loaded': $el.querySelector('img').complete
                                            }">
                                            <img :src="'{{ Storage::url('') }}' + image" :alt="'{{ $product->name }}'"
                                                class="w-20 h-20 object-cover rounded-[calc(0.5rem-2px)] cursor-pointer hover:opacity-75 transition"
                                                @load="
                                                    $el.parentElement.classList.add('loaded');
                                                    if (document.querySelectorAll('.preview-image-wrapper.loaded').length === images.length) {
                                                        $el.closest('.gallery-stack').classList.add('all-loaded');
                                                    }
                                                "
                                                @click="selectedImage = image; $nextTick(() => centerSelectedImage($event.target))">
                                            <div class="absolute inset-0 skeleton rounded-lg"></div>
                                        </div>
                                    </div>
                            </div>
                            </template>
                        </div>
                    </div>

                    <!-- Main image container -->
                    <div
                        class="flex items-center justify-center lg:items-start lg:justify-start order-1 lg:order-2 lg:flex-grow relative">
                        <div class="relative w-full">
                            <div class="main-image-wrapper relative"
                                :class="{ 'loaded': $el.querySelector('img').complete }">
                                <img :src="'{{ Storage::url('') }}' + selectedImage" :alt="'{{ $product->name }}'"
                                    class="max-w-full w-full lg:w-auto max-h-[calc(100vh-5rem)] object-contain rounded-none lg:rounded-lg cursor-zoom-in relative z-[2]"
                                    @load="$el.parentElement.classList.add('loaded')" @click="openGallery()">
                                <div class="absolute inset-0 skeleton rounded-none lg:rounded-lg z-[1] loaded-hide">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product information -->
        <div
            class="w-full md:mr-8  lg:w-2/5 xl:w-1/3 lg:min-h-[calc(100vh-5rem)] lg:flex lg:flex-col lg:justify-center px-4 lg:px-0">
            <div class="w-full">
                <div class="w-full space-y-4">
                    <h3>{{ $product->name }}</h3>

                    <!-- Variation selection -->
                    @if ($product->has_variations)
                        <div class="flex flex-wrap gap-8">
                            @foreach ($availableAttributes as $attributeName => $attributeValues)
                                <div class="w-auto min-w-fit">
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
                        <div class="flex items-center gap-4 text-sm text-black">
                            @if ($product->coming_soon)
                                <div class="flex gap-8 items-center">
                                    <span>In stock: {{ $availableStock }}</span>
                                    <span>Coming Soon</span>
                                </div>
                            @else
                                <span>In stock: {{ $availableStock }}</span>
                            @endif
                        </div>
                    @endif

                    <!-- Quantity selector and Add to cart button -->
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center space-x-4">
                            <button wire:click="decrementQuantity" @class([
                                'w-10 h-10 rounded-full hover:bg-gray-100 transition duration-300 ease-in-out flex items-center justify-center',
                                'opacity-50 cursor-not-allowed' => $quantity <= 1 || !$canAddToCart,
                            ])
                                {{ $quantity <= 1 || !$canAddToCart ? 'disabled' : '' }}>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M20 12H4" />
                                </svg>
                            </button>
                            <h5>{{ $quantity }}</h5>
                            <button wire:click="incrementQuantity" @class([
                                'w-10 h-10 rounded-full hover:bg-gray-100 transition duration-300 ease-in-out flex items-center justify-center',
                                'opacity-50 cursor-not-allowed' =>
                                    !$canAddToCart || $quantity >= $availableStock,
                            ])
                                {{ !$canAddToCart || $quantity >= $availableStock ? 'disabled' : '' }}>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>

                        <!-- Add to Cart button -->
                        <button wire:click="addToCart({{ $product->id }}, {{ $quantity }})"
                            wire:loading.attr="disabled" wire:loading.class="opacity-75" class="main-button relative"
                            {{ !$canAddToCart ? 'disabled' : '' }}>
                            @if (!$canAddToCart)
                                <span>Out of Stock</span>
                            @else
                                <span wire:loading.remove wire:target="addToCart">
                                    {{ $product->coming_soon ? 'Pre-order' : 'Add to Cart' }}
                                </span>
                                <span wire:loading wire:target="addToCart">
                                    {{ $product->coming_soon ? 'Pre-ordering...' : 'Adding...' }}
                                </span>
                            @endif
                            <span class="ml-2">
                                @if ($product->has_variations && $selectedVariation)
                                    <span
                                        class="opacity-50">CAD</span>{{ number_format($selectedVariation->price, 2) }}
                                @else
                                    <span class="opacity-50">CAD </span>{{ number_format($product->price, 2) }}
                                    @if ($product->has_volume && $product->volume && !$product->has_variations)
                                        <span class="font-light">/ {{ $product->volume }}</span>
                                    @endif
                                @endif
                            </span>
                        </button>
                    </div>

                    <!-- Product description -->
                    <div>
                        <div class="prose-content">
                            <div class="relative mt-8 mb-16">
                                @if ($product->blogPosts->count() > 0)
                                    <div
                                        class="absolute -inset-y-1.5 sm:-inset-y-3 bg-gray-100
                                                -left-4 -right-4
                                                rounded-2xl">
                                    </div>
                                    <div class="relative">
                                        <div class="flex items-center gap-3 mb-6">
                                            <span class="text-gray-700">From a blog post:</span>
                                            <h6>
                                                <a href="/blog#{{ $product->blogPosts->first()->slug }}"
                                                    class="blur-link">
                                                    Read full article
                                                </a>
                                            </h6>
                                        </div>
                                        {!! $product->blogPosts->first()->body !!}
                                    </div>
                                @else
                                    {!! Str::markdown($product->description) !!}
                                @endif
                            </div>
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
        const containerStyle = window.getComputedStyle(container);
        const isVerticalLayout = containerStyle.flexDirection === 'column';

        if (isVerticalLayout) {
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
</script>
