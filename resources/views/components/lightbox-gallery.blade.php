<div x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="closeGallery"
    @keydown.escape.window="closeGallery"
    class="fixed inset-0 z-[10000] flex items-center justify-center bg-black bg-opacity-50 select-none cursor-zoom-out p-4"
    x-cloak x-init="$watch('isOpen', value => document.body.style.overflow = value ? 'hidden' : '')">
    <div class="relative flex items-center justify-center w-full h-full max-w-[calc(100vw-2rem)] max-h-[calc(100vh-2rem)]"
        @click.stop="closeGallery">
        <button @click.stop="prevImage"
            class="absolute left-4 top-1/2 -translate-y-1/2 text-white bg-white/10 w-14 h-14 rounded-full hover:bg-white/20 transition-colors duration-300 z-10">
            <svg class="w-6 h-6 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <div class="w-full h-full flex items-center justify-center">
            <img :src="currentImage" @click.stop
                class="object-contain w-auto h-auto max-w-full max-h-full select-none cursor-zoom-out" alt="">
        </div>
        <button @click.stop="nextImage"
            class="absolute right-4 top-1/2 -translate-y-1/2 text-white bg-white/10 w-14 h-14 rounded-full hover:bg-white/20 transition-colors duration-300 z-10">
            <svg class="w-6 h-6 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>
