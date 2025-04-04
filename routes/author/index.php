<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:author'])->prefix('author')->name('author.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Author\DashboardController::class, 'index'])->name('dashboard');
    
    // Novels
    Route::get('/novels', [App\Http\Controllers\Author\NovelController::class, 'index'])->name('novels.index');
    Route::get('/novels/create', [App\Http\Controllers\Author\NovelController::class, 'create'])->name('novels.create');
    Route::post('/novels', [App\Http\Controllers\Author\NovelController::class, 'store'])->name('novels.store');
    Route::get('/novels/{novel}/edit', [App\Http\Controllers\Author\NovelController::class, 'edit'])->name('novels.edit');
    Route::put('/novels/{novel}', [App\Http\Controllers\Author\NovelController::class, 'update'])->name('novels.update');
    Route::delete('/novels/{novel}', [App\Http\Controllers\Author\NovelController::class, 'destroy'])->name('novels.destroy');
    Route::get('/novels/{novel}', [App\Http\Controllers\Author\NovelController::class, 'show'])->name('novels.show');
    
    // Chapters
    Route::get('/novels/{novel}/chapters', [App\Http\Controllers\Author\ChapterController::class, 'index'])->name('chapters.index');
    Route::get('/novels/{novel}/chapters/create', [App\Http\Controllers\Author\ChapterController::class, 'create'])->name('chapters.create');
    Route::post('/novels/{novel}/chapters', [App\Http\Controllers\Author\ChapterController::class, 'store'])->name('chapters.store');
    Route::get('/novels/{novel}/chapters/{chapter}/edit', [App\Http\Controllers\Author\ChapterController::class, 'edit'])->name('chapters.edit');
    Route::put('/novels/{novel}/chapters/{chapter}', [App\Http\Controllers\Author\ChapterController::class, 'update'])->name('chapters.update');
    Route::delete('/novels/{novel}/chapters/{chapter}', [App\Http\Controllers\Author\ChapterController::class, 'destroy'])->name('chapters.destroy');

    Route::get('/novels/{novel}/chapters/{chapter}/publish', [App\Http\Controllers\Author\ChapterController::class, 'pushlish'])->name('chapters.publish');
});