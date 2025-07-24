<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index()
    {
        $products = Products::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
