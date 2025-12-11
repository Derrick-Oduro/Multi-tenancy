<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'tenant_id'];

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

        static::creating(function ($subscriber) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $subscriber->tenant_id = auth()->user()->tenant_id;
            }
        });
    }
}
