@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-8 text-center text-coffee-brown">Selesaikan Pesanan Anda</h1>

        @if($cartItems->isEmpty())
            <p class="text-center text-gray-600 text-lg">Keranjang Anda kosong. Tidak ada yang bisa di-checkout.</p>
            <div class="flex justify-center mt-6">
                <a href="{{ url('/products') }}" class="bg-coffee-brown text-cream px-6 py-3 rounded-md hover:bg-dark-brown transition-colors duration-300">Kembali Belanja</a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-semibold mb-4 text-coffee-brown">Ringkasan Pesanan</h2>
                    <div class="overflow-x-auto bg-gray-50 p-4 rounded-md shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->product->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-100">
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-right text-base font-bold text-gray-900">Total Pembayaran:</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base font-bold text-coffee-brown">Rp{{ number_format($totalAmount, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <h2 class="text-2xl font-semibold mb-4 text-coffee-brown">Detail Pesanan & Pembayaran</h2>
                    <form action="{{ route('checkout.process') }}" method="POST" class="bg-gray-50 p-6 rounded-md shadow-sm">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan Pengambilan</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" id="pickup" name="order_type" value="pickup" checked class="focus:ring-coffee-brown h-4 w-4 text-coffee-brown border-gray-300">
                                    <label for="pickup" class="ml-2 block text-base text-gray-900">Ambil di Kafe (Pickup)</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="dine_in" name="order_type" value="dine_in" class="focus:ring-coffee-brown h-4 w-4 text-coffee-brown border-gray-300">
                                    <label for="dine_in" class="ml-2 block text-base text-gray-900">Makan di Tempat (Dine-in)</label>
                                </div>
                            </div>
                            @error('order_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Metode Pembayaran --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" id="cash" name="payment_method" value="cash" checked class="focus:ring-coffee-brown h-4 w-4 text-coffee-brown border-gray-300">
                                    <label for="cash" class="ml-2 block text-base text-gray-900">Bayar di Tempat (Cash/Debit)</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" class="focus:ring-coffee-brown h-4 w-4 text-coffee-brown border-gray-300">
                                    <label for="bank_transfer" class="ml-2 block text-base text-gray-900">Transfer Bank</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="qris" name="payment_method" value="qris" class="focus:ring-coffee-brown h-4 w-4 text-coffee-brown border-gray-300">
                                    <label for="qris" class="ml-2 block text-base text-gray-900">QRIS</label>
                                </div>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition-colors duration-300 font-semibold text-lg">
                            Selesaikan Pesanan
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection