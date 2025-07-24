<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


route::prefix('/admin')->group(function () {
    route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
