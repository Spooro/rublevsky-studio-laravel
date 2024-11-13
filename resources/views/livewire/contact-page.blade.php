<div class="relative pb-36">

    <section class="pt-4 overflow-visible">
        <div class="flex flex-col md:grid md:grid-cols-3 md:gap-4 md:relative">

            <div class="py-2 md:col-span-2 md:h-full md:flex md:flex-col">

                <div>
                    <h3 class="large-text-description mb-4 break-words">
                        Greetings! My name is Alexander. I am a <strong class="font-semibold">visual web
                            developer</strong> based in
                        Ontario<sup>1</sup>, by way of New
                        Zealand<sup>2</sup> and originally from Russia<sup>3</sup>. Just finished my time at Hamilton
                        Public
                        Library where I was helping with <strong class="font-semibold">branding</strong>.
                    </h3>
                    <div class="mt-4 ">
                        <div class="flex flex-wrap gap-8">
                            <p>1. Hamilton</p>
                            <p>2. Auckland</p>
                            <p>3. Vladivostok</p>
                        </div>
                    </div>
                    <h5 class="my-8 large-text-description break-words max-w-[46ch]">
                        When I'm not coding or designing, you can find me organizing <strong
                            class="font-medium">traditional
                            Chinese tea ceremony</strong> events, or <a
                            href="https://soundcloud.com/alexrublevsky/let-god" class="blur-link">rhyming over
                            beats</a>.
                    </h5>
                </div>


                <div class="mt-auto flex flex-wrap -ml-6">
                    <h3 class="ml-6"><a href="mailto:alexander.rublevskii@gmail.com" class="blur-link">Email</a></h3>
                    <h3 class="ml-6"><a href="https://t.me/alexrublevsky" class="blur-link"
                            target="_blank">Telegram</a></h3>
                    <h3 class="ml-6"><a href="https://www.linkedin.com/in/rublevsky/" class="blur-link"
                            target="_blank">LinkedIn</a></h3>
                    <h3 class="ml-6"><a href="https://www.instagram.com/rublevsky.studio/" class="blur-link"
                            target="_blank">Instagram</a></h3>



                </div>
            </div>

            {{-- Image column --}}
            <div class="w-full mb-4 md:mb-0 md:col-span-1 -order-1 md:order-none">
                <div class="work-visual-item rounded-lg overflow-hidden">
                    <img src="{{ Storage::url('me.jpg') }}" alt="Profile picture" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    {{-- Services Offered Section --}}
    <section>
        <h2 class="mb-10" heading-reveal>Services offered</h2>
        <div class="services-grid">
            <div class="service-row">
                <div class="service-item">Accessibility audit & optimization</div>
                <div class="service-item">Animation</div>
            </div>
            <div class="service-row">
                <div class="service-item">Branding & Strategy</div>
                <div class="service-item">Custom Code/Scripting</div>
            </div>
            <div class="service-row">
                <div class="service-item">Data and Analytics</div>
                <div class="service-item">Digital Marketing & Advertising</div>
            </div>
            <div class="service-row">
                <div class="service-item">E-commerce Development</div>
                <div class="service-item">Graphic Design</div>
            </div>
            <div class="service-row">
                <div class="service-item">Photography/Video</div>
                <div class="service-item">Web Design (UI/UX)</div>
            </div>
            <div class="service-row">
                <div class="service-item">Web Development</div>
                <div class="service-item">3D Design</div>
            </div>
            <div class="service-row">
                <div class="service-item">Logo</div>
                <div class="service-item">3rd Party Integrations</div>
            </div>
        </div>
    </section>

    {{-- My Expertise Section --}}
    <section class="w-full" wire:ignore>


        <h2 class="mb-10" heading-reveal>My expertise</h2>

        {{-- Parent container --}}
        <div class="grid grid-cols-1 gap-16">
            {{-- First row --}}
            <div class="grid grid-cols-1 lg:grid-cols-10 gap-16 items-center">
                <div class="lg:col-span-6 order-2 lg:order-1">
                    <h3 class="large-text-description text-left" reveal-type>
                        With over <strong class="font-semibold">3</strong> years of industry experience, I
                        specialize in
                        <strong class="font-semibold">Laravel</strong>, <strong class="font-semibold">PHP</strong>,
                        <strong class="font-semibold">Tailwind CSS</strong>, and <strong
                            class="font-semibold">Figma</strong>,
                        enabling me to design and build robust and scalable web applications with powerful database
                        management and
                        advanced functionality.
                    </h3>
                </div>
                <div class="lg:col-span-4 flex justify-center items-center order-1 lg:order-2">
                    <div class="flex flex-col w-full">
                        <div class="flex justify-center items-center">
                            <div class="h-full w-full flex justify-center items-center p-4">
                                <img src="{{ Storage::disk('r2')->url('laravel.svg') }}" alt="Laravel Logo"
                                    class="logo-hover">
                            </div>
                            <div class="w-3/4 h-full flex justify-center items-center p-4">
                                <img src="{{ Storage::disk('r2')->url('php.svg') }}" alt="PHP Logo" class="logo-hover">
                            </div>
                            <div class="w-3/4 h-full flex justify-center items-center p-4">
                                <img src="{{ Storage::disk('r2')->url('git.svg') }}" alt="Git Logo" class="logo-hover">
                            </div>
                        </div>

                        <div class="flex justify-center items-center">
                            <div class="w-full h-full flex justify-center items-center p-4">
                                <img src="{{ Storage::disk('r2')->url('tailwind.svg') }}" alt="Tailwind CSS Logo"
                                    class="logo-hover">
                            </div>
                            <div class="h-full w-full flex justify-center items-center p-4">
                                <img src="{{ Storage::disk('r2')->url('alpine-js.svg') }}" alt="Alpine.js Logo"
                                    class="logo-hover">
                            </div>
                            <div class="h-full w-3/4 flex justify-center items-center p-4">
                                <img src="{{ Storage::disk('r2')->url('figma.svg') }}" alt="Figma Logo"
                                    class="logo-hover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Second row --}}
            <div class="grid grid-cols-1 lg:grid-cols-10 gap-16 items-center">
                <div class="lg:col-span-4 flex justify-center items-center order-1">
                    <div class="flex justify-center items-center w-full">
                        <div class="w-3/4 h-full flex justify-center items-center p-4">
                            <img src="{{ Storage::disk('r2')->url('xano.svg') }}" alt="Xano Logo" class="logo-hover">
                        </div>
                        <div class="w-full h-full flex justify-center items-center p-4">
                            <img src="{{ Storage::disk('r2')->url('client-first.svg') }}" alt="Client First Logo"
                                class="logo-hover">
                        </div>
                        <div class="w-3/4 h-full flex justify-center items-center p-4">
                            <img src="{{ Storage::disk('r2')->url('wized.svg') }}" alt="Wized Logo"
                                class="logo-hover">
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-6 order-2 flex lg:justify-end">
                    <h3 class="large-text-description text-left lg:text-right" reveal-type>
                        The <strong x-data="{ tooltip: false }" class="font-semibold relative">
                            <span @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                class="!underline !underline-offset-2 decoration-1 border-b border-current"
                                style="text-decoration: underline !important;">WWX</span>
                            <div x-show="tooltip" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-500"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                x-anchor.top.offset.10="$el.parentElement"
                                class="absolute bg-white text-black text-[1rem] text-normal p-4 rounded shadow-md z-50 w-48 text-center border border-gray-200"
                                x-cloak>
                                Webflow, Wized, Xano
                            </div>
                        </strong> combination allows me for hyper-fast delivery speeds, never lacking in quality or
                        functionality, yet providing results of a whole web team.
                    </h3>
                </div>
            </div>

            {{-- Third row --}}
            <div class="grid grid-cols-1 lg:grid-cols-10 gap-16 items-center">
                <div class="lg:col-span-6 order-2 lg:order-1">
                    <h3 class="large-text-description text-left" reveal-type>
                        Using <strong class="font-semibold">Client First</strong> methodology makes projects easy
                        to
                        understand for other developers, while <strong class="font-semibold">Wized</strong> enables
                        seamless integration with any third-party service, database, or API.
                    </h3>
                </div>
                <div class="lg:col-span-4 flex justify-center items-center order-1 lg:order-2">
                    <div class="h-18 w-full">
                        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.32/build/spline-viewer.js"></script>
                        <spline-viewer
                            url="https://prod.spline.design/QXnaSK-s1c-VXGpm/scene.splinecode"></spline-viewer>
                    </div>
                </div>
            </div>

            {{-- Print/Photo row --}}
            <div class="grid grid-cols-1 lg:grid-cols-10 gap-16 items-center">
                <div class="lg:col-span-4 flex justify-center items-center order-1">
                    <video class="w-full h-auto aspect-square object-cover rounded-lg" autoplay loop muted playsinline>
                        <source src="{{ Storage::disk('r2')->url('screen-printing.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="lg:col-span-6 order-2 flex lg:justify-end">
                    <h3 class="large-text-description text-left lg:text-right" reveal-type>
                        Beyond digital, I bring expertise in <strong class="font-semibold">screen printing</strong>
                        for
                        apparel and posters, as well as professional <strong class="font-semibold">photography</strong>
                        services capturing
                        anything from portraits to products.
                    </h3>
                </div>
            </div>
        </div>



    </section>

    {{-- Experience Section --}}
    <section class="mb-32">
        <h2 class="mb-10" heading-reveal>Experience</h2>
        <div class="column-layout">
            <div class="experience-card border-2 border-[#f58025] hover:bg-[#f58025] hover:text-white group mb-4">
                <img src="{{ Storage::disk('r2')->url('mohawk.svg') }}" alt="Mohawk Logo"
                    class="w-full mb-8 group-hover:filter group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">01/2022 — 04/2024</p>
                <h5 class="font-semibold">Graphic design advanced 3 year program</h5>
                <p>Gained hands-on experience in various aspects of graphic design, including print, branding, web
                    design, through a comprehensive 3-year advanced program.</p>
            </div>
            <div class="experience-card border-2 border-[#821c1c] hover:bg-[#821c1c] hover:text-white  group mb-4">
                <img src="{{ Storage::disk('r2')->url('beautyfloor.svg') }}" alt="Beauty Floor Logo"
                    class="w-full mb-8 group-hover:filter group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">05/2023 - 09/2023</p>
                <h5 class="font-semibold">Flooring Business</h5>
                <p>I have designed an e-commerce website for a flooring Business.</p>
            </div>
            {{-- For the HPL card --}}
            <div class="experience-card border-2 border-[#23598e] hover:bg-[#23598e] hover:text-white  group mb-4">
                <img src="{{ Storage::disk('r2')->url('hpl.svg') }}" alt="Hamilton Public Library Logo"
                    class="h-24 w-auto mb-8 group-hover:filter group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">01/2024 - 04/2024</p>
                <h5 class="font-semibold">Government-funded public organization</h5>
                <p>I was in charge of creating brand identities for the library events in various mediums from print
                    materials to web and social media.</p>
            </div>
            <div class="experience-card border-2 border-black hover:bg-black hover:text-white  group mb-4">

                <img src="{{ Storage::disk('r2')->url('inksoul.svg') }}" alt="Inksoul Logo"
                    class="w-24 h-24 mb-8 object-contain">

                <p class="mb-2">01/2024 - 04/2024</p>
                <h5 class="font-semibold">Tattoo studio</h5>
                <p>I have designed and developed a website for a tattoo studio based in Vladivostok, Russia.</p>
            </div>
            {{-- For the Africa Power Supply card --}}
            <div class="experience-card border-2 border-[#669933] hover:bg-[#669933] hover:text-white  group mb-4">
                <img src="{{ Storage::disk('r2')->url('aps.svg') }}" alt="Africa Power Supply Logo"
                    class="h-24 w-auto mb-8 group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">04/2024 - 05/2024</p>
                <h5 class="font-semibold">Africa Power Supply</h5>
                <p>I have designed and developed a website for a Canadian startup that strives to revolutionize African
                    waste-to-energy systems.</p>
            </div>
            <div class="experience-card border-2 border-black hover:bg-black hover:text-white group mb-4">
                <img src="{{ Storage::disk('r2')->url('centre3.png') }}" alt="Centre3 Logo"
                    class="w-full mb-8 group-hover:filter group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">01/2024 - 04/2024</p>
                <h5 class="font-semibold">Centre3 for Artistic + Social Practice</h5>
                <p>Participated in screen printing workshops and contributed to the Digital Pipeline 4 Youth program.
                </p>
            </div>
        </div>
    </section>

    {{-- Process Section --}}
    <section class="section-features h-[500vh] relative" wire:ignore>
        <!-- Removed w-screen and -mx-4 -->
        <h2 class="pl-4 sticky top-4 z-10" heading-reveal>Process</h2>
        <div class="features-wrapper h-screen">
            <div class="features-card-container h-4/5 flex flex-col items-center relative overflow-hidden">
                <!-- Removed px-4 -->
                <div class="features-card-wrapper relative w-full h-full flex items-center justify-center">
                    @foreach ([
        ['number' => 1, 'title' => 'Check-in Call', 'content' => 'After defining your needs, I provide a timeline & budget estimate during our initial call. I also conduct a thorough audit of your current website.'],
        ['number' => 2, 'title' => 'Let\'s Go', 'content' => 'Once we\'ve agreed on the project scope and terms, I begin the design and development process, keeping your vision and goals at the forefront.'],
        ['number' => 3, 'title' => 'Weekly Call', 'content' => 'We regroup once per week to present my progress and get your feedback, ensuring the project stays on track and aligns with your expectations.'],
        ['number' => 4, 'title' => 'Website Completion', 'content' => 'Once the initial build is complete, you have 5 business days to submit any final changes or adjustments to ensure your complete satisfaction.'],
        ['number' => 5, 'title' => 'Hand-off', 'content' => 'After all changes are complete, I transfer the website to your Webflow account, giving you full ownership. You and your team will then be trained on editing and maintaining the website\'s content.'],
    ] as $index => $card)
                        <div class="features-card absolute w-full max-w-md bg-white rounded-lg shadow-lg p-6"
                            style="transform: rotate({{ [-10, 5, -5, 10, -15][$index] }}deg); z-index: {{ $index + 1 }}; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);">
                            <div
                                class="bg-[#ff6f61] text-white rounded-full inline-flex items-center justify-center mb-4 w-16 h-16">
                                <h4>{{ $card['number'] }}</h4>
                            </div>
                            <h4 class="font-medium mb-2">{{ $card['title'] }}</h4>
                            <p>{{ $card['content'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- Reach Out Section --}}
    <section class="max-w-[50rem] mx-auto" id="reach-out">
        <h3 class="large-text-description mb-4">Want to reach out about a project, collaboration or just want to say
            friendly hello?</h3>
        <h5 class="mb-6">I will be texting you back shortly!</h5>
        <form wire:submit.prevent="submitForm" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div>
                    <input type="text" wire:model="name" placeholder="Your name"
                        class="w-full p-2 border rounded @error('name') border-red-500 @enderror">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <input type="text" wire:model="company_name" placeholder="Company name"
                        class="w-full p-2 border rounded">
                </div>
                <div>
                    <input type="email" wire:model="email" placeholder="Your email"
                        class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <input type="text" wire:model="role" placeholder="Your role"
                        class="w-full p-2 border rounded">
                </div>
            </div>
            <div>
                <div x-data="{
                    localBudget: @entangle('budget').live,
                    formatBudget(value) {
                        return new Intl.NumberFormat().format(value);
                    }
                }" class="relative pb-8">
                    <div class="flex items-baseline mb-2">
                        <label for="budget" class="mr-2">Your budget CAD</label>
                        <h5>$<span x-text="formatBudget(localBudget)"></span></h5>
                    </div>
                    <input type="range" id="budget" x-model="localBudget"
                        @input="$wire.set('budget', Math.max(500, Math.min(100000, parseInt($event.target.value))))"
                        min="500" max="100000" step="500"
                        class="w-full @error('budget') border-red-500 @enderror">
                </div>
                @error('budget')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <textarea wire:model="message" placeholder="Share your project ideas with me"
                    class="w-full p-2 border rounded focus:outline-none focus:ring-1 focus:ring-black focus:border-black @error('message') border-red-500 @enderror"
                    rows="4"></textarea>
                @error('message')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif
            <button type="submit" class="main-button w-full">Submit</button>
            <div class="flex items-center space-x-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>100% Free. Zero Pressure. Expert Advice.</span>
            </div>
        </form>
    </section>

    {{-- FAQ Section --}}
    <section x-data="{ openQuestion: null }">
        <h2 heading-reveal>FAQ</h2>
        <div class="space-y-4">
            <div class="border-b border-gray-200">
                <button @click="openQuestion = openQuestion === 1 ? null : 1"
                    class="w-full text-left py-4 pr-12 relative">
                    <h3><span class="inline-block w-16">[01]</span> What if my project is urgent?</h3>
                    <svg class="w-10 h-10 absolute right-0 top-1/2 transform -translate-y-1/2 transition-transform"
                        :class="{ 'rotate-45': openQuestion === 1 }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                </button>
                <div x-show="openQuestion === 1" x-collapse>
                    <p class="py-4 pl-16">There is always room for discussion regarding quicker delivery times for an
                        additional charge.</p>
                </div>
            </div>

            <div class="border-b border-gray-200">
                <button @click="openQuestion = openQuestion === 2 ? null : 2"
                    class="w-full text-left py-4 pr-12 relative">
                    <h3><span class="inline-block w-16">[02]</span> Do you do design or coding?</h3>
                    <svg class="w-10 h-10 absolute right-0 top-1/2 transform -translate-y-1/2 transition-transform"
                        :class="{ 'rotate-45': openQuestion === 2 }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                </button>
                <div x-show="openQuestion === 2" x-collapse>
                    <p class="py-4 pl-16">I will be doing both design and coding. Being responsible for both sides, I
                        am able to grasp the full scope of the project and finish it with its essence preserved intact.
                    </p>
                </div>
            </div>

            <div class="border-b border-gray-200">
                <button @click="openQuestion = openQuestion === 3 ? null : 3"
                    class="w-full text-left py-4 pr-12 relative">
                    <h3><span class="inline-block w-16">[03]</span> Can you use my design guidelines?</h3>
                    <svg class="w-10 h-10 absolute right-0 top-1/2 transform -translate-y-1/2 transition-transform"
                        :class="{ 'rotate-45': openQuestion === 3 }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                </button>
                <div x-show="openQuestion === 3" x-collapse>
                    <p class="py-4 pl-16">Absolutely! This is where we will start from.</p>
                </div>
            </div>

            <div class="border-b border-gray-200">
                <button @click="openQuestion = openQuestion === 4 ? null : 4"
                    class="w-full text-left py-4 pr-12 relative">
                    <h3><span class="inline-block w-16">[04]</span> Do you work with enterprise?</h3>
                    <svg class="w-10 h-10 absolute right-0 top-1/2 transform -translate-y-1/2 transition-transform"
                        :class="{ 'rotate-45': openQuestion === 4 }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                </button>
                <div x-show="openQuestion === 4" x-collapse>
                    <p class="py-4 pl-16">Yes! Send me a message and let's go through the details.</p>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="{{ asset('js/animations/gsap-cards-stacking.js') }}"></script>

</body>
