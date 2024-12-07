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
                            <div class="prose-content">
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
</div>
