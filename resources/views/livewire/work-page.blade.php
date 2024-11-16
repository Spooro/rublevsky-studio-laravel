@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://developer-zahid.github.io/Custom-Coverflow-Slider/assets/plugins/swiper/js/swiper.min.js"></script>
@endpush

@push('scripts')
    <script src="{{ asset('js/animations/testimonials-slider.js') }}"></script>
@endpush

<div class="page-with-loader relative lg:pb-36">
    <x-loader wire:ignore />

    <div class=" w-screen h-screen">
        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.28/build/spline-viewer.js"></script>
        <spline-viewer loading-anim-type="spinner-big-dark"
            url="https://prod.spline.design/XRydKQhqfpYOjapX/scene.splinecode"></spline-viewer>
    </div>


    <section id="web" class="w-full" wire:ignore>
        <div>

            <h1 class="text-center work-page-section-title-holder" heading-reveal>Web</h1>


            {{-- Africa Power Supply Project --}}
            <div class="mb-52">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="large-text-description" reveal-type>Website design and development for Africa Power
                            Supply,
                            a fresh
                            Canadian startup planning to revolutionize the African clean energy industry.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] logo-hover">
                        </div>
                        <h3><a href="https://aps-cb63ae.webflow.io/" class="blur-link" target="_blank">Live website</a>
                        </h3>
                    </div>

                    <div class="col-span-12 lg:col-span-4 mb-6 lg:mb-0">
                        <div class="max-w-[300px] mx-auto lg:max-w-none">
                            <a href="https://aps-cb63ae.webflow.io/" class="block w-full relative aspect-[9/19.5]"
                                target="_blank">
                                <img src="{{ Storage::disk('r2')->url('iphone-mockup.svg') }}" alt="iPhone Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video
                                    class="absolute inset-[3%] bottom-[3.75%] w-[94%] h-[93.25%] object-cover rounded-[12%]"
                                    autoplay loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('aps_iphone.mp4') }}" type="video/mp4"
                                        wire:ignore>
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-8">
                        <div class="lg:sticky lg:top-8">
                            <a href="https://aps-cb63ae.webflow.io/" class="block w-full relative aspect-[4/3]"
                                target="_blank">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[4%] w-[92%] h-[92%] object-cover rounded-[3%]" autoplay
                                    loop muted playsinline wire:ignore>
                                    <source src="{{ Storage::disk('r2')->url('aps_tablet.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-52">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="large-text-description" reveal-type>Website design and development for BeautyFloor, a
                            premium flooring
                            company specializing in high-quality laminate and hardwood floors.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] logo-hover">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] logo-hover">
                        </div>
                        <h3><a href="https://bfloor.ru/" class="blur-link" target="_blank">Live website</a></h3>
                    </div>

                    <div class="col-span-12 lg:col-span-4 mb-6 lg:mb-0">
                        <div class="space-y-4">
                            <img src="{{ Storage::disk('r2')->url('bfloor1.jpg') }}" alt="BeautyFloor Screenshot 1"
                                class="w-[90%] mr-0 h-auto ml-auto rounded-lg ">
                            <img src="{{ Storage::disk('r2')->url('bfloor2.jpg') }}" alt="BeautyFloor Screenshot 2"
                                class="w-[90%] translate-y-[-10%] h-auto ml-0 rounded-lg ">
                            <div class="w-[66%] mr-0 relative translate-y-[-20%]">
                                <a href="https://bfloor.ru/" target="_blank">
                                    <img src="{{ Storage::disk('r2')->url('iphone-mockup.svg') }}" alt="iPhone Mockup"
                                        class="w-full relative z-10">
                                    <img src="{{ Storage::disk('r2')->url('bfloor3.jpg') }}"
                                        alt="BeautyFloor Screenshot 3"
                                        class="absolute inset-[3%] top-[2%] bottom-[3.75%] w-[94%] h-[96%] object-cover rounded-[12%]">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-8">
                        <div class="lg:sticky lg:top-8">
                            <a href="https://bfloor.ru/" class="block w-full relative aspect-[4/3]" target="_blank">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[4%] w-[92%] h-[92%] object-cover rounded-[3%]" autoplay
                                    loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('bfloor_tablet.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-52">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-6 mb-6 lg:mb-0">
                        <h3 class="large-text-description" reveal-type>Website design and development for a dentist
                            clinic 32KARATA</h3>
                        <div class="mt-8">
                            <h4>Tools used:</h4>
                            <div class="flex flex-wrap mt-4 mb-6 gap-6">
                                <img src="{{ Storage::disk('r2')->url('spline.png') }}" alt="Spline"
                                    class="h-[1.8rem] logo-hover">
                                <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                    class="h-[1.8rem] logo-hover">
                            </div>
                            <h3><a href="https://rublevsky-studio.webflow.io/32karata/home" class="blur-link"
                                    target="_blank">Live website</a></h3>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-6">
                        <div class="lg:sticky lg:top-8">
                            <a href="https://rublevsky-studio.webflow.io/32karata/home"
                                class="block w-full relative aspect-[4/3]" target="_blank">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[4%] w-[92%] h-[92%] object-cover rounded-[3%]" autoplay
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
            <div class="mb-52">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="large-text-description" reveal-type>Website design and development for FemTech, an
                            innovative company
                            focused on women's health technology solutions.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] logo-hover">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] logo-hover">
                        </div>
                        <h3><a href="https://www.femtechsearch.com/" class="blur-link" target="_blank">Live
                                website</a></h3>
                    </div>

                    <div class="col-span-12 lg:col-span-4 mb-6 lg:mb-0">
                        <div class="max-w-[300px] mx-auto lg:max-w-none">
                            <a href="https://www.femtechsearch.com/" class="block w-full relative aspect-[9/19.5]"
                                target="_blank">
                                <img src="{{ Storage::disk('r2')->url('iphone-mockup.svg') }}" alt="iPhone Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video
                                    class="absolute inset-[3%] bottom-[4.5%] w-[94%] h-[92.5%] object-cover rounded-[12%]"
                                    autoplay loop muted playsinline>
                                    <source src="{{ Storage::disk('r2')->url('femtech_iphone.mp4') }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-8">
                        <div class="lg:sticky lg:top-8">
                            <a href="https://www.femtechsearch.com/" class="block w-full relative aspect-[4/3]"
                                target="_blank">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[4%] w-[92%] h-[92%] object-cover rounded-[3%]" autoplay
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

            {{-- New entry for personal website --}}
            <div class="mb-0">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 flex justify-center items-center">
                        <div class="max-w-3xl mx-auto text-center">
                            <h3 class="large-text-description" reveal-type>Rublevsky Studio was created using <strong
                                    class="font-semibold">Laravel</strong>, <strong
                                    class="font-semibold">Alpine.js</strong>, and <strong
                                    class="font-semibold">Tailwind</strong></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="testimonials" class="no-padding" wire:ignore>

        <h1 class="text-center work-page-section-title-holder" heading-reveal>Testimonials</h1>

        <div class="swiper tinyflow-slider" data-rotate="5" data-speed="500">
            <div class="swiper-wrapper">
                <div class="swiper-slide tinyflow-slide">
                    <div class="testimonial-card">
                        <p class="mb-6">
                            "We initially faced challenges with our website's design and were unhappy with its look. We
                            contacted Alexander for a redesign, and he exceeded our expectations. As the lead designer,
                            he led
                            the project with a developer he helped us to find, ensuring our vision was realized."
                        </p>
                        <a href="https://www.instagram.com/beautyfloor_vl/" target="_blank" rel="noopener noreferrer"
                            class="flex items-center group transition-transform duration-300 ease-in-out transform hover:translate-y-[-5px]">
                            <img src="{{ Storage::disk('r2')->url('roman.jpg') }}" alt="Roman Galavura"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <p class="font-semibold group-hover:underline">Roman Galavura</p>
                                <p class="text-sm text-gray-500">CEO at BeautyFloor</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide tinyflow-slide">
                    <div class="testimonial-card">
                        <p class="mb-6">
                            "In our interaction I liked Alexander's attentiveness to my requests, detailed analysis of
                            my
                            activity and his desire to find unusual and yet functional design solutions, suitable for
                            the
                            specifics of my work."
                        </p>
                        <a href="https://www.instagram.com/diana_inksoul/" target="_blank" rel="noopener noreferrer"
                            class="flex items-center group transition-transform duration-300 ease-in-out transform hover:translate-y-[-5px]">
                            <img src="{{ Storage::disk('r2')->url('diana.jpg') }}" alt="Diana Egorova"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <p class="font-semibold group-hover:underline">Diana Egorova</p>
                                <p class="text-sm text-gray-500">CEO at InkSoul</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide tinyflow-slide">
                    <div class="testimonial-card">
                        <p class="mb-6">
                            "I reached out to Alexander to help expand my personal brand, and he assisted with creating
                            merchandise, including clothing, stickers, and posters. I really appreciated his creativity
                            and
                            straightforward approach to the task."
                        </p>
                        <a href="https://www.instagram.com/abalych" target="_blank" rel="noopener noreferrer"
                            class="flex items-center group transition-transform duration-300 ease-in-out transform hover:translate-y-[-5px]">
                            <img src="{{ Storage::disk('r2')->url('kristina-testimonial.jpg') }}" alt="Kristina"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <p class="font-semibold group-hover:underline">Kristina</p>
                                <p class="text-sm text-gray-500">Street Artist</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide tinyflow-slide">
                    <div class="testimonial-card">
                        <p class="mb-6">
                            "Alexander did an outstanding job with pre-press editing and large-format printing of
                            posters that brilliantly showcase my artistic vision. His attention to detail and expertise
                            brought my ideas to life, delivering mind-blowing quality that was absolutely top-notch.
                            Everything was fabulous—from the prints themselves to the entire experience—which has helped
                            elevate my brand presence and supported my music journey immensely."
                        </p>
                        <a href="https://on.soundcloud.com/yBk5X3a4cWA4xnWdA" target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center group transition-transform duration-300 ease-in-out transform hover:translate-y-[-5px]">
                            <img src="{{ Storage::disk('r2')->url('brighton.jpg') }}" alt="Brighton"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <p class="font-semibold group-hover:underline">Brighton</p>
                                <p class="text-sm text-gray-500">Music Artist</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section id="branding" x-data="brandingGallery()">
        <h1 class="text-center work-page-section-title-holder" heading-reveal>Branding</h1>

        <div class="column-layout">
            <template x-for="(project, index) in projects" :key="index">
                <div class="work-visual-item relative group">
                    <div class="branding-item rounded-lg overflow-hidden" @mouseenter="startProjectAnimation(index)"
                        @mouseleave="stopProjectAnimation(index)">
                        <template x-if="project.type !== 'video'">
                            <div>
                                <img :src="getImageUrl(project.images[0])" :alt="project.name"
                                    class="w-full h-auto transition-opacity duration-800 ease-in-out"
                                    :style="{ opacity: currentProjectIndex === index ? 0 : 1 }">
                                <template x-for="(image, imageIndex) in project.images" :key="imageIndex">
                                    <img :src="getImageUrl(image)" :alt="project.name + ' ' + (imageIndex + 1)"
                                        class="w-full h-full object-cover absolute top-0 left-0 transition-opacity duration-800 ease-in-out"
                                        :style="{
                                            opacity: currentProjectIndex === index && currentImageIndex === imageIndex ?
                                                1 : 0
                                        }">
                                </template>
                            </div>
                        </template>
                        <template x-if="project.type === 'video'">
                            <div>
                                <img :src="getImageUrl(project.preview)" :alt="project.name"
                                    class="w-full h-auto transition-opacity duration-800 ease-in-out"
                                    :style="{ opacity: currentProjectIndex === index ? 0 : 1 }">
                                <video :src="getImageUrl(project.src)"
                                    class="w-full h-full object-cover absolute top-0 left-0 transition-opacity duration-800 ease-in-out"
                                    :style="{ opacity: currentProjectIndex === index ? 1 : 0 }" loop muted
                                    x-ref="video" @mouseenter="$event.target.play()"
                                    @mouseleave="$event.target.pause(); $event.target.currentTime = 0;">
                                </video>
                            </div>
                        </template>
                    </div>
                    <div x-show="project.description || project.logo" class="work-visual-item-overlay">
                        <div class="work-visual-item-overlay-content">
                            <p x-show="project.description" x-text="project.description"
                                class="work-visual-item-overlay-description"></p>
                            <img x-show="project.logo" :src="getImageUrl(project.logo)" :alt="project.name + ' logo'"
                                class="work-visual-item-overlay-logo">
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </section>


    @php
        $photos = [
            [
                'images' => ['blue-shirt-guy-1.jpg', 'blue-shirt-guy-2.jpg'],
                'description' => 'Staff photography',
                'logo' => 'hpl.svg',
            ],
            ['images' => ['eclipse.jpg'], 'description' => 'Eclipse'],
            ['images' => ['girl-and-goat.jpg'], 'description' => 'March Break Mobile Zoo Program', 'logo' => 'hpl.svg'],
            ['images' => ['squirrel-with-a-nut.jpg'], 'store-link' => 'squirrel-sticker'],
            ['images' => ['dinner-3-people.jpg']],
            ['images' => ['squirrel-on-box.jpg', 'squirrel-fence.jpg']],
            ['images' => ['goose-water.jpg']],
            ['images' => ['bird.jpg']],
            ['images' => ['bebra.jpg']],
            ['images' => ['zaiika.jpg', 'rabbit-yellow.jpg']],
        ];

        $posters = [
            ['images' => ['artlab.jpg'], 'description' => 'ArtLab poster'],
            ['images' => ['capybara-cave.jpg'], 'description' => 'Capybara in a cave'],
            ['images' => ['cyberpunk-capy.jpg']],
            ['images' => ['fencing.jpg']],
            [
                'images' => ['graffiti-bark-abalych-second.jpg', 'graffiti-bark-abalych-second-preview.jpg'],
                'store-link' => 'graffiti-bark-sticker-20',
            ],
            ['images' => ['graffiti-brak-abalych-green.jpg']],
            ['images' => ['ice-cold.jpg']],
            ['images' => ['madness.jpg']],
            ['images' => ['pelevin.jpg']],
            ['images' => ['quite.jpg']],
            ['images' => ['skate-contest.jpg']],
            ['images' => ['thin-and-fragile.jpg']],
            ['images' => ['painting.jpg'], 'description' => 'Painting'],
        ];
    @endphp


    <section id="photos" x-data="imageGallery('photos', @js($photos))">

        <h1 class="text-center work-page-section-title-holder" heading-reveal>Photos</h1>

        <div class="column-layout">
            <template x-for="(photo, index) in images" :key="index">
                <div class="work-visual-item relative group cursor-zoom-in" @click="openGallery(index)">
                    <div class="photo-item">
                        <img :src="getImageUrl(photo.images[0])" :alt="'Photo ' + (index + 1)"
                            class="w-full h-auto transition-all duration-300 ease-in-out">
                        <template x-if="photo.images.length > 1">
                            <img :src="getImageUrl(photo.images[1])" :alt="'Photo ' + (index + 1) + ' (hover)'"
                                class="w-full h-full object-cover absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100">
                        </template>
                    </div>
                    <a x-show="photo['store-link']" :href="getStoreUrl(photo['store-link'])"
                        class="store-link-button" @click.stop>
                        Buy
                    </a>
                    <div x-show="photo.description || photo.logo" class="work-visual-item-overlay">
                        <div class="work-visual-item-overlay-content">
                            <p x-show="photo.description" x-text="photo.description"
                                class="work-visual-item-overlay-description"></p>
                            <img x-show="photo.logo" :src="getImageUrl(photo.logo)"
                                :alt="'Photo ' + (index + 1) + ' logo'" class="work-visual-item-overlay-logo">
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <x-lightbox-gallery />
    </section>


    <section id="posters" x-data="imageGallery('posters', @js($posters))">

        <h1 class="text-center work-page-section-title-holder" heading-reveal>Posters</h1>

        <div class="column-layout">
            <template x-for="(poster, index) in images" :key="index">
                <div class="work-visual-item relative group cursor-zoom-in" @click="openGallery(index)">
                    <div class="photo-item">
                        <img :src="getImageUrl(poster.images[0])" :alt="'Poster ' + (index + 1)"
                            class="w-full h-auto transition-all duration-300 ease-in-out">
                        <template x-if="poster.images.length > 1">
                            <img :src="getImageUrl(poster.images[1])" :alt="'Poster ' + (index + 1) + ' (hover)'"
                                class="w-full h-full object-cover absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100">
                        </template>
                    </div>
                    <a x-show="poster['store-link']" :href="getStoreUrl(poster['store-link'])"
                        class="store-link-button" @click.stop>
                        Buy
                    </a>
                    <div x-show="poster.description || poster.logo" class="work-visual-item-overlay">
                        <div class="work-visual-item-overlay-content">
                            <p x-show="poster.description" x-text="poster.description"
                                class="work-visual-item-overlay-description"></p>
                            <img x-show="poster.logo" :src="getImageUrl(poster.logo)"
                                :alt="'Poster ' + (index + 1) + ' logo'" class="work-visual-item-overlay-logo">
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <x-lightbox-gallery />
    </section>

</div>



<script>
    function getImageUrl(image) {
        return `{{ Storage::disk('r2')->url('') }}${image}`;
    }

    function getStoreUrl(productSlug) {
        // Get the current domain and append the store path
        return `${window.location.origin}/store/${productSlug}`;
    }

    function imageGallery(type, images) {
        return {
            type,
            images,
            isOpen: false,
            currentIndex: 0,
            currentImageIndex: 0,
            get currentImage() {
                return this.images[this.currentIndex].images[this.currentImageIndex];
            },
            openGallery(index) {
                this.currentIndex = index;
                this.currentImageIndex = 0;
                this.isOpen = true;
            },
            closeGallery() {
                this.isOpen = false;
            },
            nextImage() {
                if (this.currentImageIndex < this.images[this.currentIndex].images.length - 1) {
                    this.currentImageIndex++;
                } else {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                    this.currentImageIndex = 0;
                }
            },
            prevImage() {
                if (this.currentImageIndex > 0) {
                    this.currentImageIndex--;
                } else {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                    this.currentImageIndex = this.images[this.currentIndex].images.length - 1;
                }
            }
        }
    }

    function brandingGallery() {
        return {
            projects: [{
                    name: 'Yin Yan Graffiti',
                    type: 'image',
                    images: ['yin-yan-shirt-1.jpg', 'yin-yan-shirt-2.jpg',
                        'yin-yan-shirt-5.jpg', 'yin-yan-shirt-4.jpg', 'yin-yan-shirt-6.jpg',
                        'yin-yan-shirt-3.jpg',
                    ],

                    description: 'Screen Printing a Custom Design',
                },
                {
                    name: 'Chick-fil-A',
                    type: 'image',
                    images: ['1-chickfila.jpg', '2-chickfila.jpg', '3-chickfila.jpg', '4-chickfila.jpg',
                        '5-chickfila.jpg'
                    ],
                    description: 'Branding project for Chick-fil-A',
                },
                {
                    name: 'Adobe',
                    type: 'image',
                    images: ['1-adobe.jpg', '2-adobe.jpg', '3-adobe.jpg'],
                    description: 'Design work for Adobe',
                },
                {
                    name: 'Chrysalis',
                    type: 'image',
                    images: ['1-chrysalis.jpg', '2-chrysalis.jpg'],
                    description: 'Branding for Chrysalis',
                    logo: 'hpl.svg'
                },
                {
                    name: 'Cayuga',
                    type: 'image',
                    images: ['1-cayuga.jpg', '2-cayuga.jpg', '3-cayuga.jpg'],
                    description: 'Cayuga project'
                },
                {
                    name: 'Nutrition Box',
                    type: 'image',
                    images: ['1-nutrition-box.jpg', '2-nutrition-box.jpg', '3-nutrition-box.jpg',
                        '4-nutrition-box.jpg', '5-nutrition-box.jpg', '6-nutrition-box.jpg'
                    ],
                    description: 'Nutrition Box branding'
                },
                {
                    name: 'Emmanuel',
                    type: 'image',
                    images: ['1-emmanuel.jpg', '2-emmanuel.jpg'],
                    description: 'Emmanuel project'
                },
                {
                    name: 'HPL',
                    type: 'video',
                    preview: 'hpl-animation-preview.jpg',
                    src: 'hpl-animation.mp4',
                    description: 'HPL animation project',
                    logo: 'hpl.svg'
                },
                {
                    name: 'Querido',
                    type: 'image',
                    images: ['1-querido.jpg', '2-querido.jpg', '3-querido.jpg', '4-querido.jpg'],
                    description: 'Querido branding project'
                },
                {
                    name: 'Design Shirt',
                    type: 'image',
                    images: ['1-design-shirt.jpg', '2-design-shirt.jpg'],
                    description: 'Design Shirt project'
                }
            ],
            currentProjectIndex: null,
            currentImageIndex: 0,
            animationInterval: null,

            startProjectAnimation(index) {
                this.currentProjectIndex = index;
                const project = this.projects[index];
                if (project.type !== 'video') {
                    // Immediately show the second image
                    this.currentImageIndex = 1;

                    // Start the interval immediately
                    this.animationInterval = setInterval(() => {
                        this.currentImageIndex = (this.currentImageIndex + 1) % project.images.length;
                    }, 800);
                }
            },

            stopProjectAnimation(index) {
                clearInterval(this.animationInterval);
                this.currentProjectIndex = null;
                this.currentImageIndex = 0;
            }
        }
    }
</script>

<script src="{{ asset('js/animations/gsap-section-progress.js') }}"></script>
