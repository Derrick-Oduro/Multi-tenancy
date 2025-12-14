@extends('layouts.app')

@section('content')
<div class="flex">

    <x-sidebar></x-sidebar>
    {{-- @role('super-admin') --}}
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Users</h1>
        @can('create tags')
        <div class="mb-4">
            <label for="createTagModal"
               class="px-3 py-1 bg-black text-white text-sm rounded hover:bg-gray-700 float-right">
               Add Users
            </label>
            <x-modal.createTagModal></x-modal.createTagModal>
        </div>
        @endcan

        <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr>
                    <th class="py-1 px-3 border-b text-sm">ID</th>
                    <th class="py-1 px-3 border-b text-sm">Name</th>
                    <th class="py-1 px-3 border-b text-sm">Email</th>
                    <th class="py-1 px-3 border-b text-sm">Roles</th>
                    <th class="py-1 px-3 border-b text-sm text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $user->id }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $user->name }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $user->email ?? 'N/A' }}</td>
                    <td class="py-1 px-3 border-b text-sm text-center">{{ $user->roles->pluck('name')->join(', ') }}</td>
                    <td class="py-1 px-3 border-b">
                        <div class="flex justify-end space-x-2">

                            {{-- @can('edit users') --}}
                            <label for="editUserModal-{{ $user->id }}"
                               class="px-2 py-1 text-sm text-green-500 rounded hover:underline">
                               Edit
                            </label>
                            {{-- <x-modal.editTagModal :user="$user"></x-modal.editTagModal> --}}
                            {{-- @endcan --}}

                            {{-- @can('delete users') --}}
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="px-2 py-1 text-sm text-orange-500 rounded hover:underline">
                                    Delete
                                </button>
                            </form>
                            {{-- @endcan --}}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    {{-- @else
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Access Denied</h1>
        <p>You do not have permission to access this page.</p>
    </main>
    --}}
</div>
@endsection
