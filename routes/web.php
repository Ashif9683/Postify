<?php

use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\User\UserController;

// Default home page
Route::get('/',[HomeController::class,'home']);
Route::get('/post/{id}',[HomeController::class,'post']);

// Admin Panel Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

});


// User Panel Routes

// Public Routes
Route::get('/signUp', [UserController::class, 'signUp'])->name('user.signUp');
Route::post('/signUp', [UserController::class, 'store'])->name('user.signUp.submit');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginUser'])->name('user.login.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

// Protected Routes (Require Login)
Route::middleware('auth')->group(function () {
    Route::get('/user/mypost', [UserController::class, 'myPosts'])->name('user.mypost');
    Route::get('/user/addPost', [UserController::class, 'addPost'])->name('user.post.create');
    Route::post('/user/posts', [UserController::class, 'storePost'])->name('user.posts.store');
    Route::get('/user/post/{id}/edit', [UserController::class, 'editPost'])->name('user.posts.edit');
    Route::put('/user/post/{id}', [UserController::class, 'updatePost'])->name('user.posts.update');
    Route::get('/user/post/{id}/delete', [UserController::class, 'deletePost'])->name('user.posts.delete');
});
