<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthorRequestController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin routes
require __DIR__ . '/admin/index.php';


// Author routes
require __DIR__ . '/author/index.php';

// Public routes
Route::get('/novels', [NovelController::class, 'index'])->name('novels.index');
Route::get('/novels/{novel}', [NovelController::class, 'show'])->name('novels.show');
Route::get('/novels/{novel}/chapters/{chapter}', [ChapterController::class, 'show'])->name('chapters.show');

// Comment routes
Route::middleware(['auth'])->group(function () {
    // web.php
    Route::post('/novels/{novel}/comments', [CommentController::class, 'store'])->name('novels.comments.store');
    Route::post('/novels/{novel}/chapters/{chapter}/comments', [CommentController::class, 'store'])->name('chapters.comments.store');
    
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/toggle-hidden', [CommentController::class, 'toggleHidden'])->name('comments.toggle-hidden');
});

// Author request routes
Route::middleware(['auth'])->group(function () {
    // Route cho người dùng
    Route::get('/author-requests/create', [AuthorRequestController::class, 'create'])->name('author-requests.create');
    Route::post('/author-requests', [AuthorRequestController::class, 'store'])->name('author-requests.store');

});

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

require __DIR__ . '/auth.php';