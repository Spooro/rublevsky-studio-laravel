{{-- TODO: remove "your browser does not support the video tag" --}}

{{-- TODO:

implement redis caching?

Beauty Floor Project:
	•	Reposition screenshots to be slightly overlapping, creating a stacked effect.

	4.	Custom Cursor:
	•	Implement a custom cursor across the site.

	5.	Loader:
	•	Add a loading animation or loader to the site.


	•	Add content to the Things section.

	9.	Contact Page:
	•	Mention Laravel experience on the Contact page.

	•	Add bottom margin to every web project

    7. Beauty Floor Screenshots:
   • Adjust the layout so that the Beauty Floor screenshots slightly overlap each other for visual effect.
   • Increase the size of the mobile screenshot for better prominence.
8. Testimonial Animations:
   • Add a revealing animation for the testimonials to create a dynamic appearance when scrolling or loading.
9. HPL Logo Animation:
   • Add the Hamilton Public Library (HPL) logo into the branding section animation.
   • Include the HPL logo in the photos you took for HPL as well.
10. Hover Effects:
   • Implement hover-down and hover-up effects for certain elements (perhaps logo, images, or sections).
11. Uniform Descriptions:
   • Ensure consistent description styling across both the branding and photos sections for uniformity.



    --}}

<div class="relative px-4 sm:px-6 lg:px-8 pb-36">
    {{-- Spline viewer section (updated) --}}
    <div class="w-screen h-screen -mx-4 sm:-mx-6 lg:-mx-8">
        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.28/build/spline-viewer.js"></script>
        <spline-viewer loading-anim-type="spinner-big-dark"
            url="https://prod.spline.design/XRydKQhqfpYOjapX/scene.splinecode"></spline-viewer>
    </div>

    {{-- Web Section --}}
    <section id="web" class="w-full">
        <div>
            <div class="pb-32 pt-20">
                <h1 class="text-center" heading-hide>Web</h1>
            </div>

            {{-- Africa Power Supply Project --}}
            <div class="mb-28">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="web-description" reveal-type>Website design and development for Africa Power Supply,
                            a fresh
                            Canadian startup planning to revolutionize the African clean energy industry.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300">
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
            <div class="mb-28">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="web-description" reveal-type>Website design and development for BeautyFloor, a
                            premium flooring
                            company specializing in high-quality laminate and hardwood floors.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300">
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

            {{-- 32KARATA Project --}}
            <div class="mb-28">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-6 mb-6 lg:mb-0">
                        <h3 class="web-description" reveal-type>Website design and development for a dentist clinic
                            32KARATA</h3>
                        <div class="mt-8">
                            <h4>Tools used:</h4>
                            <div class="flex flex-wrap mt-4 mb-6 gap-6">
                                <img src="{{ Storage::disk('r2')->url('spline.png') }}" alt="Spline"
                                    class="h-[1.8rem] grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300">
                                <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                    class="h-[1.8rem] grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300">
                            </div>
                            <h3><a href="#" class="blur-link">Live website</a></h3>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-6">
                        <div class="lg:sticky lg:top-8">
                            <a href="#" class="block w-full relative aspect-[4/3]">
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
            <div class="mb-28">
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:gap-y-6">
                    <div class="col-span-12 lg:col-span-8 mb-6 lg:mb-0">
                        <h3 class="web-description" reveal-type>Website design and development for FemTech, an
                            innovative company
                            focused on women's health technology solutions.</h3>
                    </div>
                    <div class="col-span-12 lg:col-span-4 flex flex-col lg:items-end mb-6 lg:mb-0">
                        <h4>Tools used:</h4>
                        <div class="flex flex-wrap lg:justify-end mt-4 mb-6 gap-6">
                            <img src="{{ Storage::disk('r2')->url('figma.svg') }}" alt="Figma"
                                class="h-[1.8rem] grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300">
                            <img src="{{ Storage::disk('r2')->url('webflow.svg') }}" alt="Webflow"
                                class="h-[1.8rem] grayscale hover:grayscale-0 opacity-40 hover:opacity-100 transition-all duration-300">
                        </div>
                        <h3><a href="#" class="blur-link">Live website</a></h3>
                    </div>

                    <div class="col-span-12 lg:col-span-4 mb-6 lg:mb-0">
                        <div class="max-w-[300px] mx-auto lg:max-w-none"> <!-- Added this wrapper div -->
                            <a href="#" class="block w-full relative aspect-[9/19.5]">
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
                            <a href="#" class="block w-full relative aspect-[4/3]">
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
                <div class="mt-6 flex items-center">
                    <img src="{{ Storage::disk('r2')->url('roman.jpg') }}" alt="Roman Galavura"
                        class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <p class="font-semibold">Roman Galavura</p>
                        <p class="text-sm text-gray-500">CEO at BeautyFloor</p>
                    </div>
                </div>
            </div>

            {{-- Testimonial 2 --}}
            <div class=" bg-white p-6 rounded-lg shadow-md">
                <p>
                    "In our interaction I liked Alexander's attentiveness to my requests, detailed analysis of my
                    activity and his desire to find unusual and yet functional design solutions, suitable for the
                    specifics of my work. In addition to design, Alexander was also engaged in website layout, so at the
                    end of our work I received a ready to promote on the Internet business card site with an unusual
                    visual solution, and the necessary functionality."
                </p>
                <div class="flex items-center mt-6">
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

    {{-- Branding Section --}}
    <section id="branding" class="mb-24">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Branding</h1>
        </div>
        <div class="masonry-grid">
            <!-- ChickFila -->
            <div class="masonry-item mb-4">
                <div x-data="brandingCard('ChickFila', ['1-chickfila.jpg', '2-chickfila.jpg', '3-chickfila.jpg', '4-chickfila.jpg', '5-chickfila.jpg'], 'ChickFila branding project')"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="startSlideshow" @mouseleave="stopSlideshow" modal-button="chickfila-modal">
                    <img :src="currentImage" :alt="name"
                        class="w-full h-auto object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5 x-text="name"></h5>
                    </div>
                </div>
            </div>

            <!-- Adobe -->
            <div class="masonry-item mb-4">
                <div x-data="brandingCard('Adobe', ['1-adobe.jpg', '2-adobe.jpg', '3-adobe.jpg'], 'Adobe branding project')"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="startSlideshow" @mouseleave="stopSlideshow" modal-button="adobe-modal">
                    <img :src="currentImage" :alt="name"
                        class="w-full h-auto object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5 x-text="name"></h5>
                    </div>
                </div>
            </div>

            <!-- Chrysalis -->
            <div class="masonry-item mb-4">
                <div x-data="brandingCard('Chrysalis', ['1-chrysalis.jpg', '2-chrysalis.jpg'], 'Chrysalis branding project')"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="startSlideshow" @mouseleave="stopSlideshow" modal-button="chrysalis-modal">
                    <img :src="currentImage" :alt="name"
                        class="w-full h-auto object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5 x-text="name"></h5>
                    </div>
                </div>
            </div>

            <!-- Cayuga -->
            <div class="masonry-item mb-4">
                <div x-data="brandingCard('Cayuga', ['1-cayuga.jpg', '2-cayuga.jpg', '3-cayuga.jpg'], 'Cayuga branding project')"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="startSlideshow" @mouseleave="stopSlideshow" modal-button="cayuga-modal">
                    <img :src="currentImage" :alt="name"
                        class="w-full h-auto object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5 x-text="name"></h5>
                    </div>
                </div>
            </div>

            <!-- Nutrition Box -->
            <div class="masonry-item mb-4">
                <div x-data="brandingCard('Nutrition Box', ['1-nutrition-box.jpg', '2-nutrition-box.jpg', '3-nutrition-box.jpg', '4-nutrition-box.jpg', '5-nutrition-box.jpg', '6-nutrition-box.jpg'], 'Nutrition Box branding project')"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="startSlideshow" @mouseleave="stopSlideshow" modal-button="nutrition-box-modal">
                    <img :src="currentImage" :alt="name"
                        class="w-full h-auto object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5 x-text="name"></h5>
                    </div>
                </div>
            </div>

            <!-- Emmanuel -->
            <div class="masonry-item mb-4">
                <div x-data="brandingCard('Emmanuel', ['1-emmanuel.jpg', '2-emmanuel.jpg'], 'Emmanuel branding project')"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="startSlideshow" @mouseleave="stopSlideshow" modal-button="emmanuel-modal">
                    <div class="aspect-square overflow-hidden">
                        <img :src="currentImage" :alt="name"
                            class="w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110"
                            :style="currentImageIndex === 1 ? 'object-contain' : ''">
                    </div>
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5 x-text="name"></h5>
                    </div>
                </div>
            </div>

            <!-- HPL Animation -->
            <div class="masonry-item mb-4">
                <div x-data="{ isHovered: false }"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                    <img src="{{ Storage::disk('r2')->url('hpl-animation-preview.jpg') }}"
                        alt="HPL Animation Preview"
                        class="w-full h-auto object-cover transition-transform duration-500 ease-in-out"
                        :class="{ 'scale-110': isHovered }">
                    <video x-show="isHovered" x-cloak class="absolute inset-0 w-full h-full object-cover"
                        src="{{ Storage::disk('r2')->url('hpl-animation.mp4') }}" muted playsinline
                        x-init="$watch('isHovered', value => value ? $el.play() : $el.pause())">
                        Your browser does not support the video tag.
                    </video>
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5>HPL Animation</h5>
                    </div>
                </div>
            </div>

            <!-- Querido -->
            <div class="masonry-item mb-4">
                <div x-data="brandingCard('Querido', ['1-querido.jpg', '2-querido.jpg', '3-querido.jpg', '4-querido.jpg'], 'Querido branding project')"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="startSlideshow" @mouseleave="stopSlideshow" modal-button="querido-modal">
                    <img :src="currentImage" :alt="name"
                        class="w-full h-auto object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5 x-text="name"></h5>
                    </div>
                </div>
            </div>

            <!-- Design Shirt -->
            <div class="masonry-item mb-4">
                <div x-data="brandingCard('Design Shirt', ['1-design-shirt.jpg', '2-design-shirt.jpg'], 'Design Shirt project')"
                    class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group"
                    @mouseenter="startSlideshow" @mouseleave="stopSlideshow" modal-button="design-shirt-modal">
                    <img :src="currentImage" :alt="name"
                        class="w-full h-auto object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 h-20 bg-white/70 backdrop-blur-sm flex items-center px-6
                                opacity-0 transition-opacity duration-300 ease-in-out
                                group-hover:opacity-100">
                        <h5 x-text="name"></h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modals --}}
        <dialog class="modal-popup" modal="chickfila-modal">
            <div class="p-6">
                <h2>ChickFila Branding Project</h2>
                <p>Details about the ChickFila branding project...</p>
                <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
            </div>
        </dialog>

        <dialog class="modal-popup" modal="adobe-modal">
            <div class="p-6">
                <h2>Adobe Branding Project</h2>
                <p>Details about the Adobe branding project...</p>
                <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
            </div>
        </dialog>

        <dialog class="modal-popup" modal="chrysalis-modal">
            <div class="p-6">
                <h2>Chrysalis Branding Project</h2>
                <p>Details about the Chrysalis branding project...</p>
                <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
            </div>
        </dialog>

        <dialog class="modal-popup" modal="cayuga-modal">
            <div class="p-6">
                <h2>Cayuga Branding Project</h2>
                <p>Details about the Cayuga branding project...</p>
                <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
            </div>
        </dialog>

        <dialog class="modal-popup" modal="nutrition-box-modal">
            <div class="p-6">
                <h2>Nutrition Box Branding Project</h2>
                <p>Details about the Nutrition Box branding project...</p>
                <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
            </div>
        </dialog>

        <dialog class="modal-popup" modal="emmanuel-modal">
            <div class="p-6">
                <h2>Emmanuel Branding Project</h2>
                <p>Details about the Emmanuel branding project...</p>
                <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
            </div>
        </dialog>

        <dialog class="modal-popup" modal="hpl-animation-modal">
            <div class="p-6">
                <h2>HPL Animation Project</h2>
                <video controls class="w-full">
                    <source src="{{ Storage::disk('r2')->url('hpl-animation.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <p>Details about the HPL Animation project...</p>
                <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
            </div>
        </dialog>

        <dialog class="modal-popup" modal="querido-modal">
            <div class="p-6">
                <h2>Querido Branding Project</h2>
                <div x-data="imageGallery('querido', ['1-querido.jpg', '2-querido.jpg', '3-querido.jpg', '4-querido.jpg', '5-querido.jpg'])">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                        <template x-for="(image, index) in images" :key="index">
                            <img :src="getImageUrl(image)" :alt="'Querido ' + (index + 1)"
                                class="w-full h-auto cursor-pointer" @click="openGallery(index)">
                        </template>
                    </div>
                    <p>Details about the Querido branding project...</p>
                    <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
                </div>
            </div>
            <x-lightbox-gallery />
        </dialog>

        <dialog class="modal-popup" modal="design-shirt-modal">
            <div class="p-6">
                <h2>Design Shirt Project</h2>
                <div x-data="imageGallery('design-shirt', ['1-design-shirt.jpg', '2-design-shirt.jpg'])">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <template x-for="(image, index) in images" :key="index">
                            <img :src="getImageUrl(image)" :alt="'Design Shirt ' + (index + 1)"
                                class="w-full h-auto cursor-pointer" @click="openGallery(index)">
                        </template>
                    </div>
                    <p>Details about the Design Shirt project...</p>
                    <button modal="close" class="mt-4 px-4 py-2 bg-gray-200 rounded">Close</button>
                </div>
            </div>
            <x-lightbox-gallery />
        </dialog>
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
            'boy-rabbit.jpg',
            'dinner-3-people.jpg',
            'squirrel-fence.jpg',
            'goose-water.jpg',
            'bird.jpg',
            'bebra.jpg',
            'rabbit-yellow.jpg',
            'zaiika.jpg',
            // Add more photo filenames as needed
        ];
    @endphp
    {{-- Photos Section --}}
    <section id="photos" x-data="imageGallery('photos', @js($photos))">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Photos</h1>
        </div>
        <div class="masonry-grid">
            <template x-for="(photo, index) in images" :key="index">
                <div class="masonry-item">
                    <div class="photo-item rounded-lg overflow-hidden">
                        <img :src="getImageUrl(photo)" :alt="'Photo ' + (index + 1)"
                            class="w-full h-auto cursor-zoom-in transition-transform duration-500 ease-in-out hover:scale-105"
                            @click="openGallery(index)">
                    </div>
                </div>
            </template>
        </div>

        <x-lightbox-gallery />
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
            'painting.jpg',
            // Add more poster filenames as needed
        ];
    @endphp

    {{-- Posters Section --}}
    <section id="posters" x-data="imageGallery('posters', @js($posters))">
        <div class="pb-32 pt-20">
            <h1 class="text-center">Posters</h1>
        </div>
        <div class="masonry-grid">
            <template x-for="(poster, index) in images" :key="index">
                <div class="masonry-item">
                    <div class="poster-item rounded-lg overflow-hidden">
                        <img :src="getImageUrl(poster)" :alt="'Poster ' + (index + 1)"
                            class="w-full h-auto cursor-zoom-in transition-transform duration-500 ease-in-out hover:scale-105"
                            @click="openGallery(index)">
                    </div>
                </div>
            </template>
        </div>

        <x-lightbox-gallery />
    </section>


</div>

<script src="{{ asset('js/animations/gsap-text-reading-and-heading.js') }}"></script>

</body>

</html>

</html>
