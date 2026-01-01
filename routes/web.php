<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public Home Page (Redirects to Login for now)
Route::get('/', function () {
    return redirect()->route('login');
});

// Protected Routes (User must be logged in)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard shows all posts
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

    // Post Management Routes
    Route::resource('posts', PostController::class);
    
    // Profile Management (Default Laravel)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
