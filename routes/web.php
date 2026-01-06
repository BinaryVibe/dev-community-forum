<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Home Page (Post List)
Route::get('/', [PostController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// GET: Show Register Form
Route::get('/signup', [AuthController::class, 'showRegister'])->name('signup');

// POST: Handle Login Logic
Route::post('/login', [AuthController::class, 'login'])->name('verify');

// POST: Handle Registration Logic
Route::post('/register', [AuthController::class, 'register'])->name('register');

// POST: Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/posts', [PostController::class, 'allPosts'])->name('posts.index');

// Single Post Page
Route::get('/posts/{id}', action: [PostController::class, 'show'])->name('posts.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


// Protected Routes (User must be logged in)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Show the Create Form
    Route::get('/create-post', [PostController::class, 'create'])->name('posts.create');

    // Handle the Form Submission
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::post('/posts/{id}/vote', [PostController::class, 'vote'])->name('posts.vote');
    Route::post('/posts/{id}/comments', [PostController::class, 'storeComment'])->name('comments.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});