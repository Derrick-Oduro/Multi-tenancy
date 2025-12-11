<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Categories are automatically filtered by tenant
        $categories = Category::all();
        return view('admin.categories', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check permission using Spatie
        if (!auth()->user()->can('create categories')) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('create categories')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        // tenant_id is automatically set via model boot method
        Category::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = Category::findOrFail($category->id);
        // Posts are automatically filtered by tenant
        $posts = Post::orderBy('created_at', 'desc')->get();
        $secondLatest = $posts->skip(1)->first();

        return view('category-post', [
            'secondLatest' => $secondLatest,
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('edit categories')) {
            abort(403, 'Unauthorized action.');
        }

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('edit categories')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('delete categories')) {
            abort(403, 'Unauthorized action.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
