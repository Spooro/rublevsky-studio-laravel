<!-- TODO:
5. Overflow Issues:
   • Fix any overflowing elements in the first section on mobile.
   • Ensure the "process" section doesn’t overflow either, maintaining proper responsiveness.
6. Padding Adjustments:
   • Add padding at the bottom of the entire contact page for improved layout. the padding is the same as in other pages, pt-4 pb-36
-->

<div class="relative pb-36"> <!-- Removed lg: prefix -->
    {{-- Greeting Section --}}
    <section class="pt-4 mb-32 overflow-visible px-4 sm:px-6">
        <div class="clearfix">
            <div class="float-right w-full min-w-[20rem] sm:w-1/2 md:w-1/3 ml-0 sm:ml-4 mb-4 pl-0 sm:pl-4">
                <div class="masonry-item rounded-lg overflow-hidden">
                    <!-- Added masonry-item class and other necessary classes -->
                    <img src="{{ Storage::disk('r2')->url('me.jpg') }}" alt="Profile picture" class="w-full h-auto">
                </div>
            </div>
            <div>
                <h2 class="large-text-description mb-4 break-words">
                    Greetings. I am a visual web developer based in Ontario<sup>1</sup>, by way of New
                    Zealand<sup>2</sup> and originally from Russia<sup>3</sup>. Just finished my time at Hamilton Public
                    Library where I was helping with branding.
                </h2>
                <div class="flex flex-col justify-start">
                    <div <div class="mt-4">
                        <p>1. Hamilton &nbsp; 2. Auckland &nbsp; 3. Vladivostok</p>
                    </div>
                    <div class="my-4 flex flex-wrap -ml-6"> <!-- Added negative left margin -->
                        <h3 class="ml-6 mb-4"><a href="#" class="blur-link">Email</a></h3>
                        <h3 class="ml-6 mb-4"><a href="#" class="blur-link">LinkedIn</a></h3>
                        <h3 class="ml-6 mb-4"><a href="#" class="blur-link">Telegram</a></h3>
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- Services Offered Section --}}
    <section class="mb-40 px-4 sm:px-6">
        <h2 class="mb-10">Services offered</h2>
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
    <section class="mb-40 px-4 sm:px-6">
        <h2 class="mb-10">My expertise</h2>
        <div class="grid grid-cols-10 gap-4 items-center mb-8">
            <div class="col-span-6">
                <h3 class="large-text-description" reveal-type>With over three years of industry experience, I have
                    collaborated with small businesses, individuals, and government organizations from concept to final
                    deliverables.</h3>
            </div>
            <div class="col-span-4 flex justify-center items-center">
                <img src="{{ Storage::disk('r2')->url('laravel.svg') }}" alt="Laravel Logo"
                    class="min-h-[10rem] w-auto">
            </div>
        </div>
        <div class="grid grid-cols-10 gap-4 items-center">
            <div class="col-span-4 flex justify-center items-center">
                <div class="h-18 w-full">
                    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.32/build/spline-viewer.js"></script>
                    <spline-viewer url="https://prod.spline.design/QXnaSK-s1c-VXGpm/scene.splinecode"></spline-viewer>
                </div>
            </div>
            <div class="col-span-6">
                <h3 class="large-text-description" reveal-type>Our studio primarily uses Laravel and Webflow,
                    implementing Finsweet for industry-standard
                    accessibility solutions,
                    ensuring inclusive and accessible websites.</h3>
            </div>
        </div>
    </section>

    {{-- Experience Section --}}
    <section class="mb-32 px-4 sm:px-6">
        <h2 class="mb-10">Experience</h2>
        <div class="column-layout">
            <div class="experience-card border-2 border-[#f58025] hover:bg-[#f58025] hover:text-white group mb-4">
                <img src="{{ Storage::disk('r2')->url('mohawk.svg') }}" alt="Mohawk Logo"
                    class="w-full mb-4 group-hover:filter group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">01/2022 — 04/2024</p>
                <h4 class="font-semibold">Graphic design advanced 3 year program</h4>
                <p>Gained hands-on experience in various aspects of graphic design, including print, branding, web
                    design, through a comprehensive 3-year advanced program.</p>
            </div>
            <div class="experience-card border-2 border-[#821c1c] hover:bg-[#821c1c] hover:text-white  group mb-4">
                <img src="{{ Storage::disk('r2')->url('beautyfloor.svg') }}" alt="Beauty Floor Logo"
                    class="w-full mb-4 group-hover:filter group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">05/2023 - 09/2023</p>
                <h4 class="font-semibold">Flooring Business</h4>
                <p>I have designed an e-commerce website for a flooring Business.</p>
            </div>
            {{-- For the HPL card --}}
            <div class="experience-card border-2 border-[#23598e] hover:bg-[#23598e] hover:text-white  group mb-4">
                <img src="{{ Storage::disk('r2')->url('hpl.svg') }}" alt="Hamilton Public Library Logo"
                    class="h-24 w-auto mb-4 group-hover:filter group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">01/2024 - 04/2024</p>
                <h4 class="font-semibold">Government-funded public organization</h4>
                <p>I was in charge of creating brand identities for the library events in various mediums from print
                    materials to web and social media.</p>
            </div>
            <div class="experience-card border-2 border-black hover:bg-black hover:text-white  group mb-4">
                <div class="w-24 h-24 mb-4">
                    <img src="{{ Storage::disk('r2')->url('inksoul.svg') }}" alt="Inksoul Logo"
                        class="w-full h-full object-contain">
                </div>
                <p class="mb-2">01/2024 - 04/2024</p>
                <h4 class="font-semibold">Tattoo studio</h4>
                <p>I have designed and developed a website for a tattoo studio based in Vladivostok, Russia.</p>
            </div>
            {{-- For the Africa Power Supply card --}}
            <div class="experience-card border-2 border-[#669933] hover:bg-[#669933] hover:text-white  group mb-4">
                <img src="{{ Storage::disk('r2')->url('aps.svg') }}" alt="Africa Power Supply Logo"
                    class="h-24 w-auto mb-4 group-hover:brightness-0 group-hover:invert">
                <p class="mb-2">04/2024 - 05/2024</p>
                <h4 class="font-semibold">Africa Power Supply</h4>
                <p>I have designed and developed a website for a Canadian startup that strives to revolutionize African
                    waste-to-energy systems.</p>
            </div>
        </div>
    </section>

    {{-- Process Section --}}
    <section class="section-features h-[500vh] relative">
        <!-- Removed w-screen and -mx-4 -->
        <h2 class="pl-4 sticky top-4 z-10">Process</h2>
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
    <section class="mb-12 max-w-[50rem] mx-auto px-4 sm:px-6">
        <h3 class="large-text-description mb-4">Want to reach out about a project, collaboration or just want to say
            friendly hello?</h3>
        <h5 class="mb-6">I will be texting you back shortly!</h5>
        <form wire:submit.prevent="submitForm" class="space-y-6">
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif
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
                <div class="flex items-baseline mb-2">
                    <label for="budget" class="mr-2">Your budget CAD</label>
                    <h5>${{ number_format($budget, 0) }}</h5>
                </div>
                <div class="relative pb-8"> <!-- Added padding-bottom -->
                    <input type="range" id="budget" wire:model.live="budget" min="500" max="100000"
                        step="500" class="w-full @error('budget') border-red-500 @enderror">
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
    <section class="mb-12 px-4 sm:px-6" x-data="{ openQuestion: null }">
        <h2>FAQ</h2>
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
