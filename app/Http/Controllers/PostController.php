<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tags;
use App\Models\Category;
use App\Models\Subscriber;
use App\Mail\NewPostNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Posts are automatically filtered by tenant via global scope
        $posts = Post::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        $secondLatest = $posts->skip(3)->first();

        return view('posts', [
            'posts' => $posts,
            'secondLatest' => $secondLatest
        ]);
    }

    public function getPostModal($id)
    {
        $post = Post::findOrFail($id);
        return view('components.modal.editPostModal', compact('post'));
    }

    public function admin()
    {
        // Check permission using Spatie
        if (!auth()->user()->can('view posts')) {
            abort(403, 'Unauthorized action.');
        }

        // Posts are automatically filtered by tenant
        $posts = Post::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.posts', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check permission using Spatie
        if (!auth()->user()->can('create posts')) {
            abort(403, 'Unauthorized action.');
        }

        // Categories and tags are automatically filtered by tenant
        $categories = Category::all();
        $tags = Tags::all();

        return view('post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('create posts')) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validated();
        $imagePath = "";

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create the post (tenant_id and user_id automatically set via model boot)
        $post = Post::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'image' => $imagePath,
            'category_id' => $validatedData['category_id'],
            'user_id' => auth()->id(),
        ]);

        // Email subscribers (only from current tenant)
        try {
            $subscribers = Subscriber::all(); // Automatically filtered by tenant
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new NewPostNotification($post));
            }
            $emailSuccess = true;
        } catch (\Exception $e) {
            // Log the error but don't stop post creation
            \Log::error('Failed to send email notification: ' . $e->getMessage());
            $emailSuccess = false;
        }

        $message = 'Post created successfully!';
        if ($emailSuccess) {
            $message .= ' Email notifications sent to subscribers.';
        }

        return redirect()->route('posts.admin')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('singlepost', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Check if user can edit this specific post using custom Gate
        if (!auth()->user()->can('edit.own.post', $post)) {
            abort(403, 'Unauthorized action.');
        }

        $post = Post::findOrFail($post->id);
        $categories = Category::all();
        $tags = Tags::all();

        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // Check if user can edit this specific post using custom Gate
        if (!auth()->user()->can('edit.own.post', $post)) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validated();
        $imagePath = $post->image;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                \Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'image' => $imagePath,
            'category_id' => $validatedData['category_id'],
            // user_id should not be updated here
            'user_id' => $post->user_id,
        ]);

        return redirect()->route('posts.admin')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Check if user can delete this specific post using custom Gate
        if (!auth()->user()->can('delete.own.post', $post)) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image if exists
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect('/admin/posts')->with('success', 'Post deleted successfully!');
    }

    public function postsByCategory(Category $category)
    {
        // Posts are automatically filtered by tenant
        $posts = Post::with('category')
            ->where('category_id', $category->id)
            ->get();

        return view('category-post', compact('posts'));
    }
}
