<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


route::prefix('/admin')->group(function() {
    route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('product',ProductController::class);
    Route::resource('category',CategoryController::class);
});
