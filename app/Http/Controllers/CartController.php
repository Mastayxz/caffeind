<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        return view('cart');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Products::find($productId);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        }

        // Add product to cart
        $cart = session()->get('cart', []);
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
        ];
        session()->put('cart', $cart);

        return redirect()->route('products.index')->with('success', 'Product added to cart successfully!');
    }
}
