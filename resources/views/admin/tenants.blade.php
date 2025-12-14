{{-- this page is for managing tenants --}}
@extends('layouts.app')
@section('content')
<div class="flex">
    <x-sidebar></x-sidebar>
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Tenants</h1>

        <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr>
                    <th class="py-1 px-3 border-b text-sm">ID</th>
                    <th class="py-1 px-3 border-b text-sm">Name</th>
                    <th class="py-1 px-3 border-b text-sm">Domain</th>
                    <th class="py-1 px-3 border-b text-sm text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tenant as $tenants)
                <tr>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $tenants->id }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $tenants->name }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $tenants->domain }}</td>
                    <td class="py-1 px-3 border-b">
                        <div class="flex justify-end space-x-2">
                            {{-- actions can be added here --}}
                            @can('manage tenants')
                            <label for="editTenantModal-{{ $tenants->id }}"
                               class="px-2 py-1 text-sm text-green-500 rounded hover:underline">
                               Edit
                            </label>
                            {{-- <x-modal.editTenantModal :tenant="$tenants"></x-modal.editTenantModal> --}}
                            <form action="{{ route('tenants.destroy', $tenants->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this tenant?')" class="px-2 py-1 text-sm text-orange-500 rounded hover:underline">
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
</div>
@endsection
