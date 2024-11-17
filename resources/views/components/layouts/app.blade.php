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
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('js/loader.js') }}"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <script defer src="https://unpkg.com/split-type"></script>

</head>

<body style="background-color: white;">
    @livewire('partials.navbar')






    <main>
        {{ $slot }}
    </main>

    @livewireScripts
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')
    <script defer src="{{ asset('js/animations/gsap-text-reading-and-heading.js') }}"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            // Clean up GSAP ScrollTriggers more selectively
            if (window.ScrollTrigger) {
                ScrollTrigger.getAll().forEach(st => {
                    if (!document.querySelector(st.vars.trigger)) {
                        st.kill();
                    }
                });
            }
        });
    </script>
</body>

</html>
