<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin');
    }

    public function roles()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $users = User::where('tenant_id', auth()->user()->tenant_id)->get();
        $roles = Role::all();

        return view('admin.roles', compact('users', 'roles'));
    }

    public function updateRoles(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'required|in:admin,editor,author,guest'
        ]);

        foreach ($request->roles as $userId => $role) {
            $user = User::where('id', $userId)
                ->where('tenant_id', auth()->user()->tenant_id)
                ->first();

            if ($user) {
                $user->syncRoles([$role]);
            }
        }

        return redirect()->back()->with('success', 'Roles updated successfully!');
    }
}
