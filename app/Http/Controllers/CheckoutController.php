<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->product->price * $item->quantity;
        }

        return view('checkout', compact('cartItems', 'totalAmount'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'order_type' => 'required|in:pickup,dine_in', // Validasi tipe pesanan
            'payment_method' => 'required|in:cash,bank_transfer,qris', // Metode pembayaran
        ]);

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong. Tidak dapat melanjutkan checkout.');
        }

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            $orderNumber = 'ORD-' . strtoupper(uniqid()); // Generate nomor pesanan unik sederhana

            foreach ($cartItems as $item) {
                $product = $item->product; // Ambil objek produk terkait

                // Pastikan produk ada dan stoknya mencukupi
                if (!$product || $product->stock < $item->quantity) {
                    DB::rollBack(); // Batalkan transaksi jika stok tidak cukup
                    return redirect()->route('cart.index')->with('error', 'Stok ' . ($product ? $product->name : 'produk tidak dikenal') . ' tidak mencukupi. Mohon sesuaikan kuantitas di keranjang.');
                }
                $totalAmount += $product->price * $item->quantity;
            }

            $order = Order::create([
                'user_id' => $userId,
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'order_type' => $request->input('order_type'),
                'payment_method' => $request->input('payment_method'),
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price_at_order' => $item->product->price,
                ]);

                $product = $item->product;
                $product->stock -= $item->quantity;
                $product->save();
            }

            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->id)->with('success', 'Pesanan Anda berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Mohon coba lagi. ' . $e->getMessage());
        }
    }

    public function success($orderId)
    {
        $order = Order::with('items.product')->find($orderId);

        if (!$order || $order->user_id !== Auth::id()) {
            abort(404);
        }

        return view('checkout-success', compact('order'));
    }
}
