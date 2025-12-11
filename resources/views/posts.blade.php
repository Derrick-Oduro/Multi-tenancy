@extends('layouts.base')
@section('content')
<div class="max-w-7xl mx-auto p-1">

    @if(isset($posts) && count($posts) > 0)

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 min-h-[700px]">

            {{-- LEFT MAIN COLUMN --}}
            <div class="col-span-1 md:col-span-9">

                <div id="default-carousel" class="relative w-full mb-4" data-carousel="slide">
                        <div class="relative h-80 overflow-hidden rounded-md md:h-96">
                            @foreach($posts->take(3) as $index => $featuredPost)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <div class="grid grid-cols-1 md:grid-cols-3 h-full bg-white">

                                        {{-- TEXT SIDE --}}
                                        <div class="flex flex-col justify-center p-1 md:p-1">
                                            <h1 class="text-xl md:text-3xl font-bold mb-4 leading-tight text-gray-800">
                                                <a href="/posts/{{ $featuredPost->id }}" class="hover:underline">
                                                    {{ $featuredPost->title ?? 'No Title' }}
                                                </a>
                                            </h1>
                                            <p class="text-sm md:text-base line-clamp-3 text-gray-600 leading-relaxed">
                                                {{ Str::limit(strip_tags($featuredPost->body ?? 'No content available'), 200) }}
                                            </p>
                                        </div>

                                        {{-- IMAGE SIDE --}}
                                        <div class="col-span-2 relative overflow-hidden">
                                            @if($featuredPost->image)
                                                <img src="{{ asset('storage/' . $featuredPost->image) }}"
                                                    class="absolute block w-[616px] h-[346px] object-cover top-0 left-0"
                                                    alt="{{ $featuredPost->title }}">
                                            @else
                                                <div class="w-[616px] h-[346px] bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500">No Image</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        {{-- SLIDER INDICATORS --}}
                        <div class="absolute z-30 flex -translate-x-20 bottom-4 left-3/4 space-x-3">
                            @foreach($posts->take(3) as $index => $p)
                                <button type="button" class="w-3 h-3 rounded-full bg-white/60"
                                    aria-label="Slide {{ $index + 1 }}"
                                    data-carousel-slide-to="{{ $index }}"></button>
                            @endforeach
                        </div>

                        {{-- PREV BUTTON --}}
                        <button type="button"
                            class="ml-[20rem] absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer"
                            data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30">
                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                            </span>
                        </button>

                        {{-- NEXT BUTTON --}}
                        <button type="button"
                            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer"
                            data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30">
                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                            </span>
                        </button>

                    </div>


                {{-- Bottom Grid --}}
                <div class="hidden md:grid md:grid-cols-4 gap-3">
                    @foreach($posts->skip(4)->take(4) as $post)
                        <div class="bg-white overflow-hidden">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="w-[221px] h-[124px] object-cover" alt="{{ $post->title }}">
                            @endif
                            <div class="p-0">
                                <h5 class="text-base font-bold mb-2 mt-2 text-gray-800">
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
            <div class="col-span-1 md:col-span-3 flex flex-col gap-3 justify-between">
                @foreach($posts->skip(3)->take(3) as $index => $post)
                    <div class="bg-white overflow-hidden">
                            @if($post->image && $post->id == $secondLatest->id)
                                <img src="{{ asset('storage/' . $post->image) }}" class="w-[300px] h-[168px] object-cover" alt="{{ $post->title }}">
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

            @php
                $morePosts = $posts->skip(8)->take(5);
            @endphp
            @if($morePosts->count() > 0)
                <div class="col-span-1 md:col-span-12 flex flex-row gap-3 mb-8 mt-8">
                    @foreach($morePosts as $post)
                        <div class="bg-white p-0 w-[20%]">
                            <h5 class="text-base font-bold text-gray-800">
                                <a href="/posts/{{ $post->id }}" class="hover:underline">
                                    {{ $post->title }}
                                </a>
                            </h5>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="border-2 border-black"></div>
        <div class="">
            <h4>MORE TO EXPLORE</h4>
        </div>

    @if(isset($posts) && count($posts) > 0)
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 min-h-[700px]">

            {{-- LEFT MAIN COLUMN --}}
            <div class="col-span-1 md:col-span-9">

                <div id="default-carousel" class="relative w-full mb-4" data-carousel="slide">
                        <div class="relative h-80 overflow-hidden rounded-md md:h-96">
                            @foreach($posts->take(3) as $index => $featuredPost)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <div class="grid grid-cols-1 md:grid-cols-3 h-full bg-white">

                                        {{-- TEXT SIDE --}}
                                        <div class="flex flex-col justify-center p-1 md:p-1">
                                            <h1 class="text-xl md:text-3xl font-bold mb-4 leading-tight text-gray-800">
                                                <a href="/posts/{{ $featuredPost->id }}" class="hover:underline">
                                                    {{ $featuredPost->title ?? 'No Title' }}
                                                </a>
                                            </h1>
                                            <p class="text-sm md:text-base line-clamp-3 text-gray-600 leading-relaxed">
                                                {{ Str::limit(strip_tags($featuredPost->body ?? 'No content available'), 200) }}
                                            </p>
                                        </div>

                                        {{-- IMAGE SIDE --}}
                                        <div class="col-span-2 relative overflow-hidden">
                                            @if($featuredPost->image)
                                                <img src="{{ asset('storage/' . $featuredPost->image) }}"
                                                    class="absolute block w-[616px] h-[346px] object-cover top-0 left-0"
                                                    alt="{{ $featuredPost->title }}">
                                            @else
                                                <div class="w-[616px] h-[346px] bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500">No Image</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        {{-- SLIDER INDICATORS --}}
                        <div class="absolute z-30 flex -translate-x-20 bottom-4 left-3/4 space-x-3">
                            @foreach($posts->take(3) as $index => $p)
                                <button type="button" class="w-3 h-3 rounded-full bg-white/60"
                                    aria-label="Slide {{ $index + 1 }}"
                                    data-carousel-slide-to="{{ $index }}"></button>
                            @endforeach
                        </div>

                        {{-- PREV BUTTON --}}
                        <button type="button"
                            class="ml-[20rem] absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer"
                            data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30">
                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                            </span>
                        </button>

                        {{-- NEXT BUTTON --}}
                        <button type="button"
                            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer"
                            data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30">
                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                            </span>
                        </button>

                    </div>


                {{-- Bottom Grid --}}
                <div class="hidden md:grid md:grid-cols-3 gap-3">
                    @foreach($posts->skip(4)->take(3) as $post)
                        <div class="bg-white overflow-hidden">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-32 object-cover" alt="{{ $post->title }}">
                            @endif
                            <div class="p-0">
                                <h5 class="text-base font-bold mb-2 mt-2 text-gray-800">
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
            <div class="col-span-1 md:col-span-3 flex flex-col gap-3 justify-between">
                @foreach($posts->skip(3)->take(3) as $index => $post)
                    <div class="bg-white overflow-hidden">
                            @if($post->image && $post->id == $secondLatest->id)
                                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-32 object-cover" alt="{{ $post->title }}">
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
        </div>
    @endif
    @else
        <div class="bg-white rounded-lg p-6 text-center">
            <p class="text-gray-500">No posts available at the moment.</p>
        </div>
    @endif


</div>
@endsection
