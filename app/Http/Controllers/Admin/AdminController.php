<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin.dashboard');
    }

    public function showUser()
    {
        $user = User::where('role', 'user')->get();

        return view('admin.user', compact('user'));

    }
}
