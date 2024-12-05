<div>
    @push('head')
        <script defer src="https://developer-zahid.github.io/Custom-Coverflow-Slider/assets/plugins/swiper/js/swiper.min.js">
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endpush

    @push('scripts')
        <script defer src="{{ asset('js/animations/blog-images-slider.js') }}"></script>
    @endpush

    <section class="pt-24 sm:pt-32">
        <div class="container mx-auto">
            <!-- Filters Section -->
            <div
                class="sticky top-0 left-0 right-0 z-10 mb-6 bg-transparent backdrop-blur-md w-full transition-transform duration-300 ease-in-out">
                <div class="max-w-[95rem] mx-auto px-4 py-2">
                    <div class="flex flex-wrap items-center justify-between gap-2 transition-all duration-300">
                        <!-- Categories -->
                        <div class="w-full sm:w-auto">
                            <div
                                class="filter-container bg-white backdrop-blur-sm rounded-full inline-flex space-x-0.5 sm:space-x-1 overflow-x-auto h-10">
                                @foreach ($categories as $category)
                                    <button wire:click="setCategory({{ $category->id }})"
                                        class="px-2 sm:px-4 h-full rounded-full transition-colors duration-200 whitespace-nowrap text-sm sm:text-lg
                                            {{ in_array($category->slug, $selected_categories ? explode(',', $selected_categories) : [])
                                                ? 'bg-black text-white'
                                                : 'text-gray-700 hover:bg-black/10' }}">
                                        {{ $category->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Feed -->
            @if ($posts->count() > 0)
                <div class="max-w-3xl mx-auto space-y-16">
                    @foreach ($posts as $post)
                        <article class="prose prose-lg max-w-none">
                            <!-- Post Header -->
                            <div class="mb-8">
                                @if ($post->images && count($post->images) > 0)
                                    <div class="relative w-screen left-1/2 right-1/2 -mx-[50vw]">
                                        <div class="swiper blog-images-slider" data-post-id="{{ $post->id }}">
                                            <div class="swiper-wrapper">
                                                @foreach ($post->images as $image)
                                                    <div class="swiper-slide">
                                                        <img src="{{ Storage::url($image) }}"
                                                            alt="{{ $post->title }} - Image {{ $loop->iteration }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <h2 class="!mb-2 mt-8">{{ $post->title }}</h2>
                                <div class="flex items-center text-sm text-gray-500 !mt-0">
                                    <time datetime="{{ $post->published_at->toDateString() }}">
                                        {{ $post->display_date }}
                                    </time>
                                    @if ($post->category)
                                        <span class="mx-2">·</span>
                                        <span>{{ $post->category->name }}</span>
                                    @endif
                                    @if ($post->is_edited)
                                        <span class="mx-2">·</span>
                                        <span>Updated {{ $post->last_edited_at->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Post Content -->
                            <div class="prose-img:rounded-lg prose-a:text-blue-600">
                                {!! $post->body !!}
                            </div>

                            <!-- Post Footer -->
                            <hr class="my-16">
                        </article>
                    @endforeach
                </div>
            @else
                <div class="max-w-3xl mx-auto">
                    <p class="large-text-description">
                        Coming soon. Stay tuned for articles about design, development, and creative processes.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <style>
        .filter-container::-webkit-scrollbar {
            display: none;
        }

        .filter-container {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Optional: Add a subtle fade effect between posts */
        .prose+.prose {
            position: relative;
        }

        .prose+.prose::before {
            content: '';
            position: absolute;
            top: -4rem;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb 35%, #e5e7eb 65%, transparent);
        }

        .blog-images-slider {
            width: 100%;
            padding: 60px 0;
            overflow: visible;
        }

        .blog-images-slider .swiper-slide {
            width: auto;
            max-width: 85%;

            @media (max-width: 768px) {
                max-width: 70%;
            }

            transition: transform 0.3s;
            overflow: hidden;
            transform-origin: center;
            opacity: 0.4;
            transition: all 0.3s ease;
            height: auto;
            max-height: 30rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blog-images-slider .swiper-slide-active {
            opacity: 1;
            transform: scale(1.05);
        }

        .blog-images-slider .swiper-slide::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 8px;
            pointer-events: none;
            z-index: 1;
            box-shadow: 0 0 0 100vmax currentColor;
            color: white;
        }

        .blog-images-slider .swiper-slide img {
            width: auto;
            height: auto;
            max-height: 30rem;
            max-width: 100%;
            display: block;
            border-radius: 8px;
        }
    </style>
</div>
