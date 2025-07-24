<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product; // Pastikan model Product di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ID user statis yang akan digunakan untuk pengujian
    // Pastikan untuk mengembalikan ini ke Auth::user()->id setelah pengujian selesai
    private $staticUserId = 1;

    public function index()
    {
        $userId = $this->staticUserId;
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = $this->staticUserId;
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Dapatkan produk untuk memeriksa stok
        $product = Product::find($productId);

        // Jika produk tidak ditemukan atau stoknya kurang
        if (!$product || $product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Hitung total quantity setelah update
            $newQuantity = $cartItem->quantity + $quantity;

            // Cek kembali stok setelah penambahan
            if ($product->stock < $newQuantity) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi untuk penambahan ini.');
            }

            $cartItem->quantity = $newQuantity;
            $cartItem->save();
            return redirect()->back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui!');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        }
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== $this->staticUserId) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah item keranjang ini.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $newQuantity = $request->input('quantity');

        // Dapatkan produk untuk memeriksa stok
        $product = $cart->product; // Menggunakan relasi untuk mendapatkan produk

        // Cek stok produk
        if (!$product || $product->stock < $newQuantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi untuk jumlah yang diminta.');
        }

        $cart->quantity = $newQuantity;
        $cart->save();

        return redirect()->back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui!');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== $this->staticUserId) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus item keranjang ini.');
        }

        $cart->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}