<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


route::prefix('/admin/dashboard')->group(function() {
    route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});
