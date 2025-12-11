<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;
    public function index()
    {
        $tags = Tags::all();
        return view('admin.tags', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tags::all();
        return view('tag.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create.tag', Tags::class);
        $request->validate([
            'name' => 'required|string|max:255|',
            'slug' => 'required|string|max:255|unique:tags,slug',
        ]);

        Tags::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tags $tags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $tags)
    {
        $tags = Tags::findOrFail($tags->id);
        return view('tag.edit', compact('tags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tags $tags)
    {
        $this->authorize('update.tag', $tags);
        $request->validate([
            'name' => 'required|string|max:255|',
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tags->id,
        ]);
        $tags->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tags $tags)
    {
        $this->authorize('delete.tag', $tags);
        $tags->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
