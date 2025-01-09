<style>
    html,
    body {
        overflow-x: hidden;
        position: relative;
        width: 100%;
        height: 100%;
    }
</style>

<div>
    <section class="pt-24 sm:pt-32">
        <div class="blog-content-container">
            <!-- Blog Title -->
            <h1 class="text-center mb-8">What's in the gaiwan?</h1>

            <!-- Russian Version Link -->
            <div class="text-center mb-16 sm:mb-24">
                <h5><a href="https://t.me/gaiwan_contents" class="blur-link">🇷🇺 RU blog version</a></h5>
            </div>

            <!-- Blog Feed -->
            @if ($posts->count() > 0)
                <div class="space-y-16">
                    @foreach ($posts as $post)
                        <article id="{{ $post->slug }}" class="blog-post-container scroll-mt-32" x-data="productGallery(@js($post->images), '{{ $post->images[0] ?? '' }}')">
                            @if ($post->images && count($post->images) > 0)
                                <div class="blog-image-container mb-4 -mx-4 sm:-mx-6 md:mx-0">
                                    <div class=" relative">
                                        <!-- Main Slider -->
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

                                        <!-- Slider Skeleton -->
                                        <div class="blog-skeleton-wrapper">
                                            <div class="blog-skeleton-slides">
                                                <div class="skeleton blog-image-skeleton side left "></div>
                                                <div class="skeleton blog-image-skeleton center"></div>
                                                <div class="skeleton blog-image-skeleton right side"></div>
                                            </div>
                                        </div>

                                        <!-- Image Previews -->
                                        @if (count($post->images) > 1)
                                            <div class="w-full max-w-2xl mx-auto mt-4">
                                                <div class="flex gap-2 overflow-x-auto no-scrollbar px-0"
                                                    id="preview-container-{{ $post->id }}">
                                                    @foreach ($post->images as $index => $image)
                                                        <div
                                                            class="flex-shrink-0 {{ $loop->first ? 'pl-4 md:pl-0' : '' }} {{ $loop->last ? 'pr-4 md:pr-0' : '' }}">
                                                            <div class="preview-image-wrapper rounded-lg"
                                                                data-post-id="{{ $post->id }}"
                                                                data-index="{{ $index }}">
                                                                <div class="w-20 h-20 relative">
                                                                    <img src="{{ Storage::url($image) }}"
                                                                        alt="{{ $post->title }} - Preview {{ $loop->iteration }}"
                                                                        class="w-full h-full object-cover rounded-lg cursor-pointer hover:opacity-75 transition opacity-0"
                                                                        onload="this.parentElement.classList.add('loaded')"
                                                                        style="transition: opacity 0.2s">
                                                                    <div
                                                                        class="absolute inset-0 skeleton rounded-lg loaded-hide">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="sticky-header-container">
                                <div class="sticky-header-content relative max-w-2xl mx-auto z-[1]">
                                    @if ($post->show_title)
                                        <h3 class="!mb-2">{{ $post->title }}</h3>
                                    @endif
                                    <div class="flex items-center">
                                        <div class="flex items-baseline gap-4">
                                            @if ($post->product)
                                                <h6><a href="/store/{{ $post->product->slug }}" class="blur-link">
                                                        Buy this tea →
                                                    </a></h6>
                                            @endif
                                            <time datetime="{{ $post->published_at->toDateString() }}">
                                                {{ $post->display_date }}
                                            </time>

                                        </div>
                                        <div x-data="{ copied: false }" class="copy-link-button"
                                            :class="{ 'copied': copied }"
                                            @click="
                                                 navigator.clipboard.writeText(window.location.origin + '/blog/' + '{{ $post->slug }}');
                                                 copied = true;
                                                 setTimeout(() => copied = false, 2000)
                                             "
                                            title="Copy link to post">
                                            <template x-if="!copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                                </svg>
                                            </template>
                                            <template x-if="copied">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </template>
                                            <span class="copied-text">Link copied</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="prose prose-lg mx-auto -mt-10">
                                <div class="prose-content">
                                    {!! $post->body !!}
                                </div>
                            </div>

                            <hr class="my-16">
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <p class="large-text-description">
                        Coming soon. Stay tuned for articles about design, development, and creative processes.
                    </p>
                </div>
            @endif
        </div>
    </section>
</div>
