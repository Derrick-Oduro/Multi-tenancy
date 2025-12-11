<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }

    public function getPostModal($id)
    {
        $post = Post::findOrFail($id);
        return view('components.modal.editPostModal', compact('post'));
    }

    protected $fillable = [
        'title',
        'body',
        'image',
        'category_id',
        'user_id',

    ];
}
