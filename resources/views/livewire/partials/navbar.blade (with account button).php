<div
    class="fixed inset-x-0 bottom-0 flex justify-center items-center z-[9999] transition-all duration-300 ease-in-out px-2 pb-2">
    <div class="relative inline-flex items-center">
        <!-- User Button (visible on store pages) -->
        <div id="user-menu" class="absolute right-full mr-1 sm:mr-2">
            @if ($isStorePage)
                @guest
                    <a href="{{ route('login') }}" wire:navigate
                        class="whitespace-nowrap flex items-center justify-center h-10 sm:h-12 px-2 sm:px-4 rounded-full text-base sm:text-lg transition-colors duration-200 bg-gray-200/70 backdrop-blur-sm text-gray-700 hover:bg-black/15">
                        Log in
                    </a>
                @endguest
                @auth
                    <div x-data="{ open: false, timeout: null }" @mouseenter="clearTimeout(timeout); open = true"
                        @mouseleave="timeout = setTimeout(() => open = false, 300)" class="relative">
                        <!-- Dropdown menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute bottom-full left-0 mb-2 w-48 bg-gray-200/70 backdrop-blur-sm rounded-md shadow-lg py-1 z-1000">
                            <div class="absolute w-full h-2 bottom-0 translate-y-full"></div>
                            <a href="{{ route('my-account') }}" wire:navigate
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400/50 rounded-md mx-1">
                                My Account
                            </a>
                            <a href="{{ route('my-orders') }}" wire:navigate
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400/50 rounded-md mx-1">
                                My Orders
                            </a>
                            @csrf
                            <a href="/logout"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-400/50 rounded-md mx-1">
                                Log out
                            </a>

                        </div>

                        <!-- User Button -->
                        <button
                            class="whitespace-nowrap flex items-center justify-center h-10 sm:h-12 px-3 sm:px-4 rounded-full text-base sm:text-lg transition-colors duration-200 bg-gray-200/70 backdrop-blur-sm text-black hover:bg-gray-400/50">
                            {{ Auth::user()->name }}
                        </button>
                    </div>
                @endauth
            @endif
        </div>

        <!-- Main Menu (always centered) -->
        <nav class="inline-flex space-x-0.5 sm:space-x-1 bg-gray-200/70 backdrop-blur-sm rounded-full p-1">
            <a href="{{ route('work') }}" wire:navigate
                class="px-2 sm:px-4 py-1 sm:py-1.5 rounded-full text-base sm:text-lg transition-colors duration-200 {{ $currentRoute === 'work' ? 'bg-black text-white' : 'text-black hover:bg-gray-400/50' }}">
                Work
            </a>
            <a href="{{ route('contact') }}" wire:navigate
                class="px-2 sm:px-4 py-1 sm:py-1.5 rounded-full text-base sm:text-lg transition-colors duration-200 {{ $currentRoute === 'contact' ? 'bg-black text-white' : 'text-black hover:bg-gray-400/50' }}">
                Contact
            </a>
            <a href="{{ route('store') }}" wire:navigate
                class="px-2 sm:px-4 py-1 sm:py-1.5 rounded-full text-base sm:text-lg transition-colors duration-200 {{ $currentRoute === 'store' ? 'bg-black text-white' : 'text-black hover:bg-gray-400/50' }}">
                Store
            </a>
        </nav>

        <!-- Cart Button (only on store-related pages) -->
        <div class="absolute left-full ml-1 sm:ml-2">
            @if ($isStorePage)
                <a href="{{ route('cart') }}" wire:navigate
                    class="relative flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full transition-colors duration-200 backdrop-blur-sm p-2 {{ $currentRoute === 'cart' ? 'bg-black text-white' : 'bg-gray-200/70 text-black hover:bg-gray-400/50' }}">
                    <!-- Cart SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                        viewBox="0 0 33 30">
                        <path
                            d="M1.94531 1.80127H7.27113L11.9244 18.602C12.2844 19.9016 13.4671 20.8013 14.8156 20.8013H25.6376C26.9423 20.8013 28.0974 19.958 28.495 18.7154L31.9453 7.9303H19.0041"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="13.4453" cy="27.3013" r="2.5" fill="currentColor" />
                        <circle cx="26.4453" cy="27.3013" r="2.5" fill="currentColor" />
                    </svg>
                    <!-- Cart Counter Badge -->
                    @if ($total_count > 0)
                        <span
                            class="absolute top-0 right-0 -mt-1 -mr-1 bg-black text-white text-xs font-semibold w-4 h-4 sm:w-5 sm:h-5 flex items-center justify-center rounded-full">
                            {{ $total_count }}
                        </span>
                    @endif
                </a>
            @endif
        </div>
    </div>
</div>
