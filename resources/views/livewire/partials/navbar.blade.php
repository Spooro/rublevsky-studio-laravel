<div
    class="fixed inset-x-0 bottom-0 flex justify-center items-center z-50 transition-all duration-300 ease-in-out px-2 pb-2">
    <!-- Center Menu -->
    <div id="center-menu" class="flex items-center space-x-2 transition-all duration-300">
        <!-- User Button (only visible on store pages) -->
        <div id="user-menu" class="flex-shrink-0">
            @if ($isStorePage)
                @guest
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center h-12 px-4 rounded-full text-lg transition-colors duration-200 bg-gray-200/70 backdrop-blur-sm text-gray-700 hover:bg-black/15">
                        Log in
                    </a>
                @endguest
                @auth
                    <div class="relative group">
                        <button
                            class="flex items-center justify-center h-12 px-4 rounded-full text-lg transition-colors duration-200 bg-gray-200/70 backdrop-blur-sm text-black hover:bg-gray-400/50">
                            {{ Auth::user()->name }}
                        </button>
                        <!-- Dropdown menu (unchanged) -->
                    </div>
                @endauth
            @endif
        </div>

        <!-- Main Menu (always centered) -->
        <nav class="flex space-x-1 bg-gray-200/70 backdrop-blur-sm rounded-full p-1">
            <a href="{{ route('work') }}" wire:navigate
                class="px-4 py-1.5 rounded-full text-lg transition-colors duration-200 {{ $currentRoute === 'work' ? 'bg-black text-white' : 'text-black hover:bg-gray-400/50' }}">
                Work
            </a>
            <a href="{{ route('contact') }}" wire:navigate
                class="px-4 py-1.5 rounded-full text-lg transition-colors duration-200 {{ $currentRoute === 'contact' ? 'bg-black text-white' : 'text-black hover:bg-gray-400/50' }}">
                Contact
            </a>
            <a href="{{ route('store') }}" wire:navigate
                class="px-4 py-1.5 rounded-full text-lg transition-colors duration-200 {{ $currentRoute === 'store' ? 'bg-black text-white' : 'text-black hover:bg-gray-400/50' }}">
                Store
            </a>
        </nav>

        <!-- Cart Button (only on store-related pages) -->
        @if ($isStorePage)
            <div class="flex-shrink-0">
                <a href="{{ route('cart') }}" wire:navigate
                    class="relative flex items-center justify-center w-12 h-12 rounded-full transition-colors duration-200 backdrop-blur-sm p-2 {{ $currentRoute === 'cart' ? 'bg-black text-white' : 'bg-gray-200/70 text-black hover:bg-gray-400/50' }}">
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
                    <span
                        class="absolute top-1.5 right-1.5 -mt-1 -mr-1 bg-black text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                        {{ $total_count }}
                    </span>
                </a>
            </div>
        @endif
    </div>
</div>
