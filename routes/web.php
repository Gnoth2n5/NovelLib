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
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::post('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
    Route::get('/novels', [AdminController::class, 'novels'])->name('novels.index');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
    Route::get('/comments', [AdminController::class, 'comments'])->name('comments.index');
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
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/toggle-hidden', [CommentController::class, 'toggleHidden'])->name('comments.toggle-hidden');
});

// Author request routes
Route::resource('author-requests', AuthorRequestController::class);
Route::post('/author-requests/{authorRequest}/approve', [AuthorRequestController::class, 'approve'])->name('author-requests.approve');
Route::post('/author-requests/{authorRequest}/reject', [AuthorRequestController::class, 'reject'])->name('author-requests.reject');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';