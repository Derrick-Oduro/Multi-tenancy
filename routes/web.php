<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Route::get('/', [PostController::class, 'index']);

Route::resource('posts', controller: PostController::class)->names('posts');
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);

// users



Route::middleware(['auth'])->group(function () {
    Route::get('/role', [AdminController::class, 'roles'])->name('admin.roles');
    Route::put('/role', [AdminController::class, 'updateRoles'])->name('admin.roles.update');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/posts', [PostController::class, 'admin'])->name('posts.admin');
    Route::get('/posts/{id}/admin', [PostController::class, 'show'])->name('posts.show.admin');
});

// users
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->names('users');
    Route::put('/users/{id}/updateRoles', [AdminController::class, 'updateUserRoles'])->name('admin.users.updateRoles');
});

// permissions






Route::get('/posts/category/{category}', [PostController::class, 'postsByCategory'])->name('posts.byCategory');



//admin
Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/admin/posts', [PostController::class, 'admin'])->name('posts.admin');


//single post
Route::get('/posts/{id}/admin', [PostController::class, 'show'])->name('posts.show.admin');

Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe.store');
Route::resource('subscribers', SubscriberController::class);
