<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Rublevsky Studio' }}</title>

    <meta name="description"
        content="{{ $metaDescription ?? 'Creative design studio specializing in web design and development, branding, photography, and screen printing.' }}">


    @stack('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="preload" href="{{ Vite::asset('resources/fonts/OverusedGrotesk-VF.woff2') }}" as="font"
        type="font/woff2" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="{{ asset('js/loader.js') }}"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <script defer src="https://unpkg.com/split-type"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body style="overflow: hidden; background-color: white;">
    @livewire('partials.navbar')
    <div class="loader-wrap fixed inset-0  flex items-center justify-center bg-white">
        <div class="text-center">
            <div class="w-64 h-1 bg-gray-200 rounded-full overflow-hidden">
                <div class="progress-bar h-full bg-black origin-left transform scale-x-0"></div>
            </div>
            <div class="loader-percent mt-4 text-xl">0%</div>
        </div>
    </div>





    <main>
        {{ $slot }}
    </main>

    @livewireScripts
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')
    <script defer src="{{ asset('js/animations/gsap-text-reading-and-heading.js') }}"></script>
</body>

</html>
