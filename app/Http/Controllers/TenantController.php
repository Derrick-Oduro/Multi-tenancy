<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenant = Tenant::all();
        return view("admin.tenants", compact("tenant"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('manage tenants')) {
            abort(403, 'Unauthorized action.');
        }
        $tenants = Tenant::all();
        return view('components.modal.createTenantModal',compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('manage tenants')) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:tenants,domain',
        ]);
        Tenant::create([
            'name' => $request->input('name'),
            'slug'=> $request->input('slug'),
            'domain' => $request->input('domain'),
        ]);
        return redirect()->route('tenants.index')->with('success','Tenant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        if (!auth()->user()->can('manage tenants')) {
            abort(403, 'Unauthorized action.');
        }
        return view('components.modal.editTenantModal', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        if (!auth()->user()->can('manage tenants')) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:tenants,domain,' . $tenant->id,
        ]);
        $tenant->update([
            'name' => $request->input('name'),
            'domain' => $request->input('domain'),
        ]);
        return redirect()->route('tenants.index')->with('success','Tenant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        if(!auth()->user()->can('manage tenants')) {
            abort(403, 'Unauthorized action.');
        }
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
