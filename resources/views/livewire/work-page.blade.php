<div class="relative lg:pb-36">
    {{-- <x-loader wire:ignore /> --}}

    <div class="relative w-screen h-screen">
        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.28/build/spline-viewer.js"></script>
        <spline-viewer loading-anim-type="spinner-big-dark"
            url="https://prod.spline.design/XRydKQhqfpYOjapX/scene.splinecode"></spline-viewer>

        <!-- Change the gradient overlay -->
        <div class="absolute bottom-0 left-0 right-0 h-[12rem] bg-gradient-to-t from-white via-white/70 to-transparent">
        </div>
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
                            <img src="{{ Storage::disk('r2')->url('logos/webflow-text.svg') }}" alt="Webflow"
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
                                    autoplay loop muted playsinline loading="lazy" wire:ignore>
                                    <source src="{{ Storage::disk('r2')->url('aps_iphone.mp4') }}" type="video/mp4">
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
                                    loop muted playsinline wire:ignore loading="lazy">
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
                            <img src="{{ Storage::disk('r2')->url('logos/figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] logo-hover">
                            <img src="{{ Storage::disk('r2')->url('logos/webflow-text.svg') }}" alt="Webflow"
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
                                    loop muted playsinline loading="lazy" wire:ignore>
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
                                <img src="{{ Storage::disk('r2')->url('logos/webflow-text.svg') }}" alt="Webflow"
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
                                    loop muted playsinline loading="lazy" wire:ignore>
                                    <source src="{{ Storage::disk('r2')->url('32karata_tablet.mp4') }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- After 32KARATA project and before FemTech project, add: --}}

            <div class="mb-52">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="large-text-description" reveal-type>Website design and development for InkSoul, a
                            Tattoo studio with a grounded, personalized approach, specializing in graphical and
                            ornamental styles</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('logos/figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] logo-hover">
                            <img src="{{ Storage::disk('r2')->url('logos/webflow-text.svg') }}" alt="Webflow"
                                class="h-[1.8rem] logo-hover">
                        </div>
                        <h3><a href="https://inksoul.webflow.io/" class="blur-link" target="_blank">Live website</a>
                        </h3>
                    </div>

                    <div class="col-span-12 lg:col-span-4 mb-6 lg:mb-0">
                        <div class="max-w-[300px] mx-auto lg:max-w-none">
                            <a href="https://inksoul.webflow.io/" class="block w-full relative aspect-[9/19.5]"
                                target="_blank">
                                <img src="{{ Storage::disk('r2')->url('iphone-mockup.svg') }}" alt="iPhone Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video
                                    class="absolute inset-[3%] bottom-[3.75%] w-[94%] h-[93.25%] object-cover rounded-[12%]"
                                    autoplay loop muted playsinline loading="lazy" wire:ignore>
                                    <source src="{{ Storage::disk('r2')->url('inksoul-iphone.mp4') }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-8">
                        <div class="lg:sticky lg:top-8">
                            <a href="https://inksoul.webflow.io/" class="block w-full relative aspect-[4/3]"
                                target="_blank">
                                <img src="{{ Storage::disk('r2')->url('ipad-mockup.svg') }}" alt="iPad Mockup"
                                    class="absolute inset-0 w-full h-full object-contain z-10">
                                <video class="absolute inset-[4%] w-[92%] h-[92%] object-cover rounded-[3%]" autoplay
                                    loop muted playsinline loading="lazy" wire:ignore>
                                    <source src="{{ Storage::disk('r2')->url('inksoul-tablet.mp4') }}"
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
                            <img src="{{ Storage::disk('r2')->url('logos/figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] logo-hover">
                            <img src="{{ Storage::disk('r2')->url('logos/webflow-text.svg') }}" alt="Webflow"
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
                                    autoplay loop muted playsinline loading="lazy" wire:ignore>
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
                                    loop muted playsinline loading="lazy" wire:ignore>
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
                        <div class="mx-auto text-center">
                            <h2 class="large-text-description" reveal-type>Rublevsky Studio was created using
                                <strong class="font-semibold">Laravel</strong>, <strong
                                    class="font-semibold">Alpine.js</strong>, and <strong
                                    class="font-semibold">Tailwind</strong>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="testimonials" class="no-padding">

        <h1 class="text-center work-page-section-title-holder" heading-reveal>Testimonials</h1>

        <div wire:ignore>
            <div class="swiper tinyflow-slider" data-rotate="5" data-speed="500">
                <div class="swiper-wrapper">
                    <div class="swiper-slide tinyflow-slide">
                        <div class="testimonial-card">
                            <p class="mb-6">
                                "We initially faced challenges with our website's design and were unhappy with its look.
                                We
                                contacted Alexander for a redesign, and he exceeded our expectations. As the lead
                                designer,
                                he led
                                the project with a developer he helped us to find, ensuring our vision was realized."
                            </p>
                            <a href="https://www.instagram.com/beautyfloor_vl/" target="_blank"
                                rel="noopener noreferrer"
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
                                "In our interaction I liked Alexander's attentiveness to my requests, detailed analysis
                                of
                                my
                                activity and his desire to find unusual and yet functional design solutions, suitable
                                for
                                the
                                specifics of my work."
                            </p>
                            <a href="https://www.instagram.com/diana_inksoul/" target="_blank"
                                rel="noopener noreferrer"
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
                                "I reached out to Alexander to help expand my personal brand, and he assisted with
                                creating
                                merchandise, including clothing, stickers, and posters. I really appreciated his
                                creativity
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
                                posters that brilliantly showcase my artistic vision. His attention to detail and
                                expertise
                                brought my ideas to life, delivering mind-blowing quality that was absolutely top-notch.
                                Everything was fabulous—from the prints themselves to the entire experience—which has
                                helped
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
        </div>
    </section>


    <section id="branding" x-data="brandingGallery()">
        <h1 class="text-center work-page-section-title-holder" heading-reveal>Branding</h1>

        <div class="column-layout">
            <template x-for="(project, index) in projects" :key="index">
                <div class="work-visual-item relative group">
                    <div class="branding-item rounded-lg overflow-hidden cursor-pointer"
                        @mouseenter="startProjectAnimation(index)" @mouseleave="stopProjectAnimation(index)"
                        @click="openModal(index)">
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
                                    :style="{ opacity: currentProjectIndex === index ? 1 : 0 }" loop muted playsinline
                                    @mouseenter="$el.play()" @mouseleave="$el.pause(); $el.currentTime = 0;"
                                    wire:ignore>
                                </video>
                            </div>
                        </template>
                    </div>
                    <div x-show="project.description || project.toolLogos || project.companyLogos"
                        class="work-visual-item-overlay">
                        <div class="work-visual-item-overlay-content">
                            <p x-show="project.description" x-text="project.description"
                                class="work-visual-item-overlay-description"></p>
                            <div x-show="project.toolLogos || project.companyLogos" class="flex gap-2">
                                <template
                                    x-for="(logo, logoIndex) in [...(project.toolLogos || []), ...(project.companyLogos || [])]"
                                    :key="logoIndex">
                                    <img :src="getImageUrl(logo)" :alt="project.name + ' logo ' + (logoIndex + 1)"
                                        class="work-visual-item-overlay-logo">
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Project Modal -->
        <div x-show="isModalOpen" class="fixed inset-0 z-50" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" @click="closeModal"></div>

            <!-- Modal Content -->
            <div class="fixed inset-x-0 bottom-0 top-4 md:top-10 bg-white rounded-t-2xl flex flex-col overflow-hidden"
                x-show="isModalOpen" x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">

                <!-- Close Button -->
                <button @click="closeModal"
                    class="absolute top-4 right-4 text-black bg-black/10 w-14 h-14 rounded-lg hover:bg-black/20 transition-colors duration-300 z-[60]">
                    <svg class="w-6 h-6 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Scrollable Content -->
                <div class="overflow-y-auto flex-1">
                    <template x-if="selectedProject">
                        <div class="p-6 pb-24 lg:flex lg:gap-8">
                            <!-- Project Images Gallery or Video -->
                            <div class="relative mb-8 lg:mb-0 lg:sticky lg:top-6 lg:flex-1 min-w-0">
                                <template x-if="selectedProject.type === 'video'">
                                    <div
                                        class="relative  h-[60vh] md:h-[65vh]  bg-gray-100 rounded-lg overflow-hidden">
                                        <video class="w-full h-full object-cover" autoplay loop muted playsinline>
                                            <source :src="getImageUrl(selectedProject.src)" type="video/mp4">
                                        </video>
                                    </div>
                                </template>

                                <template x-if="selectedProject.type !== 'video'">
                                    <div>
                                        <div class="relative">
                                            <!-- Main Image -->
                                            <div class="h-[60vh] md:h-[65vh] bg-gray-100 rounded-lg overflow-hidden">
                                                <template x-for="(image, index) in selectedProject.images"
                                                    :key="index">
                                                    <img :src="getImageUrl(image)"
                                                        :alt="selectedProject.name + ' image ' + (index + 1)"
                                                        class="absolute inset-0 w-full h-full object-contain transition-opacity duration-300"
                                                        :class="modalImageIndex === index ? 'opacity-100' : 'opacity-0'">
                                                </template>
                                            </div>

                                            <!-- Navigation Arrows -->
                                            <button @click="prevModalImage"
                                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-lg transition-all"
                                                x-show="selectedProject.images.length > 1">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                            </button>
                                            <button @click="nextModalImage"
                                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-lg transition-all"
                                                x-show="selectedProject.images.length > 1">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </button>

                                            <!-- Image Counter -->
                                            <div class="absolute bottom-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-sm"
                                                x-show="selectedProject.images.length > 1">
                                                <span x-text="modalImageIndex + 1"></span>/<span
                                                    x-text="selectedProject.images.length"></span>
                                            </div>
                                        </div>

                                        <!-- Thumbnail Navigation -->
                                        <div class="mt-6" x-show="selectedProject.images.length > 1">
                                            <div class="overflow-x-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]"
                                                x-ref="thumbnailContainer">
                                                <div class="flex gap-4 p-2">
                                                    <template x-for="(image, index) in selectedProject.images"
                                                        :key="index">
                                                        <button
                                                            @click="modalImageIndex = index; $nextTick(() => scrollThumbnailIntoView())"
                                                            class="relative flex-shrink-0 w-20 aspect-square rounded-lg transition-all hover:scale-105"
                                                            :class="modalImageIndex === index ?
                                                                'ring-2 ring-black ring-offset-2' :
                                                                ''"
                                                            :id="'modal-thumb-' + index">
                                                            <img :src="getImageUrl(image)"
                                                                :alt="selectedProject.name + ' thumbnail ' + (index + 1)"
                                                                class="w-full h-full object-cover rounded-lg">
                                                        </button>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Project Info -->
                            <div class="lg:w-[45ch] lg:shrink-0 lg:pr-6">
                                <h2 class="text-2xl font-bold mb-4" x-text="selectedProject.name"></h2>

                                <!-- Project Description -->
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold mb-2">About the Project</h3>
                                    <p x-text="selectedProject.description" class="text-gray-700"></p>
                                </div>

                                <!-- Tools Used -->
                                <div x-show="selectedProject.toolLogos">
                                    <h3 class="text-xl font-semibold mb-4">Tools Used</h3>
                                    <div class="flex gap-4">
                                        <template x-for="(logo, index) in selectedProject.toolLogos"
                                            :key="index">
                                            <img :src="getImageUrl(logo)" :alt="'Tool ' + (index + 1)"
                                                class="h-8 w-auto">
                                        </template>
                                    </div>
                                </div>

                                <!-- Made For -->
                                <div x-show="selectedProject.companyLogos" class="mt-8">
                                    <h3 class="text-xl font-semibold mb-4">Made For</h3>
                                    <div class="flex gap-4">
                                        <template x-for="(logo, index) in selectedProject.companyLogos"
                                            :key="index">
                                            <img :src="getImageUrl(logo)" :alt="'Company ' + (index + 1)"
                                                class="h-8 w-auto">
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
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
                    toolLogos: ['logos/illustrator.svg', 'logos/photoshop.svg']
                },
                {
                    name: 'Chick-fil-A',
                    type: 'image',
                    images: ['1-chickfila.jpg', '2-chickfila.jpg', '3-chickfila.jpg', '4-chickfila.jpg',
                        '5-chickfila.jpg'
                    ],
                    description: 'Branding project for Chick-fil-A',
                    toolLogos: ['logos/illustrator.svg', 'logos/indesisgn.svg'],
                },
                {
                    name: 'Adobe',
                    type: 'image',
                    images: ['1-adobe.jpg', '2-adobe.jpg', '3-adobe.jpg'],
                    description: 'Design work for Adobe',
                    toolLogos: ['logos/illustrator.svg', 'logos/indesisgn.svg'],
                },
                {
                    name: 'Chrysalis',
                    type: 'image',
                    images: ['1-chrysalis.jpg', '2-chrysalis.jpg'],
                    description: 'Branding for Chrysalis',
                    toolLogos: ['logos/photoshop.svg'],
                    companyLogos: ['logos/hpl.svg']
                },
                {
                    name: 'Cayuga',
                    type: 'image',
                    images: ['1-cayuga.jpg', '2-cayuga.jpg', '3-cayuga.jpg'],
                    description: 'Cayuga project',
                    toolLogos: ['logos/illustrator.svg'],
                },
                {
                    name: 'Nutrition Box',
                    type: 'image',
                    images: ['1-nutrition-box.jpg', '2-nutrition-box.jpg', '3-nutrition-box.jpg',
                        '4-nutrition-box.jpg', '5-nutrition-box.jpg', '6-nutrition-box.jpg'
                    ],
                    description: 'Nutrition Box branding',
                    toolLogos: ['logos/illustrator.svg', 'logos/indesisgn.svg'],
                },
                {
                    name: 'Emmanuel',
                    type: 'image',
                    images: ['2-emmanuel.jpg', '1-emmanuel.jpg'],
                    description: 'Emmanuel project',
                    toolLogos: ['logos/indesisgn.svg'],
                },
                {
                    name: 'HPL',
                    type: 'video',
                    preview: 'hpl-animation-preview.jpg',
                    src: 'hpl-animation.mp4',
                    description: 'HPL animation project',
                    toolLogos: ['logos/photoshop.svg', 'logos/aftereffects.svg'],
                    companyLogos: ['logos/hpl.svg']
                },
                {
                    name: 'Querido',
                    type: 'image',
                    images: ['1-querido.jpg', '2-querido.jpg', '3-querido.jpg', '4-querido.jpg'],
                    description: 'Querido branding project',
                    toolLogos: ['logos/illustrator.svg'],

                },
                {
                    name: 'Design Shirt',
                    type: 'image',
                    images: ['1-design-shirt.jpg', '2-design-shirt.jpg'],
                    description: 'Design Shirt project',
                    toolLogos: ['logos/illustrator.svg']
                }
            ],
            currentProjectIndex: null,
            currentImageIndex: 0,
            animationInterval: null,
            isModalOpen: false,
            selectedProject: null,
            modalImageIndex: 0,

            startProjectAnimation(index) {
                this.currentProjectIndex = index;
                const project = this.projects[index];
                if (project.type !== 'video') {
                    this.currentImageIndex = 1;
                    this.animationInterval = setInterval(() => {
                        this.currentImageIndex = (this.currentImageIndex + 1) % project.images.length;
                    }, 800);
                }
            },

            stopProjectAnimation(index) {
                clearInterval(this.animationInterval);
                this.currentProjectIndex = null;
                this.currentImageIndex = 0;
            },

            openModal(index) {
                this.selectedProject = this.projects[index];
                this.isModalOpen = true;
                this.modalImageIndex = 0;
                document.body.style.overflow = 'hidden';
            },

            closeModal() {
                this.isModalOpen = false;
                this.selectedProject = null;
                this.modalImageIndex = 0;
                document.body.style.overflow = '';
            },

            nextModalImage() {
                if (!this.selectedProject) return;
                this.modalImageIndex = (this.modalImageIndex + 1) % this.selectedProject.images.length;
                this.$nextTick(() => {
                    this.scrollThumbnailIntoView();
                });
            },

            prevModalImage() {
                if (!this.selectedProject) return;
                this.modalImageIndex = (this.modalImageIndex - 1 + this.selectedProject.images.length) % this
                    .selectedProject.images.length;
                this.$nextTick(() => {
                    this.scrollThumbnailIntoView();
                });
            },

            scrollThumbnailIntoView() {
                const activeThumb = document.getElementById(`modal-thumb-${this.modalImageIndex}`);
                const container = this.$refs.thumbnailContainer;
                if (activeThumb && container) {
                    const containerWidth = container.offsetWidth;
                    const thumbLeft = activeThumb.offsetLeft;
                    const thumbWidth = activeThumb.offsetWidth;

                    // Calculate the center position
                    const targetScrollLeft = thumbLeft - (containerWidth / 2) + (thumbWidth / 2);

                    container.scrollTo({
                        left: targetScrollLeft,
                        behavior: 'smooth'
                    });
                }
            }
        }
    }
</script>
