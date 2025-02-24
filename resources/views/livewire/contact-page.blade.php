@push('scripts')
    <script src="{{ asset('js/animations/gsap-cards-stacking.js') }}" defer></script>
@endpush
<div class="relative">


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
                            Chinese tea ceremony</strong> events, or <a id='social-link-soundcloud'
                            href="https://soundcloud.com/alexrublevsky/let-god" class="blur-link">rhyming over
                            beats</a>.
                    </h5>
                </div>


                <div class="mt-auto flex flex-wrap -ml-6">
                    <h3 class="ml-6"><a href="mailto:alexander.rublevskii@gmail.com" class="blur-link"
                            id='social-link-email'>Email</a></h3>
                    <h3 class="ml-6"><a href="https://t.me/alexrublevsky" class="blur-link" target="_blank"
                            id='social-link-telegram'>Telegram</a></h3>
                    <h3 class="ml-6"><a href="https://www.linkedin.com/in/rublevsky/" class="blur-link"
                            target="_blank" id='social-link-linkedin'>LinkedIn</a></h3>
                    <h3 class="ml-6"><a href="https://www.instagram.com/rublevsky.studio/" class="blur-link "
                            target="_blank" id='social-link-instagram'>Instagram</a></h3>



                </div>
            </div>

            {{-- Image column --}}
            <div class="w-full mb-4 md:mb-0 md:col-span-1 -order-1 md:order-none">
                <div class="work-visual-item rounded-lg overflow-hidden relative aspect-[1/1]">
                    <img src="{{ Storage::url('me.jpg') }}" alt="Profile picture"
                        class="w-full h-full object-cover opacity-0"
                        onload="this.parentElement.classList.add('loaded')">
                    <div class="absolute inset-0 skeleton loaded-hide"></div>
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

    {{-- Skills Section --}}
    <section class="w-full" wire:ignore>
        <h2 class="mb-10" heading-reveal>Skills</h2>

        <div class="flex flex-col gap-16">
            {{-- Development Skills --}}
            <div>
                <div class="flex justify-center">
                    <div class="bg-neutral-100 rounded-lg px-3 py-1 mb-10">
                        <h3 class="text-lg md:text-xl lg:text-2xl">Development</h3>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 justify-center">
                    <x-skill-logo name="HTML5" logo="html5.svg" />
                    <x-skill-logo name="Tailwind CSS" logo="tailwind.svg" />
                    <x-skill-logo name="Laravel" logo="laravel.svg" />
                    <x-skill-logo name="PHP" logo="php.svg" />
                    <x-skill-logo name="Webflow" logo="webflow.svg" />
                    <x-skill-logo name="Next.js" logo="next-js.svg" :wideLogo="true" />
                    <x-skill-logo name="React" logo="react.svg" />
                    <x-skill-logo name="Git" logo="git.svg" :wideLogo="true" />
                    <x-skill-logo name="Wized" logo="wized.svg" :wideLogo="true" />
                    <x-skill-logo name="Google Analytics" logo="google-analytics.svg" :wideLogo="true" />

                </div>
            </div>

            {{-- Design Skills --}}
            <div>
                <div class="flex justify-center">
                    <div class="bg-neutral-100 rounded-lg px-3 py-1 mb-10">
                        <h3 class="text-lg md:text-xl lg:text-2xl">Design</h3>
                    </div>
                </div>
                <div class="flex flex-wrap gap-8 justify-center">
                    <x-skill-logo name="Photoshop" logo="photoshop.svg" />
                    <x-skill-logo name="After Effects" logo="after-effects.svg" />
                    <x-skill-logo name="Illustrator" logo="illustrator.svg" />

                    <x-skill-logo name="InDesign" logo="indesisgn.svg" />
                    <x-skill-logo name="Spline" logo="spline.png" :wideLogo="true" />

                </div>
            </div>
        </div>
    </section>

    {{-- Experience Section --}}
    <section class="pb-10">
        <h2 heading-reveal>Experience</h2>
    </section>



    <section class="experience_timeline_section">
        <div class="experience_timeline_component">
            <div class="experience_timeline_overlay-top"></div>
            <div class="experience_timeline_overlay-bottom"></div>
            <div class="experience_timeline_progress_bar"></div>
            <div class="experience_timeline_progress"></div>

            {{-- Timeline Items --}}
            {{-- Mohawk College --}}
            <div class="experience_timeline_item grid grid-cols-3 gap-0">
                <div class="experience_timeline_left">
                    <div class="experience_timeline_date-wrapper">
                        <h4 class="experience_timeline_date-text">01/22 — 04/24</h4>
                    </div>
                </div>
                <div class="experience_timeline_center">
                    <div class="experience_timeline_circle-wrapper">
                        <div class="experience_timeline_circle"></div>
                    </div>
                </div>
                <div class="experience_timeline_right">
                    <div class="experience_timeline_content">
                        <img src="{{ Storage::disk('r2')->url('mohawk.svg') }}" alt="Mohawk Logo"
                            class="w-full mb-8">
                        <h5 class="font-semibold">Graphic design advanced 3 year program</h5>
                        <p>Gained hands-on experience in various aspects of graphic design, including print, branding,
                            web design, through a comprehensive 3-year advanced program.</p>
                    </div>
                </div>
            </div>

            {{-- Beauty Floor --}}
            <div class="experience_timeline_item grid grid-cols-3 gap-0">
                <div class="experience_timeline_left">
                    <div class="experience_timeline_date-wrapper">
                        <h4 class="experience_timeline_date-text">05/23 - 09/23</h4>
                    </div>
                </div>
                <div class="experience_timeline_center">
                    <div class="experience_timeline_circle-wrapper">
                        <div class="experience_timeline_circle"></div>
                    </div>
                </div>
                <div class="experience_timeline_right">
                    <div class="experience_timeline_content">
                        <img src="{{ Storage::disk('r2')->url('beautyfloor.svg') }}" alt="Beauty Floor Logo"
                            class="w-full mb-8">
                        <h5 class="font-semibold">Flooring Business</h5>
                        <p>I have designed an e-commerce website for a flooring Business.</p>
                    </div>
                </div>
            </div>

            {{-- Hamilton Public Library --}}
            <div class="experience_timeline_item grid grid-cols-3 gap-0">
                <div class="experience_timeline_left">
                    <div class="experience_timeline_date-wrapper">
                        <h4 class="experience_timeline_date-text">01/24 - 04/24</h4>
                    </div>
                </div>
                <div class="experience_timeline_center">
                    <div class="experience_timeline_circle-wrapper">
                        <div class="experience_timeline_circle"></div>
                    </div>
                </div>
                <div class="experience_timeline_right">
                    <div class="experience_timeline_content">
                        <img src="{{ Storage::disk('r2')->url('hpl.svg') }}" alt="Hamilton Public Library Logo"
                            class="h-24 w-auto mb-8">
                        <h5 class="font-semibold">Government-funded public organization</h5>
                        <p>I was in charge of creating brand identities for the library events in various mediums from
                            print materials to web and social media.</p>
                    </div>
                </div>
            </div>

            {{-- Inksoul --}}
            <div class="experience_timeline_item grid grid-cols-3 gap-0">
                <div class="experience_timeline_left">
                    <div class="experience_timeline_date-wrapper">
                        <h4 class="experience_timeline_date-text">01/24 - 04/24</h4>
                    </div>
                </div>
                <div class="experience_timeline_center">
                    <div class="experience_timeline_circle-wrapper">
                        <div class="experience_timeline_circle"></div>
                    </div>
                </div>
                <div class="experience_timeline_right">
                    <div class="experience_timeline_content">
                        <img src="{{ Storage::disk('r2')->url('inksoul.svg') }}" alt="Inksoul Logo"
                            class="w-24 h-24 mb-8 object-contain">
                        <h5 class="font-semibold">Tattoo studio</h5>
                        <p>I have designed and developed a website for a tattoo studio based in Vladivostok, Russia.</p>
                    </div>
                </div>
            </div>

            {{-- Africa Power Supply --}}
            <div class="experience_timeline_item grid grid-cols-3 gap-0">
                <div class="experience_timeline_left">
                    <div class="experience_timeline_date-wrapper">
                        <h4 class="experience_timeline_date-text">04/24 - 05/24</h4>
                    </div>
                </div>
                <div class="experience_timeline_center">
                    <div class="experience_timeline_circle-wrapper">
                        <div class="experience_timeline_circle"></div>
                    </div>
                </div>
                <div class="experience_timeline_right">
                    <div class="experience_timeline_content">
                        <img src="{{ Storage::disk('r2')->url('aps.svg') }}" alt="Africa Power Supply Logo"
                            class="h-24 w-auto mb-8">
                        <h5 class="font-semibold">Africa Power Supply</h5>
                        <p>I have designed and developed a website for a Canadian startup that strives to revolutionize
                            African waste-to-energy systems.</p>
                    </div>
                </div>
            </div>

            {{-- Centre3 --}}
            <div class="experience_timeline_item grid grid-cols-3 gap-0">
                <div class="experience_timeline_left">
                    <div class="experience_timeline_date-wrapper">
                        <h4 class="experience_timeline_date-text">01/24 - 04/24</h4>
                    </div>
                </div>
                <div class="experience_timeline_center">
                    <div class="experience_timeline_circle-wrapper">
                        <div class="experience_timeline_circle"></div>
                    </div>
                </div>
                <div class="experience_timeline_right">
                    <div class="experience_timeline_content">
                        <img src="{{ Storage::disk('r2')->url('centre3.png') }}" alt="Centre3 Logo"
                            class="w-auto h-16 sm:h-20 mb-8">
                        <h5 class="font-semibold">Centre3 for Artistic + Social Practice</h5>
                        <p>Participated in screen printing workshops and contributed to the Digital Pipeline 4 Youth
                            program.</p>
                        <img src="{{ Storage::disk('r2')->url('screen-printing-me.jpg') }}"
                            alt="Me screen printing at Centre3" class="w-full mt-8 rounded-lg">
                    </div>
                </div>
            </div>
    </section>


    <div class="h-[10rem] bg-white"> </div>
    {{-- Process Section --}}
    <section class="section-features no-padding h-[500vh] relative" wire:ignore>
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
        <h3 class="large-text-description mb-4" reveal-type>Want to reach out about a project, collaboration or just
            want to say
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



</body>
