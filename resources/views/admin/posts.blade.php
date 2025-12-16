@extends('layouts.app')

@section('content')
<div class="flex">

    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>
    @can('view posts')
    <main class="w-4/5 p-6 bg-slate-50 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Posts</h1>
        <div class="mb-4">
            @can('create posts')
            <label for="createPostModal"
               class="px-3 py-1 bg-sky-600 text-white text-sm rounded hover:bg-sky-700 float-right">
               +Add Post
            </label>
            <x-modal.createPostModal :categories="\App\Models\Category::all()"></x-modal.createPostModal>
            @endcan
        </div>

        <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr class="bg-sky-50">
                    <th class="py-1 px-3 border-b text-sm">ID</th>
                    <th class="py-1 px-3 border-b text-sm">Title</th>
                    <th class="py-1 px-3 border-b text-sm">Category</th>
                    <th class="py-1 px-3 border-b text-sm">Created At</th>
                    <th class="py-1 px-3 border-b text-sm text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $post->id }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $post->title }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $post->category->name ?? 'N/A' }}</td>
                    <td class="py-1 px-3 border-b text-xs text-center">{{ $post->created_at->format('M d, Y') }}</td>
                    <td class="py-1 px-3 border-b">
                        <div class="flex justify-end space-x-2">
                            @can('edit.own.post', $post)
                            <label for="editPostModal-{{ $post->id }}"
                               class="px-2 py-1 text-sm text-green-500 rounded hover:underline">
                               Edit
                            </label>
                            @endcan

                            @can('delete posts', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you very sure you want to delete this post?')" class="px-2 py-1 text-sm text-orange-500 rounded hover:underline">
                                    Delete
                                </button>
                            </form>
                            <x-modal.editPostModal :post="$post" :categories="\App\Models\Category::all()"></x-modal.editPostModal>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>
    @else
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Access Denied</h1>
        <p>You do not have permission to access this page.</p>
    </main>
    @endcan
</div>
@endsection

