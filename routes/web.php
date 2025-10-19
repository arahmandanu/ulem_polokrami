<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PublicController;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'welcome']);
Route::post('/create_comment', [PublicController::class, 'createComment'])->name('public.createComment');

Route::get('/admin_login', function () {
    return view('auth.login');
})->name('login');

// Proses login (Anda perlu membuat controller dan logic ini)
Route::post('/login', [AuthenticationController::class, 'login']);
// Ganti YourAuthController dengan Controller autentikasi Anda

// Proses logout (dapat menggunakan Auth bawaan)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
});

// --- ADMIN DASHBOARD ROUTES ---
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('comments', CommentController::class);
});
