<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tags;
use App\Models\Category;
use App\Models\Subscriber;
use App\Mail\NewPostNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
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
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create.post');

        $categories = Category::all();
        $tags = Tags::all();
        return view('post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $this->authorize('create.post');

        $validatedData = $request->validated();
        $imagePath = "";
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create the post
        $post = Post::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'image' => $imagePath,
            'category_id' => $validatedData['category_id'],
            'user_id' => auth()->id(),
            // 'tag_id' => $validatedData['tag_id'],
        ]);

        // Email subscribers
        try {
            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new NewPostNotification($post));
            }
            $emailSuccess = true;
        } catch (\Exception $e) {
            // Log the error but don't stop post creation
            \Log::error('Failed to send email notification: ' . $e->getMessage());
            $emailSuccess = false;
        }

        $message = 'Post created successfully! email notifications sent to subscribers.';
        if (!$emailSuccess) {
            $message .= ' (Note: Email notifications could not be sent)';
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
        $this->authorize('edit.post', $post);

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
        $this->authorize('edit.post', $post);

        $validatedData = $request->validated();
        $imagePath = $post->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'image' => $imagePath,
            'category_id' => $validatedData['category_id'],
            // user_id should not be updated here
            'user_id' => $post->user_id,
            // 'tag_id' => $validatedData['tag_id'],
        ]);

        return redirect()->route('posts.admin')->with('success', 'Post updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete.post', $post);

        $post->delete();
        return redirect('/admin/posts')->with('success', 'Post deleted successfully!');
    }

    public function postsByCategory(Category $category)
    {
        $posts = Post::with('category')
        ->where('category_id', $category->id)
        ->get();
        return view('category-post', compact('posts'));
    }
}
