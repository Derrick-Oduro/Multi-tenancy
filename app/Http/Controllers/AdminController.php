<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }
        return view('admin');
    }

    public function roles()
    {
        // if (!auth()->user() || !auth()->user()->isAdmin()) {
        //     abort(403, 'Unauthorized access');
        // }

        $users = User::all();
        return view('admin.roles', compact('users'));
    }

    public function updateRoles(Request $request)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'required|in:admin,editor,author,guest'
        ]);

        foreach ($request->roles as $userId => $role) {
            User::where('id', $userId)->update(['role' => $role]);
        }

        return redirect()->back()->with('success', 'Roles updated successfully!');
    }
}
