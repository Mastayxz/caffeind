<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        // Fetch products from the database
        // $products = Product::all();

        // Return the view with products
        return view('home');
    }
}
