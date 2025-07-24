<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tetap sertakan Auth, tapi kita tidak akan menggunakannya untuk user_id di sini

class CartController extends Controller
{
    // ID user statis yang akan digunakan untuk pengujian
    private $staticUserId = 1; // Anda bisa ubah ini ke ID user yang ada di database Anda

    public function index()
    {
        // Menggunakan ID user statis alih-alih Auth::user()->id
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

        // Menggunakan ID user statis
        $userId = $this->staticUserId;
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
            return redirect()->back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui!');
        } else {
            Cart::create([
                'user_id' => $userId, // Menggunakan ID user statis
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        }
    }

    public function update(Request $request, Cart $cart)
    {
        // Tetap melakukan validasi kepemilikan, tetapi bandingkan dengan ID user statis
        // PERHATIAN: Ini tidak akan mengizinkan user lain mengupdate, hanya user dengan ID statis.
        // Jika Anda ingin menguji update untuk user lain, Anda perlu mengubah staticUserId.
        if ($cart->user_id !== $this->staticUserId) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah item keranjang ini.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->quantity = $request->input('quantity');
        $cart->save();

        return redirect()->back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui!');
    }

    public function destroy(Cart $cart)
    {
        // Tetap melakukan validasi kepemilikan, tetapi bandingkan dengan ID user statis
        if ($cart->user_id !== $this->staticUserId) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus item keranjang ini.');
        }

        $cart->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}