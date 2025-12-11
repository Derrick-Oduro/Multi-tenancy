{{-- filepath: /home/derrick/development/BBC-duplicate/resources/views/admin/roles.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="flex">

    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>

    {{-- Main Content Area --}}
    @can('admin.access')
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Roles Management</h1>

        <form action="{{ route('admin.roles.update') }}" method="POST">
            @csrf
            @method('PUT')

            <table class="min-w-full bg-white rounded-lg">
                <thead>
                    <tr>
                        <th class="py-1 px-3 border-b text-sm">User</th>
                        <th class="py-1 px-3 border-b text-sm">Email</th>
                        <th class="py-1 px-3 border-b text-sm">Current Role</th>
                        <th class="py-1 px-3 border-b text-sm text-right">New Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="py-1 px-3 border-b text-sm text-center">{{ $user->name }}</td>
                        <td class="py-1 px-3 border-b text-sm text-center">{{ $user->email }}</td>
                        <td class="py-1 px-3 border-b text-sm text-center">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($user->role === 'admin') bg-red-100 text-red-800
                                @elseif($user->role === 'editor') bg-blue-100 text-blue-800
                                @elseif($user->role === 'author') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-1 px-3 border-b text-sm">
                            <div class="flex justify-end">
                                <select name="roles[{{ $user->id }}]" class="border rounded px-2 py-1 text-sm">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="editor" {{ $user->role == 'editor' ? 'selected' : '' }}>Editor</option>
                                    <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>Author</option>
                                    <option value="guest" {{ $user->role == 'guest' ? 'selected' : '' }}>Guest</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                <button type="submit" class="px-3 py-1 bg-black text-white text-sm rounded hover:bg-gray-700">
                    Update Roles
                </button>
            </div>
        </form>
    </main>
    @else
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Access Denied</h1>
        <p>You do not have permission to access this page.</p>
    </main>
    @endcan
</div>
@endsection
