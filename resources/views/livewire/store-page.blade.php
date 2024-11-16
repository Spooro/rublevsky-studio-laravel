<div no-scrollbar>
    <x-loader />

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
                    <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="filter-container flex items-center justify-between backdrop-blur-sm rounded-full px-2 sm:px-4 h-10 text-slate-800 hover:text-slate-900 shadow-inner whitespace-nowrap text-base sm:text-lg"
                            :aria-expanded="open">
                            <span class="pl-2">{{ $sortOptions[$sort] }}</span>
                            <svg class="w-3 h-3 mr-2 fill-slate-500 ml-2" xmlns="http://www.w3.org/2000/svg"
                                width="12" height="12">
                                <path d="M10 2.586 11.414 4 6 9.414.586 4 2 2.586l4 4z" />
                            </svg>
                        </button>
                        <ul class="absolute top-full left-0 mt-1 w-full bg-white border border-slate-200 p-2 rounded-lg shadow-xl [&[x-cloak]]:hidden z-50"
                            x-show="open" x-transition:enter="transition ease-out duration-200 transform"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" x-cloak
                            @focusout="await $nextTick();!$el.contains($focus.focused()) && (open = false)">
                            @foreach ($sortOptions as $value => $label)
                                <li>
                                    <a href="#"
                                        class="text-slate-800 hover:bg-slate-50 flex items-center p-2 rounded-lg text-base sm:text-lg"
                                        wire:click.prevent="$set('sort', '{{ $value }}')">
                                        {{ $label }}
                                    </a>
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
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-[95rem] mx-auto">
            @foreach ($products as $product)
                <div class="w-full product-card overflow-hidden rounded-lg group" wire:key="{{ $product->id }}">
                    <div class="bg-white h-full flex flex-col">
                        <div class="relative aspect-square overflow-hidden">
                            <a href="/store/{{ $product->slug }}" wire:navigate class="block h-full">
                                <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}"
                                    class="object-cover w-full h-full transition-transform duration-500 ease-in-out">
                                @if (count($product->images) > 1)
                                    <img src="{{ Storage::url($product->images[1]) }}" alt="{{ $product->name }}"
                                        class="object-cover w-full h-full absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out">
                                @endif
                            </a>
                            <!-- Add to Cart button (desktop only) -->
                            <button wire:click="addToCart({{ $product->id }})"
                                class="absolute bottom-0 left-0 right-0 bg-gray-200/70 backdrop-blur-sm text-black flex items-center justify-center space-x-2 hover:bg-black hover:text-white transition-all duration-500 py-2 opacity-0 group-hover:opacity-100 hidden md:flex add-to-cart-btn">
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
                                    {{ $product->coming_soon ? 'Pre-order' : 'Add to Cart' }}
                                </span>
                                <span wire:loading wire:target="addToCart({{ $product->id }})">
                                    {{ $product->coming_soon ? 'Pre-ordering...' : 'Adding...' }}
                                </span>
                            </button>
                        </div>
                        <div class="p-4 flex-grow">
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-baseline flex-wrap">
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
                                    @if ($product->coming_soon)
                                        <span class="text-sm hidden sm:inline">Coming Soon</span>
                                        <span class="text-sm w-full block sm:hidden mt-1">Coming Soon</span>
                                    @endif
                                </div>
                                <h3 class="text-sm text-gray-700 truncate">
                                    {{ $product->name }}
                                </h3>
                            </div>
                        </div>
                        <!-- Mobile Add to Cart button -->
                        <button wire:click="addToCart({{ $product->id }})"
                            class="w-full text-black flex items-center justify-center space-x-2 hover:text-white hover:bg-black transition-colors duration-200 py-2 md:hidden add-to-cart-btn">
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
                                {{ $product->coming_soon ? 'Pre-order' : 'Add to Cart' }}
                            </span>
                            <span class="text-sm" wire:loading wire:target="addToCart({{ $product->id }})">
                                {{ $product->coming_soon ? 'Pre-ordering...' : 'Adding...' }}
                            </span>
                        </button>
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

        /* Updated styles for the desktop Add to Cart button */
        .product-card .group button {
            transition: opacity 0.3s ease-in-out;
        }


        /* Keep rounded corners only for mobile button */
        @media (max-width: 767px) {
            .product-card button {
                border-bottom-left-radius: 0.5rem;
                border-bottom-right-radius: 0.5rem;
            }
        }

        .add-to-cart-btn {
            color: black;
            transition: color 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .add-to-cart-btn:hover {
            color: white;
            background-color: black;
        }

        /* Remove the .cart-icon specific styles */

        /* ... other styles ... */
    </style>
</div>
