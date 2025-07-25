@extends('layouts.app')

@section('title', 'Keranjang Belanja Anda')

@section('content')
    <div class="container mx-auto p-6 h-100">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Keranjang Belanja Anda</h2>
            <a href="{{ route('products.index') }}"
                class="mt-0 mb-3 inline-block text-cream underline hover:text-light-brown">
                Back to Menu </a>
                    @if ($cartItems->isEmpty())
                        <p class="text-center text-gray-600">
                            Keranjang belanja Anda kosong. Yuk,
                            <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">mulai belanja</a>!
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <thead class="text-xs text-white uppercase bg-[#706D54]">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Nama produk
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Harga Satuan
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Jumlah
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Subtotal
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalPrice = 0; @endphp

                                        @foreach ($cartItems as $item)
                                            <tr class="border-b border-gray-200">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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

                            <div class="flex justify-end mt-6">
                                <a href="{{ route('checkout.index') }}"
                                    class="bg-[#706D54] text-white font-semibold py-3 px-6 rounded-md shadow-lg">
                                    Lanjutkan ke Pembayaran
                                </a>
                            </div>
                    @endif
        </div>
    </div>
@endsection
