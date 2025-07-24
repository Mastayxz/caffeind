<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (!$userId) {
            return back()->with('error', 'Anda harus login untuk menambahkan produk ke keranjang.');
        }

        $product = Product::find($productId);

        if (!$product || $product->stock < $quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;

            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Stok produk tidak mencukupi untuk penambahan ini.');
            }

            $cartItem->update(['quantity' => $newQuantity]);
            return back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui!');
        }

        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengubah item keranjang ini.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $newQuantity = $request->input('quantity');
        $product = $cart->product;

        if (!$product || $product->stock < $newQuantity) {
            return back()->with('error', 'Stok produk tidak mencukupi untuk jumlah yang diminta.');
        }

        $cart->update(['quantity' => $newQuantity]);
        return back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui!');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus item keranjang ini.');
        }

        $cart->delete();
        return back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
