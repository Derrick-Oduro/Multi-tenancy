@extends('layouts.app')
@section('content')
<div class="flex">
    <x-sidebar></x-sidebar>
    <main class="w-3/4 p-6">
        <h1 class="text-2xl font-bold mb-4">Edit PostT</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                <textarea name="body" id="body" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>{{ old('body', $post->body) }}</textarea>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mt-2 w-32 h-32 object-cover">
                @endif
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- <div>
                <label for="tag_id" class="block text-sm font-medium text-gray-700">Tag</label>
                <select name="tag_id" id="tag_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ old('tag_id', $post->tag_id) == $tag->id ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div> --}}
            <div>
                <button type="submit" class="px-4 py-2 bg-black text-white rounded hover:bg-gray-700">
                    Update Post
                </button>
            </div>
        </form>
    </main>
</div>
@endsection
