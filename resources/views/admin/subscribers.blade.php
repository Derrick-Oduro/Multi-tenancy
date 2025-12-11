@extends('layouts.app')

@section('content')
<div class="flex">

    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>

    {{-- Main Content Area --}}
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        @can('view subscribers')
        <h1 class="text-2xl font-bold mb-4">Subscribers</h1>

        <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr>
                    <th class="py-1 px-3 border-b text-sm">ID</th>
                    <th class="py-1 px-3 border-b text-sm">Email</th>
                    <th class="py-1 px-3 border-b text-sm text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($subscribers as $subscriber)
                <tr>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $subscriber->id }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $subscriber->email }}</td>
                    <td class="py-1 px-3 border-b">
                        <div class="flex justify-end space-x-2">
                            @can('delete subscribers')
                            <form action="{{ route('subscribers.destroy', $subscriber->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to delete this subscriber?')"
                                    class="px-2 py-1 text-sm text-orange-500 rounded hover:underline">
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
        @else
        <h1 class="text-2xl font-bold mb-4">Access Denied</h1>
        <p>You do not have permission to access this page.</p>
        @endcan
    </main>
</div>
@endsection
