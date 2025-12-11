<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title ?? 'Post' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<x-header></x-header>
<body class="bg-white">
    <div class="container mx-auto px-4 py-8 max-w-4xl">

        <nav class="mb-6">
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="/" class="hover:text-blue-600 transition-colors">News</a>
                <span>/</span>
                <span class="text-gray-700">{{ Str::limit($post->title ?? 'Article', 50) }}</span>
            </div>
        </nav>
        <article class="bg-white rounded-lg overflow-hidden">

            <header class="p-6 pb-4">
                <!-- Category and Date -->
                <div class="flex items-center space-x-3 mb-4">
                    @if(isset($post->tag_id))
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                            {{ $post->tag_id }}
                        </span>
                    @endif
                    @if(isset($post->created_at))
                        <time class="text-gray-500 text-sm">
                            {{ $post->created_at->format('l, F j, Y \a\t g:i A') }}
                        </time>
                    @endif
                </div>

                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight mb-4">
                    {{ $post->title ?? 'No Title Available' }}
                </h1>

                <div class="flex items-center justify-between text-sm text-gray-500 pb-4 border-b border-gray-200">
                    <div class="flex items-center space-x-4">
                        @if(isset($post->created_at))
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        @endif
                    </div>

                    @if(request()->path() == 'admin' || request()->path() == 'post/'.$post->id.'/admin')
                        <div class="flex space-x-2">
                            <a href="/post/{{ $post->id }}/edit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                                Edit Post
                            </a>
                            <form action="/posts/{{ $post->id }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                                    Delete Post
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </header>

            @if($post->image)
                <div class="px-6">
                    <figure class="mb-6">
                        <img src="{{ asset('storage/' . $post->image) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-64 lg:h-96 object-cover rounded-lg">
                        @if($post->image_caption)
                            <figcaption class="text-sm text-gray-600 mt-2 italic">
                                {{ $post->image_caption }}
                            </figcaption>
                        @endif
                    </figure>
                </div>
            @endif
            <div class="px-6 pb-8">
                <div class="prose prose-lg max-w-none">
                    @if($post->body)
                        <div class="text-gray-800 leading-relaxed whitespace-pre-line">
                            {{ $post->body }}
                        </div>
                    @else
                        <p class="text-gray-500 italic">No content available for this article.</p>
                    @endif
                </div>
            </div>

            <footer class="px-6 pb-6 pt-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <!-- Share Links -->
                    <div class="flex items-center space-x-4">
                        <span class="text-sm font-medium text-gray-700">Share:</span>
                        <div class="flex space-x-2">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->fullUrl()) }}"
                               target="_blank"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                Twitter
                            </a>
                        </div>
                    </div>
                    <a href="/" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                        ← Back to News
                    </a>
                </div>
            </footer>
        </article>

        @if(isset($relatedpost) && $relatedpost->count() > 0)
            <section class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedpost as $relatedPost)
                        <article class="bg-white rounded-lg overflow-hidden border border-gray-200 hover:bg-gray-50 transition-colors">
                            @if($relatedPost->image)
                                <img src="{{ asset('storage/' . $relatedPost->image) }}"
                                     alt="{{ $relatedPost->title }}"
                                     class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="font-bold mb-2 line-clamp-2">
                                    <a href="/post/{{ $relatedPost->id }}" class="hover:text-blue-600 transition-colors">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-3">
                                    {{ Str::limit(strip_tags($relatedPost->body), 120) }}
                                </p>
                                <div class="mt-2 text-xs text-gray-500">
                                    {{ $relatedPost->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</body>
<x-footer></x-footer>
</html>
