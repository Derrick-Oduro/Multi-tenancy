<?php

namespace App\Providers;

use Gate;
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
        Gate::define('admin.access', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('author.create.post', function ($user) {
            return in_array($user->role, ['admin', 'author']);
        });

        Gate::define('author.edit.own.post', function ($user, $post) {
            return $user->role === 'admin' || ($user->role === 'author' && $post->user_id === $user->id);
        });

        Gate::define('author.delete.own.post', function ($user, $post) {
            return $user->role === 'admin' || ($user->role === 'author' && $post->user_id === $user->id);
        });

        Gate::define('editor.edit.post', function ($user) {
            return in_array($user->role, ['admin', 'editor']);
        });

        Gate::define('create.post', function ($user) {
            return in_array($user->role, ['admin', 'author']);
        });

        Gate::define('edit.post', function ($user, $post) {

            if ($user->role === 'admin' || $user->role === 'editor') {
                return true;
            }

            if ($user->role === 'author') {
                return $post->user_id === $user->id;
            }

            return false;
        });

        Gate::define('delete.post', function ($user, $post) {

            if ($user->role === 'admin') {
                return true;
            }

            if ($user->role === 'author') {
                return $post->user_id === $user->id;
            }

            return false;
        });

        Gate::define('delete.category', function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('create.category', function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('update.category', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('delete.tag', function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('create.tag', function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('update.tag', function ($user) {
            return $user->role === 'admin';
        });
    }
}
