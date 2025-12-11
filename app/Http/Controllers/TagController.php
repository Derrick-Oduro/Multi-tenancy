<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tags are automatically filtered by tenant
        $tags = Tags::withCount('posts')->latest()->paginate(10);
        return view('admin.tags', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check permission using Spatie
        if (!auth()->user()->can('create tags')) {
            abort(403, 'Unauthorized action.');
        }

        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('create tags')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // tenant_id is automatically set via model boot
        Tags::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('tags.index')
            ->with('success', 'Tag created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $tag)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('edit tags')) {
            abort(403, 'Unauthorized action.');
        }

        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tags $tag)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('edit tags')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('tags.index')
            ->with('success', 'Tag updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tags $tag)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('delete tags')) {
            abort(403, 'Unauthorized action.');
        }

        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag deleted successfully!');
    }
}
