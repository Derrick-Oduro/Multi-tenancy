<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole("super-admin")) {
            $users = User::all();
        } else {
            $users = User::where('tenant_id', auth()->user()->tenant_id)->get();
        }
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->can('create users')) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::where('tenant_id', auth()->user()->tenant_id)->get();
        return view('components.modal.createUserModal', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('create users')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tenant_id' => auth()->user()->tenant_id,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if(!auth()->user()->can('edit users')) {
            abort(403, 'Unauthorized action.');
        }

        if($user->tenant_id !== auth()->user()->tenant_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('components.modal.editUserModal', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(!auth()->user()->can('edit users')) {
            abort(403, 'Unauthorized action.');
        }

        if($user->tenant_id !== auth()->user()->tenant_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password'=>  bcrypt($request->password),
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(!auth()->user()->can('delete users')) {
            abort(403, 'Unauthorized action.');
        }

        if($user->tenant_id !== auth()->user()->tenant_id) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}
