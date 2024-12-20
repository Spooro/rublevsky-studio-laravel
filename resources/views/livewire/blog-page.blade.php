<style>
    html,
    body {
        overflow-x: hidden;
        position: relative;
        width: 100%;
    }
</style>

<div>
    <section class="pt-24 sm:pt-32">
        <div class="blog-content-container">
            <!-- Blog Title -->
            <h1 class="text-center mb-8">What's in gaiwan?</h1>

            <!-- Russian Version Link -->
            <div class="text-center mb-16 sm:mb-24">
                <h5><a href="https://t.me/gaiwan_contents" class="blur-link">🇷🇺RU blog version</a></h5>
            </div>

            <!-- Blog Feed -->
            @if ($posts->count() > 0)
                <div class="space-y-16">
                    @foreach ($posts as $post)
                        <article id="post-{{ $post->id }}" class="prose prose-lg mx-auto scroll-mt-32"
                            x-data="productGallery(@js($post->images), '{{ $post->images[0] ?? '' }}')">
                            <!-- Post Header -->
                            <div class="blog-post-header">
                                @if ($post->images && count($post->images) > 0)
                                    <div class="blog-image-container -mx-4 sm:-mx-6 md:mx-0">
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

                                        <!-- Image Previews - Only show if there's more than one image -->
                                        @if (count($post->images) > 1)
                                            <div class="w-full max-w-2xl mx-auto">
                                                <div class="flex gap-2 overflow-x-auto no-scrollbar px-0"
                                                    id="preview-container-{{ $post->id }}">
                                                    @foreach ($post->images as $index => $image)
                                                        <div
                                                            class="flex-shrink-0 {{ $loop->first ? 'pl-4 md:pl-0' : '' }} {{ $loop->last ? 'pr-4 md:pr-0' : '' }}">
                                                            <div class="preview-image-wrapper rounded-lg"
                                                                data-post-id="{{ $post->id }}"
                                                                data-index="{{ $index }}">
                                                                <img src="{{ Storage::url($image) }}"
                                                                    alt="{{ $post->title }} - Preview {{ $loop->iteration }}"
                                                                    class="w-20 h-20 object-cover rounded-lg cursor-pointer hover:opacity-75 transition">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div x-show="isOpen" class="fixed inset-0 z-[999999999] bg-black bg-opacity-[0.92]"
                                        x-cloak>
                                        <x-lightbox-gallery />
                                    </div>
                                @endif
                                @if ($post->show_title)
                                    <h2 class="!mb-2">{{ $post->title }}</h2>
                                @endif
                                <div class="blog-post-meta">
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
                                    <div x-data="{ copied: false }" class="copy-link-button" :class="{ 'copied': copied }"
                                        @click="
                                             navigator.clipboard.writeText(window.location.origin + '/blog/' + '{{ $post->slug }}');
                                             copied = true;
                                             setTimeout(() => copied = false, 2000)
                                         "
                                        title="Copy link to post">
                                        <template x-if="!copied">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                            </svg>
                                        </template>
                                        <template x-if="copied">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </template>
                                        <span class="copied-text">Link copied</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Post Content -->
                            <div class="prose-content">
                                {!! $post->body !!}
                                @if ($post->product)
                                    <h3>
                                        <a href="/store/{{ $post->product->slug }}"
                                            class="blur-link inline-flex items-center">
                                            Shop {{ $post->product->name }}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </h3>
                                @endif
                            </div>

                            <!-- Post Footer -->
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
