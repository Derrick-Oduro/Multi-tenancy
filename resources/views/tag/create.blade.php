@extends('layouts.app')
@section('content')
<div class="flex">
    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>
    <main class="w-3/4 p-6">
        <h1 class="text-2xl font-bold mb-4">Create Tag</h1>

        <form action="{{ route('tags.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">

                 <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>

            <div>
                <button
                    type="submit"
                    class="px-4 py-2 bg-black text-white rounded hover:bg-gray-700">
                    Create Tag
                </button>
            </div>
        </form>

    </main>
</div>
@endsection
