<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;



Route::controller(CategoryController::class)->name('categories.')->group(function () {
    Route::get('/categories', 'index')->name('index');
    Route::post('/categories', 'store')->name('store');
    Route::put('/categories/{category}', 'update')->name('update');
    Route::delete('/categories/{category}', 'delete')->name('delete');
});

