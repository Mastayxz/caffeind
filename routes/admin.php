<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

// use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'showUser'])->name('admin.users');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
});
