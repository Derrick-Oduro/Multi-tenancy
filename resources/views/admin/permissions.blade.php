{{-- this page is where super admin can attach and detach the permissions assigned to roles --}}
@extends('layouts.app')
@section('content')
<div class="flex">
    <x-sidebar></x-sidebar>
    <main class="w-3/4 p-6 bg-gray-100 min-h-screen w-full">
        <h1 class="text-2xl font-bold mb-4">Role Permissions Management</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr>
                    <th class="py-3 px-4 border-b text-left">ID</th>
                    <th class="py-3 px-4 border-b text-left">Role Name</th>
                    <th class="py-3 px-4 border-b text-left">Guard Name</th>
                    <th class="py-3 px-4 border-b text-left">Permissions Count</th>
                    <th class="py-3 px-4 border-b text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $role)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 border-b">{{ $role->id }}</td>
                    <td class="py-3 px-4 border-b">{{ $role->name }}</td>
                    <td class="py-3 px-4 border-b">{{ $role->guard_name }}</td>
                    <td class="py-3 px-4 border-b">{{ $role->permissions->count() }}</td>
                    <td class="py-3 px-4 border-b text-right">
                        @can('manage tenants')
                        <label for="managePermissionsModal-{{ $role->id }}"
                               class="text-blue-600 hover:text-blue-800 cursor-pointer font-medium">
                            Manage Permissions
                        </label>
                        @endcan
                    </td>
                </tr>

                {{-- Modal for this role --}}
                <x-modal.managePermissionsModal :role="$role" :allPermissions="$permissions" />
                @endforeach
            </tbody>
        </table>
    </main>
</div>
@endsection
