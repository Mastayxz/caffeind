<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

// use App\Http\Controllers\AdminController;

Route::prefix('admin')->name('admin.')->middleware(['isAdmin', 'auth'], )->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name(name: 'dashboard');
    Route::get('/users', [AdminController::class, 'showUser'])->name('users');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('user.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('user.destroy');
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
});
