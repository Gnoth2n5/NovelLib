<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorRequestController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Users routes
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::post('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');

    // Novels routes
    Route::get('/novels', [AdminController::class, 'novels'])->name('novels.index');
    Route::delete('/novels/{novel}', [AdminController::class, 'deleteNovel'])->name('novels.delete');

    // Categories routes
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory'])->name('categories.delete');

    // Comments routes
    Route::get('/comments', [AdminController::class, 'comments'])->name('comments.index');
    Route::delete('/comments/{comment}', [AdminController::class, 'deleteComment'])->name('comments.delete');
});

// Author routes
Route::middleware(['auth'])->group(function () {
    Route::resource('novels', NovelController::class);
    Route::resource('chapters', ChapterController::class)->except(['index', 'show']);
    Route::get('/my-novels', [NovelController::class, 'myNovels'])->name('novels.my');
});

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
Route::resource('author-requests', AuthorRequestController::class);
Route::post('/author-requests/{authorRequest}/approve', [AuthorRequestController::class, 'approve'])->name('author-requests.approve');
Route::post('/author-requests/{authorRequest}/reject', [AuthorRequestController::class, 'reject'])->name('author-requests.reject');

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

require __DIR__ . '/auth.php';
