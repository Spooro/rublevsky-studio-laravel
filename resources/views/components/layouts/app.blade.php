<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HR0B3M8QKP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-HR0B3M8QKP');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="QHS4IzoRkvNVNx7CR3V44UeeN0lK8O22WZJMUhdWY3k" />

    <title>{{ $title ?? 'Rublevsky Studio' }}</title>

    <meta name="description"
        content="{{ $metaDescription ?? 'Creative design studio specializing in web design and development, branding, photography, and screen printing.' }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48" />
    <link rel="icon" href="{{ asset('favicon.svg') }}" sizes="any" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />
    <meta name="apple-mobile-web-app-title" content="Rublevsky" />

    @stack('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <link rel="preload" href="{{ Vite::asset('resources/fonts/OverusedGrotesk-VF.woff2') }}" as="font"
        type="font/woff2" crossorigin>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <script defer src="https://unpkg.com/split-type"></script>
    <script defer src="https://developer-zahid.github.io/Custom-Coverflow-Slider/assets/plugins/swiper/js/swiper.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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
    <script>
        window.storageUrl = "{{ Storage::url('') }}";
    </script>
</body>

</html>
