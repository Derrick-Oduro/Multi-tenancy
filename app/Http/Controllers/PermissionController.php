<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view("admin.permissions", compact("permissions", "roles"));
    }

    /**
     * Attach a permission to a role.
     */
    public function attachPermission(Request $request, Role $role)
    {
        $request->validate([
            'permission_id' => 'required|exists:permissions,id'
        ]);

        $permission = Permission::findOrFail($request->permission_id);

        $role->givePermissionTo($permission);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return back()->with('success', 'Permission attached successfully');
    }

    /**
     * Detach a permission from a role.
     */
    public function detachPermission(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return back()->with('success', 'Permission removed successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permission)
    {
        //
    }
}
