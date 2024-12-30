@php
    use App\Helpers\CartManagement;
@endphp

<div no-scrollbar>
    {{-- <x-loader wire:ignore /> --}}

    <!-- filters -->
    <div x-data="{ showFilters: true, lastScrollTop: 0, scrollThreshold: 200 }" x-init="window.addEventListener('scroll', () => {
        let st = window.pageYOffset || document.documentElement.scrollTop;
        if (st > scrollThreshold) {
            if (st > lastScrollTop) {
                showFilters = false;
            } else {
                showFilters = true;
            }
        } else {
            showFilters = true;
        }
        lastScrollTop = st <= 0 ? 0 : st;
    }, false)" :class="{ '-translate-y-full': !showFilters }"
        class="sticky top-0 left-0 right-0 z-10 mb-6 bg-transparent backdrop-blur-md w-full transition-transform duration-300 ease-in-out">
        <div class="max-w-[95rem] mx-auto px-4 py-2">
            <div x-data="{ isWrapped: false }" x-init="const observer = new ResizeObserver(entries => {
                for (let entry of entries) {
                    const children = Array.from(entry.target.children);
                    const totalChildrenWidth = children.reduce((sum, child) => sum + child.offsetWidth, 0);
                    isWrapped = totalChildrenWidth > entry.contentRect.width;
                }
            });
            observer.observe($refs.filterContainer);
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    isWrapped = false;
                }
            });" x-ref="filterContainer"
                class="flex flex-wrap items-center justify-between gap-2 transition-all duration-300">

                <!-- Categories -->
                <div class="w-full sm:w-auto">
                    <div
                        class="filter-container bg-white backdrop-blur-sm rounded-full inline-flex space-x-0.5 sm:space-x-1 overflow-x-auto h-10">
                        @foreach ($categories as $category)
                            <button wire:click="toggleCategory({{ $category->id }})"
                                class="px-2 sm:px-4 h-full rounded-full transition-colors duration-200 whitespace-nowrap text-sm sm:text-lg
                                       {{ in_array($category->slug, $selected_categories ? explode(',', $selected_categories) : [])
                                           ? 'bg-black text-white'
                                           : 'text-gray-700 hover:bg-black/10' }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Sort and Price Range Container -->
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <!-- Sort -->
                    <div x-data="{
                        open: false,
                        selectedSort: @entangle('sort').live,
                        isMobile: window.innerWidth < 768,
                        toggle() {
                            this.open = !this.open;
                        },
                        close(focusAfter) {
                            this.open = false;
                            focusAfter?.focus();
                        },
                        init() {
                            window.addEventListener('resize', () => {
                                this.isMobile = window.innerWidth < 768;
                            });
                        }
                    }" class="relative" @click.away="close()"
                        @keydown.escape.prevent.stop="close($refs.button)" @mouseenter="!isMobile && (open = true)"
                        @mouseleave="!isMobile && (open = false)">
                        <button x-ref="button" @click="isMobile && toggle()"
                            class="filter-container flex items-center justify-between backdrop-blur-sm rounded-full px-2 sm:px-4 h-10 text-slate-800 hover:text-slate-900 shadow-inner whitespace-nowrap text-base sm:text-lg"
                            :aria-expanded="open" aria-haspopup="true">
                            <span class="pl-2">{{ $sortOptions[$sort] }}</span>
                            <svg class="w-3 h-3 mr-2 fill-slate-500 ml-2" xmlns="http://www.w3.org/2000/svg"
                                width="12" height="12">
                                <path d="M10 2.586 11.414 4 6 9.414.586 4 2 2.586l4 4z" />
                            </svg>
                        </button>
                        <ul x-show="open" x-transition:enter="transition ease-out duration-200 transform"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute top-full left-0 mt-1 w-full bg-white border border-slate-200 p-2 rounded-lg shadow-xl [&[x-cloak]]:hidden z-50"
                            x-cloak role="menu">
                            @foreach ($sortOptions as $value => $label)
                                <li>
                                    <button
                                        class="w-full text-left text-slate-800 hover:bg-slate-50 p-2 rounded-lg text-base sm:text-lg"
                                        @click="selectedSort = '{{ $value }}'; close()" role="menuitem">
                                        {{ $label }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Price Range -->
                    <div x-data="{
                        localPrice: @entangle('price_range').live,
                        formatPrice(value) {
                            return new Intl.NumberFormat('en-CA', {
                                style: 'currency',
                                currency: 'CAD',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(value);
                        }
                    }"
                        class="filter-container bg-white shadow-inner backdrop-blur-sm rounded-full p-1 flex-grow sm:flex-grow-0 sm:w-[13rem] min-w-[10rem] h-10">
                        <div class="flex items-center h-full">
                            <span class="text-gray-600 mr-2 ml-3 text-base sm:text-lg whitespace-nowrap"
                                x-text="formatPrice(localPrice)">
                            </span>
                            <input type="range" x-model="localPrice"
                                @input="$wire.set('price_range', $event.target.value)"
                                class="w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer"
                                min="0" :max="@js($max_price)" step="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <!-- Product grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-[95rem] mx-auto items-start">
            @foreach ($products as $product)
                <div class="w-full product-card overflow-hidden rounded-lg group" wire:key="{{ $product->id }}">
                    <div class="bg-white flex flex-col">
                        <div class="relative aspect-square overflow-hidden">
                            <div wire:ignore>
                                <a href="/store/{{ $product->slug }}" wire:navigate class="block h-full relative">
                                    <!-- Primary Image with Skeleton -->
                                    <div
                                        class="relative aspect-square flex items-center justify-center overflow-hidden">
                                        <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}"
                                            class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-500 ease-in-out opacity-0"
                                            onload="this.parentElement.classList.add('loaded')">
                                        <div class="absolute inset-0 skeleton loaded-hide"></div>
                                    </div>

                                    <!-- Secondary Image (if exists) -->
                                    @if (count($product->images) > 1)
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <img src="{{ Storage::url($product->images[1]) }}"
                                                alt="{{ $product->name }}"
                                                class="absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-500 ease-in-out">
                                        </div>
                                    @endif
                                </a>
                            </div>

                            <!-- Desktop Add to Cart button -->
                            <div wire:key="desktop-cart-container-{{ $product->id }}">
                                @php
                                    $selectedVariation = $this->getSelectedVariation($product);
                                    $availableStock = $this->getAvailableStock($product);
                                    $canAddToCart = $this->canAddToCart($product);
                                @endphp
                                <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled"
                                    wire:key="desktop-add-to-cart-{{ $product->id }}" @class([
                                        'absolute bottom-0 left-0 right-0 hidden md:flex items-center justify-center space-x-2 bg-gray-200/70 backdrop-blur-sm text-black hover:bg-black hover:text-white transition-all duration-500 py-2 add-to-cart-btn opacity-0',
                                        'cursor-not-allowed hover:bg-gray-200/70 hover:text-black group-hover:opacity-50' => !$canAddToCart,
                                        'group-hover:opacity-100' => $canAddToCart,
                                    ])
                                    {{ !$canAddToCart ? 'disabled' : '' }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                        viewBox="0 0 33 30" class="cart-icon">
                                        <path
                                            d="M1.94531 1.80127H7.27113L11.9244 18.602C12.2844 19.9016 13.4671 20.8013 14.8156 20.8013H25.6376C26.9423 20.8013 28.0974 19.958 28.495 18.7154L31.9453 7.9303H19.0041"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <circle cx="13.4453" cy="27.3013" r="2.5" fill="currentColor" />
                                        <circle cx="26.4453" cy="27.3013" r="2.5" fill="currentColor" />
                                    </svg>
                                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
                                        @if (!$canAddToCart)
                                            Out of Stock
                                        @else
                                            {{ $product->coming_soon ? 'Pre-order' : 'Add to Cart' }}
                                        @endif
                                    </span>
                                    <span wire:loading wire:target="addToCart({{ $product->id }})">
                                        {{ $product->coming_soon ? 'Pre-ordering...' : 'Adding...' }}
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="flex flex-col h-auto md:h-full">
                            <!-- Info Section -->
                            <div class="p-4 flex flex-col h-auto md:h-full">
                                <!-- Price and Stock -->
                                <div class="flex justify-between items-baseline flex-wrap mb-2">
                                    <div class="flex items-baseline justify-between w-full">
                                        <span
                                            class="text-lg font-light text-black whitespace-nowrap flex items-baseline gap-1">
                                            @if ($product->has_variations && $product->variations->isNotEmpty())
                                                @php
                                                    $cheapestVariation = $product->variations->sortBy('price')->first();
                                                @endphp
                                                {{ Number::currency($cheapestVariation->price, 'CAD') }}
                                                @if ($volumeAttr = $cheapestVariation->attributes->where('name', 'volume')->first())
                                                    <span
                                                        class="text-black smaller-text font-light">/{{ $volumeAttr->value }}</span>
                                                @endif
                                            @else
                                                {{ Number::currency($product->price, 'CAD') }}
                                                @if ($product->has_volume && $product->volume)
                                                    <span
                                                        class="text-black smaller-text font-light">/{{ $product->volume }}</span>
                                                @endif
                                            @endif
                                        </span>

                                        @if (!$product->unlimited_stock)
                                            <span class="text-xs">
                                                {{ $availableStock }} in stock
                                            </span>
                                        @endif

                                    </div>
                                    @if ($product->coming_soon)
                                        <span class="text-sm hidden sm:inline">Coming Soon</span>
                                        <span class="text-sm w-full block sm:hidden mt-1">Coming Soon</span>
                                    @endif
                                </div>

                                <!-- Product Name -->
                                <h3 class="text-sm mb-3">
                                    {{ $product->name }}
                                </h3>

                                <!-- Variations -->
                                @if ($product->has_variations && $product->variations->isNotEmpty())
                                    <div class="space-y-2" wire:key="variations-container-{{ $product->id }}">
                                        @php
                                            $selectedVariation = $this->getSelectedVariation($product);
                                            $availableStock = $this->getAvailableStock($product);
                                            $canAddToCart = $this->canAddToCart($product);

                                            // Get available attributes grouped by name
                                            $availableAttributes = $product->variations->flatMap->attributes
                                                ->groupBy('name')
                                                ->map(function ($group) {
                                                    return $group->pluck('value')->unique();
                                                })
                                                ->sortBy(function ($values, $key) {
                                                    // Sort attribute types: type first, then size
                                                    return $key === 'apparel_type' ? 1 : ($key === 'size' ? 2 : 3);
                                                });
                                        @endphp
                                        @foreach ($availableAttributes as $attributeName => $attributeValues)
                                            <div>
                                                <div class="text-xs font-medium text-gray-500 mb-1">
                                                    @if ($attributeName === 'apparel_type')
                                                        Type
                                                    @elseif ($attributeName === 'size')
                                                        Size
                                                    @else
                                                        {{ ucfirst($attributeName) }}
                                                    @endif
                                                </div>
                                                <div class="flex flex-wrap gap-1">
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
                                                            wire:click="selectVariation({{ $product->id }}, '{{ $attributeName }}', '{{ $value }}')"
                                                            @class([
                                                                'px-2 py-1 text-xs rounded-full border transition-colors duration-200',
                                                                'border-black bg-black text-white' => $isSelected,
                                                                'border-gray-300 hover:border-black' => !$isSelected && $isAvailable,
                                                                'border-gray-200 text-gray-400' => !$isAvailable,
                                                            ])>
                                                            {{ $value }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Mobile Add to Cart button -->
                            <div class="md:hidden mt-auto">
                                <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled"
                                    wire:key="mobile-add-to-cart-{{ $product->id }}" @class([
                                        'w-full flex items-center justify-center space-x-2 bg-gray-200/70 backdrop-blur-sm text-black hover:bg-black hover:text-white transition-all duration-500 py-2 px-4 add-to-cart-btn',
                                        'opacity-50 cursor-not-allowed hover:bg-gray-200/70 hover:text-black' => !$canAddToCart,
                                    ])
                                    {{ !$canAddToCart ? 'disabled' : '' }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="none" viewBox="0 0 33 30" class="cart-icon">
                                        <path
                                            d="M1.94531 1.80127H7.27113L11.9244 18.602C12.2844 19.9016 13.4671 20.8013 14.8156 20.8013H25.6376C26.9423 20.8013 28.0974 19.958 28.495 18.7154L31.9453 7.9303H19.0041"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <circle cx="13.4453" cy="27.3013" r="2.5" fill="currentColor" />
                                        <circle cx="26.4453" cy="27.3013" r="2.5" fill="currentColor" />
                                    </svg>
                                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
                                        @if (!$canAddToCart)
                                            Out of Stock
                                        @else
                                            {{ $product->coming_soon ? 'Pre-order' : 'Add to Cart' }}
                                        @endif
                                    </span>
                                    <span wire:loading wire:target="addToCart({{ $product->id }})">
                                        {{ $product->coming_soon ? 'Pre-ordering...' : 'Adding...' }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <style>
        .product-card {
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }

        .product-card:hover {
            transform: scale(1.02) translateZ(1rem);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            transition: transform 0.5s ease-out, opacity 0.5s ease-out;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .product-card:hover img:first-child {
            opacity: 0;
        }

        .product-card:hover img:last-child {
            opacity: 1;
        }

        /* Desktop Add to Cart button */
        .product-card .add-to-cart-btn {
            transition: opacity 0.3s ease-in-out, background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            opacity: 0;
        }

        /* Mobile Add to Cart button */
        @media (max-width: 767px) {
            .product-card .add-to-cart-btn {
                border-radius: 0;
                margin-top: 0;
            }
        }

        .add-to-cart-btn:not(:disabled):hover {
            color: white;
            background-color: black;
        }

        .add-to-cart-btn:disabled {
            cursor: not-allowed;
        }

        .add-to-cart-btn:disabled:hover {
            color: black;
            background-color: rgb(229 231 235 / 0.7);
        }
    </style>
</div>
