<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Spatie Permission handles most of this automatically
        // But we can add custom gates for specific logic

        Gate::define('edit.own.post', function ($user, $post) {
            // Admin and editor can edit any post
            if ($user->hasRole(['admin', 'editor'])) {
                return true;
            }

            // Author can only edit their own post
            if ($user->hasRole('author')) {
                return $post->user_id === $user->id;
            }

            return false;
        });

        Gate::define('delete.own.post', function ($user, $post) {
            // Admin can delete any post
            if ($user->hasRole('admin')) {
                return true;
            }

            // Author can only delete their own post
            if ($user->hasRole('author')) {
                return $post->user_id === $user->id;
            }

            return false;
        });
    }
}
