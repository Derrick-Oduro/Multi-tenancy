@extends('layouts.app')
@section('content')
<div class="flex">
    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>
    <main class="w-3/4 p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Tag</h1>
        <form action="{{ route('tags.update', $tag->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}"class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"required>
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text"name="slug"id="slug" value="{{ $category->slug }}"class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"required>
            </div>

            <div>
                <button
                    type="submit"
                    class="px-4 py-2 bg-black text-white rounded hover:bg-gray-700">
                    Update Tag
                </button>
            </div>
        </form>
    </main>
</div>
@endsection
