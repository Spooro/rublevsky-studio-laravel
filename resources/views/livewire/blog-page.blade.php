<div>
    <section class="pt-24 sm:pt-32">
        <div class="container mx-auto">
            <h1 class="mb-16">Blog</h1>

            @if ($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <article class="flex flex-col">
                            @if ($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full h-48 object-cover rounded-lg mb-4">
                            @endif
                            <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                            <div class="text-sm text-gray-500 mb-2">
                                {{ $post->created_at->format('F j, Y') }}
                            </div>
                            <div class="prose prose-sm line-clamp-3 mb-4">
                                {!! Str::limit(strip_tags($post->body), 150) !!}
                            </div>
                            <a href="{{ route('blog.post', $post->slug) }}" class="text-blue-600 hover:text-blue-800">
                                Read more →
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="max-w-3xl">
                    <p class="large-text-description">
                        Coming soon. Stay tuned for articles about design, development, and creative processes.
                    </p>
                </div>
            @endif
        </div>
    </section>
</div>
