@extends('layouts.app')

@section('content')
<div class="flex">

    <x-sidebar></x-sidebar>
    @role('admin|editor')
    <main class="flex-1 p-6 bg-slate-50 min-h-screen">

        <h1 class="text-2xl text-slate-900 font-bold mb-4">Tags</h1>
        @can('create tags')
        <div class="mb-4">
            <label for="createTagModal"
               class="px-3 py-1 bg-sky-600 text-white text-sm rounded hover:bg-sky-700 float-right">
               Add Tag
            </label>
            <x-modal.createTagModal></x-modal.createTagModal>
        </div>
        @endcan

        <table class="min-w-full bg-white rounded-lg">
            <thead class="bg-slate-100">
                <tr>
                    <th class="py-1 px-3 border-b text-slate-600 text-sm">ID</th>
                    <th class="py-1 px-3 border-b text-slate-600 text-sm">Name</th>
                    <th class="py-1 px-3 border-b text-slate-600 text-sm">Slug</th>
                    <th class="py-1 px-3 border-b text-slate-600 text-sm text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tags as $tag)
                <tr class="border-t">
                    <td class="py-1 px-3 border-b text-sm text-slate-700 text-center">{{ $tag->id }}</td>
                    <td class="py-1 px-3 border-b text-sm text-slate-700 text-center">{{ $tag->name }}</td>
                    <td class="py-1 px-3 border-b text-sm text-slate-700 text-center">{{ $tag->slug ?? 'N/A' }}</td>
                    <td class="py-1 px-3 border-b">
                        <div class="flex justify-end space-x-2">

                            @can('edit tags')
                            <label for="editTagModal-{{ $tag->id }}"
                               class="px-2 py-1 text-sm text-green-500 rounded hover:underline">
                               Edit
                            </label>
                            <x-modal.editTagModal :tag="$tag"></x-modal.editTagModal>
                            @endcan

                            @can('delete tags')
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this tag')" class="px-2 py-1 text-sm text-orange-500 rounded hover:underline">
                                    Delete
                                </button>
                            </form>
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
    @endrole
</div>
@endsection
