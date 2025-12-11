<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tenant_id',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Global scope for tenant isolation
    protected static function booted()
    {
        static::addGlobalScope('tenant', function ($query) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $query->where('tenant_id', auth()->user()->tenant_id);
            }
        });

        static::creating(function ($tag) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $tag->tenant_id = auth()->user()->tenant_id;
            }
        });
    }
}
