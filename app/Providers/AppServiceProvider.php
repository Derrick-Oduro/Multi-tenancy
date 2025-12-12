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


        Gate::define('edit.own.post', function ($user, $post) {
            if ($user->hasRole(['admin', 'editor'])) {
                return true;
            }

            if ($user->hasRole('author')) {
                return $post->user_id === $user->id;
            }

            return false;
        });

        Gate::define('delete.own.post', function ($user, $post) {
            if ($user->hasRole('admin')) {
                return true;
            }

            if ($user->hasRole('author')) {
                return $post->user_id === $user->id;
            }

            return false;
        });
    }
}
