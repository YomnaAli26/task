<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

// Load authentication routes first
require __DIR__ . '/auth.php';
Route::get('/home', function () {
    return view('home');
})->name('home');
// Apply middleware and define routes
Route::middleware(['auth', CheckAdmin::class])->name('admin.')->group(function () {
    Route::redirect('/', '/dashboard'); // Redirect root to dashboard
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard'); // Dashboard view
    Route::resource('posts', PostController::class); // Resource routes for posts
});


