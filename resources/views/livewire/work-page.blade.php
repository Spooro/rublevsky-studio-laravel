{{-- TODO: remove "your browser does not support the video tag" --}}
<div class="relative">
    {{-- Spline viewer section (existing) --}}
    <div class="h-screen">
        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.28/build/spline-viewer.js"></script>
        <spline-viewer loading-anim-type="spinner-big-dark"
            url="https://prod.spline.design/XRydKQhqfpYOjapX/scene.splinecode"></spline-viewer>
    </div>

    {{-- Web Section --}}
    <section id="web">
        <div class="container mx-auto px-4">
            <div class="pb-32 pt-20">
                <h1 class="text-center">Web</h1>
            </div>

            {{-- Africa Power Supply Project --}}
            <div class="mb-24">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="web-description">Website design and development for Africa Power Supply, a fresh
                            Canadian startup planning to revolutionize the African clean energy industry.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] grayscale hover:grayscale-0 transition-all duration-300">
                        </div>
                        <h3><a href="#" class="blur-link">Live website</a></h3>
                    </div>

                    <div class="col-span-12 lg:col-span-4 mb-6 lg:mb-0">
                        <div class="max-w-[300px] mx-auto lg:max-w-none"> <!-- Added this wrapper div -->
                            <a href="#" class="block w-full relative aspect-[9/19.5]">
                                <img src="{{ Storage::disk('r2')->url('iphone-mockup.svg') }}" alt="iPhone Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[3%] w-[94%] h-[94%] object-cover rounded-[12%]" autoplay
                                    loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('aps_iphone.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-8">
                        <div class="lg:sticky lg:top-8">
                            <a href="#" class="block w-full relative aspect-[4/3]">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[5%] w-[90%] h-[90%] object-cover rounded-[5%]" autoplay
                                    loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('aps_tablet.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BeautyFloor Project --}}
            <div class="mb-24">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="web-description">Website design and development for BeautyFloor, a premium flooring
                            company specializing in high-quality laminate and hardwood floors.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] grayscale hover:grayscale-0 transition-all duration-300">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] grayscale hover:grayscale-0 transition-all duration-300">
                        </div>
                        <h3><a href="#" class="blur-link">Live website</a></h3>
                    </div>

                    <div class="col-span-12 lg:col-span-4 mb-6 lg:mb-0">
                        <div class="space-y-4">
                            <img src="{{ Storage::disk('r2')->url('bfloor1.jpg') }}" alt="BeautyFloor Screenshot 1"
                                class="w-full h-auto rounded-lg shadow-md">
                            <img src="{{ Storage::disk('r2')->url('bfloor2.jpg') }}" alt="BeautyFloor Screenshot 2"
                                class="w-full h-auto rounded-lg shadow-md">
                            <div class="relative w-1/2 max-w-[150px] mx-auto -mt-16"> <!-- Modified this line -->
                                <img src="{{ Storage::disk('r2')->url('iphone-mockup.svg') }}" alt="iPhone Mockup"
                                    class="w-full relative z-10">
                                <img src="{{ Storage::disk('r2')->url('bfloor3.jpg') }}" alt="BeautyFloor Screenshot 3"
                                    class="absolute inset-[3%] w-[94%] h-[94%] object-cover rounded-[12%]">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-8">
                        <div class="lg:sticky lg:top-8">
                            <a href="#" class="block w-full relative aspect-[4/3]">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[5%] w-[90%] h-[90%] object-cover rounded-[5%]" autoplay
                                    loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('bfloor_tablet.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 32KARATA Project --}}
            <div class="mb-24">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-6 mb-6 lg:mb-0">
                        <h3 class="web-description">Website design and development for a dentist clinic 32KARATA</h3>
                        <div class="mt-8">
                            <h4>Tools used:</h4>
                            <div class="flex flex-wrap mt-4 mb-6 gap-6">
                                <img src="{{ Storage::disk('r2')->url('spline.png') }}" alt="Spline"
                                    class="h-[1.8rem] grayscale hover:grayscale-0 transition-all duration-300">
                                <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                    class="h-[1.8rem] grayscale hover:grayscale-0 transition-all duration-300">
                            </div>
                            <h3><a href="#" class="blur-link">Live website</a></h3>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-6">
                        <div class="lg:sticky lg:top-8">
                            <a href="#" class="block w-full relative aspect-[4/3]">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[5%] w-[90%] h-[90%] object-cover rounded-[5%]" autoplay
                                    loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('32karata_tablet.mp4') }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FemTech Project --}}
            <div class="mb-24">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="web-description">Website design and development for FemTech, an innovative company
                            focused on women's health technology solutions.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] grayscale hover:grayscale-0 transition-all duration-300">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] grayscale hover:grayscale-0 transition-all duration-300">
                        </div>
                        <h3><a href="#" class="blur-link">Live website</a></h3>
                    </div>

                    <div class="col-span-12 lg:col-span-4 mb-6 lg:mb-0">
                        <div class="max-w-[300px] mx-auto lg:max-w-none"> <!-- Added this wrapper div -->
                            <a href="#" class="block w-full relative aspect-[9/19.5]">
                                <img src="{{ Storage::disk('r2')->url('iphone-mockup.svg') }}" alt="iPhone Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[3%] w-[94%] h-[94%] object-cover rounded-[12%]" autoplay
                                    loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('femtech_iphone.mp4') }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-8">
                        <div class="lg:sticky lg:top-8">
                            <a href="#" class="block w-full relative aspect-[4/3]">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[5%] w-[90%] h-[90%] object-cover rounded-[5%]" autoplay
                                    loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('femtech_tablet.mp4') }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section id="testimonials">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Testimonials</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Testimonial 1 --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p>
                    "We initially faced challenges with our website's design and were unhappy with its look. We
                    contacted Alexander for a redesign, and he exceeded our expectations. As the lead designer, he led
                    the project with a developer he helped us to find, ensuring our vision was realized. Alexander's
                    attention to detail and prompt adjustments were commendable, resulting in a functional and
                    aesthetically pleasing website. Highly recommended."
                </p>
                <div class="flex items-center">
                    <img src="{{ Storage::disk('r2')->url('roman.jpg') }}" alt="Roman Galavura"
                        class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <p class="font-semibold">Roman Galavura</p>
                        <p class="text-sm text-gray-500">CEO at BeautyFloor</p>
                    </div>
                </div>
            </div>

            {{-- Testimonial 2 --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p>
                    "In our interaction I liked Alexander's attentiveness to my requests, detailed analysis of my
                    activity and his desire to find unusual and yet functional design solutions, suitable for the
                    specifics of my work. In addition to design, Alexander was also engaged in website layout, so at the
                    end of our work I received a ready to promote on the Internet business card site with an unusual
                    visual solution, and the necessary functionality."
                </p>
                <div class="flex items-center">
                    <img src="{{ Storage::disk('r2')->url('diana.jpg') }}" alt="Diana Egorova"
                        class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <p class="font-semibold">Diana Egorova</p>
                        <p class="text-sm text-gray-500">CEO at InkSoul</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Screen Printing Section --}}
    <section id="screen-printing">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Screen Printing</h1>
        </div>
        {{-- Add screen printing content here --}}
    </section>

    {{-- Branding Section --}}
    <section id="branding" class="bg-gray-50">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Branding</h1>
        </div>
        <div class="masonry-grid">
            @if (isset($brandingProjects) && is_array($brandingProjects))
                @foreach ($brandingProjects as $project)
                    <div class="masonry-item">
                        <div class="branding-item rounded-lg overflow-hidden"
                            data-images='@json($project['images'] ?? [])'>
                            <img src="{{ Storage::disk('r2')->url($project['previewImage'] ?? 'placeholder.jpg') }}"
                                alt="{{ $project['name'] ?? 'Project' }}" class="w-full h-auto">
                        </div>
                    </div>
                @endforeach
            @else
                <p>No branding projects available.</p>
            @endif
        </div>
    </section>
    @php
        $photos = [
            'hpl_spider.jpg',
            'blue-shirt-guy-1.jpg',
            'blue-shirt-guy-2.jpg',
            'eclipse.jpg',
            'girl-and-goat.jpg',
            'hpl-it-guy.jpg',
            'squirrel-with-a-nut.jpg',
            // Add more photo filenames as needed
        ];
    @endphp
    {{-- Photos Section --}}
    <section id="photos">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Photos</h1>
        </div>
        <div class="masonry-grid">
            @foreach ($photos as $photo)
                <div class="masonry-item">
                    <div class="photo-item rounded-lg overflow-hidden">
                        <img src="{{ Storage::disk('r2')->url($photo) }}" alt="Photo" class="w-full h-auto">
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @php
        $posters = [
            'artlab.jpg',
            'capybara-cave.jpg',
            'cyberpunk-capy.jpg',
            'fencing.jpg',
            'graffiti-bark-abalych-2.jpg',
            'graffiti-bark-abalych.jpg',
            'graffiti-brak-abalych-green.jpg',
            'ice-cold.jpg',
            'madness.jpg',
            'pelevin.jpg',
            'quite.jpg',
            'skate-contest.jpg',
            'thin-and-fragile.jpg',
            // Add more poster filenames as needed
        ];
    @endphp

    {{-- Posters Section --}}
    <section id="posters" class="bg-gray-50">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Posters</h1>
        </div>
        <div class="masonry-grid">
            @foreach ($posters as $poster)
                <div class="masonry-item">
                    <div class="poster-item rounded-lg overflow-hidden">
                        <img src="{{ Storage::disk('r2')->url($poster) }}" alt="Poster" class="w-full h-auto">
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Things Section --}}
    <section id="things">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Things</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($things as $thing)
                <div class="thing-item">
                    <img src="{{ Storage::disk('r2')->url($thing) }}" alt="Thing"
                        class="w-full h-auto rounded-lg shadow-md">
                </div>
            @endforeach
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const brandingItems = document.querySelectorAll('.branding-item');

        brandingItems.forEach(item => {
            const images = JSON.parse(item.dataset.images);
            if (images.length <= 1) return; // Skip if there's only one or no images

            let currentIndex = 0;
            let intervalId = null;
            const previewImage = item.querySelector('img');
            const slideImages = [previewImage.src, ...images.slice(1).map(img =>
                `{{ Storage::disk('r2')->url('') }}${img}`)];

            item.addEventListener('mouseenter', () => {
                startSlideshow();
            });

            item.addEventListener('mouseleave', () => {
                stopSlideshow();
                showImage(0); // Reset to preview image
            });

            function startSlideshow() {
                if (intervalId) clearInterval(intervalId);
                intervalId = setInterval(() => {
                    currentIndex = (currentIndex + 1) % slideImages.length;
                    showImage(currentIndex);
                }, 500);
            }

            function stopSlideshow() {
                if (intervalId) {
                    clearInterval(intervalId);
                    intervalId = null;
                }
            }

            function showImage(index) {
                const newImg = new Image();
                newImg.src = slideImages[index];
                newImg.onload = () => {
                    previewImage.src = newImg.src;
                };
            }
        });
    });
</script>

</body>

</html>
