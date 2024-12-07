<div>
    <style>
        /* Prevent horizontal scroll */
        html,
        body {
            overflow-x: hidden;
            position: relative;
            width: 100%;
        }
    </style>

    <section class="pt-24 sm:pt-32">
        <div class="mx-auto">
            <!-- Blog Feed -->
            @if ($posts->count() > 0)
                <div class="max-w-3xl mx-auto space-y-16">
                    @foreach ($posts as $post)
                        <article class="prose prose-lg max-w-none" x-data="productGallery(@js($post->images), '{{ $post->images[0] ?? '' }}')">
                            <!-- Post Header -->
                            <div class="mb-8">
                                @if ($post->images && count($post->images) > 0)
                                    <div class="relative w-screen left-1/2 right-1/2 -mx-[50vw] overflow-hidden"
                                        wire:ignore>
                                        <div class="swiper blog-images-slider" data-post-id="{{ $post->id }}">
                                            <div class="swiper-wrapper">
                                                @foreach ($post->images as $image)
                                                    <div class="swiper-slide">
                                                        <img src="{{ Storage::url($image) }}"
                                                            alt="{{ $post->title }} - Image {{ $loop->iteration }}"
                                                            class="w-full h-full object-cover cursor-zoom-in"
                                                            @click="openGallery(); currentIndex = {{ $loop->index }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show="isOpen" class="fixed inset-0 z-[999999999] bg-black bg-opacity-[0.92]"
                                        x-cloak>
                                        <x-lightbox-gallery />
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
                            <div
                                class="prose-img:rounded-lg prose-a:text-blue-600
                                prose
                                prose-lg
                                prose-p:text-black
                                prose-h1:text-3xl prose-h1:mb-6 prose-h1:text-black
                                prose-h2:text-2xl prose-h2:mb-4 prose-h2:text-black
                                prose-h3:text-xl prose-h3:mb-3 prose-h3:text-black
                                prose-h4:text-lg prose-h4:mb-2 prose-h4:text-black
                                prose-h5:text-lg prose-h5:mt-8 prose-h5:mb-0 prose-h5:text-black">
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
            padding: 0px 0;
            overflow: visible;
        }

        .blog-images-slider .swiper-slide {
            width: auto;
            max-width: 85%;

            @media (max-width: 768px) {
                max-width: 70%;
                max-height: 25rem;
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

            @media (max-width: 768px) {
                max-height: 25rem;
            }

            max-width: 100%;
            display: block;
            border-radius: 8px;
        }
    </style>

    <!-- Add this script at the bottom of the file -->
    <script>
        function getImageUrl(image) {
            return `{{ Storage::url('') }}${image}`;
        }

        function productGallery(images, initialImage) {
            return {
                images: images,
                selectedImage: initialImage,
                isOpen: false,
                currentIndex: 0,
                get currentImage() {
                    return this.images[this.currentIndex];
                },
                openGallery() {
                    this.isOpen = true;
                },
                closeGallery() {
                    this.isOpen = false;
                },
                nextImage() {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                    this.selectedImage = this.images[this.currentIndex];
                },
                prevImage() {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                    this.selectedImage = this.images[this.currentIndex];
                }
            };
        }
    </script>
</div>
