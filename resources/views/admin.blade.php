@extends('layouts.app')

@section('content')
<div class="flex">

    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>
    {{-- Main Content Area --}}
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Welcome to the Admin Panel</h1>
        <p class="text-gray-700">Use the sidebar to navigate through administrative options.</p>
        {{-- show some admin content here like graphs, stats, or recent activity --}}
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">Site Statistics</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-medium">Total Posts</h3>
                    {{-- <p class="text-2xl font-bold">{{ $totalPosts }}</p> --}}
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-medium">Total Categories</h3>
                    {{-- <p class="text-2xl font-bold">{{ $totalCategories }}</p> --}}
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-medium">Total Subscribers</h3>
                    {{-- <p class="text-2xl font-bold">{{ $totalSubscribers }}</p> --}}
                </div>
            </div>
        </div>


    </main>
</div>
@endsection
