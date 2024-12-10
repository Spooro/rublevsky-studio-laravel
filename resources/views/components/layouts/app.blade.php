<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5BFB5VPN');
    </script>
    <!-- End Google Tag Manager -->

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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BFB5VPN" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


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
