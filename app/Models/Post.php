<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'tenant_id',
        'user_id',
        'category_id'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'post_tag');
    }

    // Scope to filter by tenant
    public function scopeForTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    // Global scope to automatically filter by current tenant
    protected static function booted()
    {
        static::addGlobalScope('tenant', function ($query) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $query->where('tenant_id', auth()->user()->tenant_id);
            }
        });

        static::creating(function ($post) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $post->tenant_id = auth()->user()->tenant_id;
            }
            if (auth()->check() && !$post->user_id) {
                $post->user_id = auth()->id();
            }
        });
    }
}
