<div
    class="fixed inset-x-0 bottom-0 flex flex-col items-center z-[9999] transition-all duration-300 ease-in-out px-2 pb-2 pointer-events-none">
    <!-- Anchors -->
    @if (count($anchors) > 0)
        <div class="flex flex-wrap justify-center gap-1 mb-0.5 sm:mb-1 pointer-events-auto">
            @foreach ($anchors as $anchor)
                <a href="{{ $anchor['href'] }}"
                    @if (!($anchor['isExternal'] ?? false)) onclick="event.preventDefault(); document.querySelector('{{ $anchor['href'] }}').scrollIntoView({ behavior: 'smooth' })" @endif
                    target="{{ $anchor['isExternal'] ?? false ? '_blank' : '_self' }}"
                    class="px-4 py-1.5 rounded-full smaller-text transition-colors duration-200
                        {{ $anchor['isAccent'] ?? false
                            ? 'bg-[var(--accent-color)] text-black hover:bg-black hover:text-[var(--accent-color)]'
                            : 'glass-background text-black hover:bg-gray-400/50' }}">
                    {{ $anchor['label'] }}
                </a>
            @endforeach
        </div>
    @endif

    <div class="relative inline-flex items-center pointer-events-auto">
        <!-- Main Menu (always centered) -->
        <nav class="inline-flex space-x-0.5 sm:space-x-1 glass-background rounded-full p-1">
            <a href="{{ route('work') }}" wire:navigate
                class="px-2 sm:px-3 py-1 rounded-full text-sm sm:text-base transition-colors duration-200 {{ $currentRoute === 'work' ? 'nav-link-active' : 'nav-link' }}">
                Work
            </a>
            <a href="{{ route('contact') }}" wire:navigate
                class="px-2 sm:px-3 py-1 rounded-full text-sm sm:text-base transition-colors duration-200 {{ $currentRoute === 'contact' ? 'nav-link-active' : 'nav-link' }}">
                Contact
            </a>
            <a href="{{ route('store') }}" wire:navigate
                class="px-2 sm:px-3 py-1 rounded-full text-sm sm:text-base transition-colors duration-200 {{ $currentRoute === 'store' ? 'nav-link-active' : 'nav-link' }}">
                Store
            </a>
            {{-- <a href="{{ route('blog') }}" wire:navigate
                class="px-2 sm:px-3 py-1 rounded-full text-sm sm:text-base transition-colors duration-200 {{ $currentRoute === 'blog' ? 'nav-link-active' : 'nav-link' }}">
                Blog
            </a> --}}

        </nav>

        <!-- Cart Button -->
        <div class="absolute left-full ml-1">
            @if ($isStorePage)
                <a href="{{ route('cart') }}" wire:navigate
                    class="relative flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 glass-background rounded-full {{ $currentRoute === 'cart' ? 'nav-link-active' : 'nav-link' }}">
                    <!-- Cart SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 sm:w-6 sm:h-6" fill="none"
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
                            class="absolute top-0 right-0 -mt-1 -mr-1 bg-black text-white text-xs font-semibold w-3.5 h-3.5 sm:w-4 sm:h-4 flex items-center justify-center rounded-full">
                            {{ $total_count }}
                        </span>
                    @endif
                </a>
            @endif
        </div>

        <!-- Progress Indicator -->
        @if ($currentRoute === 'blog.post')
            <div class="absolute left-full ml-1">
                <div class="inline-flex glass-background rounded-full p-1">
                    <div class="px-1 sm:px-2 py-1 text-sm sm:text-base text-black">
                        <span class="progress"></span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Add this script section at the bottom -->
    <script>
        document.addEventListener('livewire:navigated', () => {
            if (window.initScrollProgress) {
                window.initScrollProgress();
            }
        });
    </script>
</div>
