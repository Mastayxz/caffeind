<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/', function () {
    return view('welcome');
});




require __DIR__ . '/admin.php';
