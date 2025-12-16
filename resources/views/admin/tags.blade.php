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

        <button
            hx-get="{{ route('tags.refresh') }}"
            hx-target="#tags-table"
            hx-swap="innerHTML"
            class="px-3 py-1 bg-slate-600 text-white text-sm rounded hover:bg-slate-700">
            Refresh
        </button>


        <table class="w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody
                id="tags-table"
                hx-get="{{ route('tags.refresh') }}"
                hx-trigger="tags-updated from:body"
                hx-swap="innerHTML"
                                    >
                @include('partials.tags-table', ['tags' => $tags])
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
