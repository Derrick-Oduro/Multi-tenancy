@extends('layouts.base')
@section('content')
<div class="max-w-6xl mx-auto p-1">

    <h1 class="text-xl font-bold mb-6">Category: {{ $categoriy-> id ?? 'Unknown' }}</h1>

    @if(isset($posts) && count($posts) > 0)
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 min-h-[700px]">

            {{-- LEFT MAIN COLUMN --}}
            <div class="col-span-1 md:col-span-9">
                @php $featuredPost = $posts->first(); @endphp

                {{-- Featured Post --}}
                <div class="bg-white overflow-hidden h-64 md:h-auto mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="flex flex-col justify-center p-6 md:p-8 order-1 md:order-1">
                            <h1 class="text-xl md:text-3xl lg:text-3xl font-bold mb-4 leading-tight text-gray-800">
                                <a href="/posts/{{ $featuredPost->id }}" class="hover:underline">
                                    {{ $featuredPost->title ?? 'No Title' }}
                                </a>
                            </h1>
                            <p class="text-sm md:text-base lg:text-sm text-gray-600 leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($featuredPost->body ?? 'No content available'), 200) }}
                            </p>
                        </div>

                        <div class="relative overflow-hidden order-1 md:order-2">
                            @if($featuredPost->image)
                                <a href="/posts/{{ $featuredPost->id }}">
                                    <img src="{{ asset('storage/' . $featuredPost->image) }}"
                                         class="w-full h-64 object-cover"
                                         alt="{{ $featuredPost->title }}">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Bottom Grid --}}
                <div class="hidden md:grid md:grid-cols-4 gap-3">
                    @foreach($posts->skip(4)->take(4) as $post)
                        <div class="bg-white overflow-hidden">
                            @if($post->image)
                                <a href="/posts/{{ $post->id }}">
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                         class="w-full h-32 object-cover"
                                         alt="{{ $post->title }}">
                                </a>
                            @endif
                            <div class="p-6">
                                <h5 class="text-base font-bold mb-3 text-gray-800">
                                    <a href="/posts/{{ $post->id }}" class="hover:underline">{{ $post->title }}</a>
                                </h5>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    {{ Str::limit(strip_tags($post->body ?? 'No content available'), 100) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="col-span-1 md:col-span-3 flex flex-col gap-2">
                @foreach($posts->skip(1)->take(3) as $index => $post)
                    <div class="bg-white overflow-hidden flex-1">
                        @if($post->image && $index == 10 )
                            <a href="/posts/{{ $post->id }}">
                                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-32 object-cover" alt="{{ $post->title }}">
                            </a>
                        @endif

                        <div class="p-3">
                            <h5 class="text-base font-bold mb-3 text-gray-800">
                                <a href="/posts/{{ $post->id }}" class="hover:underline">{{ $post->title }}</a>
                            </h5>
                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($post->body ?? 'No content available'), 100) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
            </div>

        </div>
    @else
        <div class="bg-white rounded-lg p-6 text-center">
            <p class="text-gray-500">No posts available at the moment.</p>
        </div>
    @endif

</div>
@endsection
