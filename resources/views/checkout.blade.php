@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto p-6">
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
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-[#706D54]">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Color
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0; @endphp

                                @foreach ($cartItems as $item)
                                    <tr class="border-b border-gray-200">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->product->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                class="flex items-center space-x-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1"
                                                    class="w-20 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-3 rounded text-sm">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-3 rounded text-sm"
                                                    onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $totalPrice += $item->product->price * $item->quantity; @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="text-xs bg-[#b3ac73]">
                                    <td colspan="3"
                                        class="py-3 px-4 text-right text-base font-semibold text-white">
                                        Total Belanja:
                                    </td>
                                    <td colspan="2" class="py-3 px-4 text-base font-semibold text-white">
                                        Rp{{ number_format($totalPrice, 0, ',', '.') }}
                                    </td>
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

                        <button type="submit" class="w-full bg-[#706D54] text-white px-6 py-3 rounded-md transition-colors duration-300 font-semibold text-md cursor-pointer">
                            Selesaikan Pesanan
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection