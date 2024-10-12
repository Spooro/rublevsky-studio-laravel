@props(['name', 'images', 'description', 'class' => ''])

<div x-data="brandingCard('{{ $name }}', {{ json_encode($images) }}, '{{ $description }}')"
    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group {{ $class }}"
    @mouseenter="startSlideshow" @mouseleave="stopSlideshow"
    @click="$dispatch('open-modal', { name, images, description })">
    <img :src="currentImage" :alt="name" class="w-full h-full object-cover transition-opacity duration-100"
        :style="{ opacity: transitioning ? 0 : 1 }">
    <div
        class="absolute inset-x-0 bottom-0 h-16 bg-white/70 backdrop-blur-sm flex items-center px-4
                opacity-0 transition-opacity duration-150 ease-in-out
                group-hover:opacity-100">
        <h3 class="text-black" x-text="name"></h3>
    </div>
</div>
