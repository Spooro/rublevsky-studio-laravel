@props(['name', 'logo', 'wideLogo' => false])

<div class="flex flex-col gap-2">
    <div class="flex items-center justify-center">
        <div class="{{ $wideLogo ? 'w-24 md:w-28 h-12 md:h-14' : 'w-14 md:w-22 h-14 md:h-22' }} relative">
            <img src="{{ Storage::url('logos/' . $logo) }}" alt="{{ $name }}"
                class="absolute inset-0 w-full h-full object-contain hover:opacity-70 transition-opacity">
        </div>
    </div>
    <p class="text-center text-sm md:text-base font-medium whitespace-nowrap">{{ $name }}</p>
</div>
