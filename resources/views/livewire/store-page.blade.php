<div>
    <!-- filters -->
    <nav class="fixed top-0 left-0 right-0 z-10 mb-6 bg-transparent backdrop-blur-md w-full">
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
                class="flex flex-wrap items-center gap-2 transition-all duration-300">
                <!-- Sort -->
                <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <button
                        class="filter-container flex items-center justify-between backdrop-blur-sm rounded-full px-2 sm:px-4 h-10 text-slate-800 hover:text-slate-900 shadow-inner whitespace-nowrap text-base sm:text-lg"
                        :aria-expanded="open">
                        <span class="pl-2">{{ $sortOptions[$sort] }}</span>
                        <svg class="w-3 h-3 mr-2 fill-slate-500 ml-2" xmlns="http://www.w3.org/2000/svg" width="12"
                            height="12">
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
                <div
                    class="filter-container bg-white shadow-inner backdrop-blur-sm rounded-full p-1 w-[200px] h-10 flex-shrink-0">
                    <div class="flex items-center h-full">
                        <span class="text-gray-600 mr-2 ml-3 text-base sm:text-lg">
                            {{ Number::currency($price_range, 'CAD') }}
                        </span>
                        <input type="range" wire:model.live="price_range"
                            class="w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer" min="0"
                            max="550" value="550" step="1">
                    </div>
                </div>

                <!-- Categories -->
                <div :class="{ 'w-full': isWrapped, 'w-auto': !isWrapped }" class="transition-all duration-300">
                    <div
                        class="filter-container bg-white backdrop-blur-sm rounded-full inline-flex space-x-0.5 sm:space-x-1 overflow-x-auto h-10">
                        @foreach ($categories as $category)
                            <button wire:click="toggleCategory({{ $category->id }})"
                                class="px-2 sm:px-4 h-full rounded-full transition-colors duration-200 whitespace-nowrap text-base sm:text-lg
                                       {{ in_array($category->id, $selected_categories) ? 'bg-black text-white' : 'text-gray-700 hover:bg-black/10' }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="my-24">
        <!-- Product list with 1rem padding on each side -->
        <div class="px-4">
            <!-- Product grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-[95rem] mx-auto">
                @foreach ($products as $product)
                    <div class="w-full product-card overflow-hidden rounded-lg" wire:key="{{ $product->id }}">
                        <div class="bg-white h-full flex flex-col">
                            <div class="relative aspect-square overflow-hidden">
                                <a href="/store/{{ $product->slug }}" wire:navigate class="block h-full">

                                    <!--  -->
                                    <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}"
                                        class="object-cover w-full h-full transition-transform duration-500 ease-in-out">
                                    @if (count($product->images) > 1)
                                        <img src="{{ Storage::url($product->images[1]) }}" alt="{{ $product->name }}"
                                            class="object-cover w-full h-full absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out">
                                    @endif
                                </a>
                            </div>
                            <div class="p-4 flex-grow">
                                <div class="flex items-center justify-between gap-2 mb-2">
                                    <h3 class="text-xl text-gray-900 truncate flex-grow">
                                        {{ $product->name }}
                                    </h3>
                                    <span class="text-lg font-light text-black whitespace-nowrap">
                                        {{ Number::currency($product->price, 'CAD') }}
                                    </span>
                                </div>
                            </div>
                            <button wire:click="addToCart({{ $product->id }})"
                                class="w-full text-gray-700 flex items-center justify-center space-x-2 hover:text-white hover:bg-black transition-colors duration-200 py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    viewBox="0 0 33 30">
                                    <path
                                        d="M1.94531 1.80127H7.27113L11.9244 18.602C12.2844 19.9016 13.4671 20.8013 14.8156 20.8013H25.6376C26.9423 20.8013 28.0974 19.958 28.495 18.7154L31.9453 7.9303H19.0041"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <circle cx="13.4453" cy="27.3013" r="2.5" fill="currentColor" />
                                    <circle cx="26.4453" cy="27.3013" r="2.5" fill="currentColor" />
                                </svg>
                                <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to
                                    Cart</span>
                                <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-6">
                {{ $products->links() }}
            </div>
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

        .product-card button {
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        /* Other styles remain unchanged */
    </style>
</div>
