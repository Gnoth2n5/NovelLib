<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthorRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Users routes
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::post('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');

    // Novels routes
    Route::get('/novels', [AdminController::class, 'novels'])->name('novels.index');
    Route::delete('/novels/{novel}', [AdminController::class, 'deleteNovel'])->name('novels.delete');

    // Categories routes
    require __DIR__ . '/category.php';

    // Comments routes
    Route::get('/comments', [AdminController::class, 'comments'])->name('comments.index');
    Route::delete('/comments/{comment}', [AdminController::class, 'deleteComment'])->name('comments.delete');

    Route::get('/author-requests', [AuthorRequestController::class, 'index'])->name('author-requests.index');
    Route::post('/author-requests/{authorRequest}/approve', [AuthorRequestController::class, 'approve'])->name('author-requests.approve');
    Route::post('/author-requests/{authorRequest}/reject', [AuthorRequestController::class, 'reject'])->name('author-requests.reject');
    Route::get('/author-requests/{authorRequest}', [AuthorRequestController::class, 'show'])->name('author-requests.show');

});