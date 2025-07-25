@extends('layouts.app')

@section('title', 'Pesanan Berhasil!')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-3xl font-bold mb-6 text-center">Pesanan Berhasil Dibuat!</h1>
            <p class="text-center text-gray-700 text-lg mb-8">
                Terima kasih telah berbelanja di Coffee Shop kami. Pesanan Anda telah berhasil diterima.
            </p>

            <div class="border-t border-b border-gray-200 py-6 mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-coffee-brown">Detail Pesanan Anda</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg text-gray-800">
                    <div>
                        <p><strong class="font-semibold">Nomor Pesanan:</strong> <span
                                class="text-coffee-brown">{{ $order->order_number }}</span></p>
                        <p><strong class="font-semibold">Total Pembayaran:</strong> <span
                                class="text-coffee-brown">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </p>
                        <p><strong class="font-semibold">Status:</strong> <span
                                class="capitalize">{{ $order->status }}</span></p>
                        <p><strong class="font-semibold">Tipe Pesanan:</strong> <span
                                class="capitalize">{{ str_replace('_', ' ', $order->order_type) }}</span></p>
                    </div>
                    <div>
                        <p><strong class="font-semibold">Tanggal Pesan:</strong>
                            {{ $order->created_at->format('d M Y, H:i') }}</p>
                        <p><strong class="font-semibold">Metode Pembayaran:</strong> <span
                                class="capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span></p>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-semibold mb-4 text-coffee-brown">Item yang Dipesan:</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-10">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-[#706D54]">
                        <tr>
                            <th scope="col" class="px-6 py-3">Produk</th>
                            <th scope="col" class="px-6 py-3">Harga Satuan</th>
                            <th scope="col" class="px-6 py-3">Jumlah</th>
                            <th scope="col" class="px-6 py-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($order->items as $item)
                            <tr>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->product->name }}</th>
                                <td class="px-6 py-4">
                                    Rp{{ number_format($item->price_at_order, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ $item->quantity }}</td>
                                <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Rp{{ number_format($item->price_at_order * $item->quantity, 0, ',', '.') }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-4 mb-8" role="alert">
                <h4 class="font-bold text-lg mb-2">Instruksi Pembayaran:</h4>
                @if ($order->payment_method === 'cash')
                    <p>
                        Silakan lakukan pembayaran sebesar
                        <strong class="text-coffee-brown">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                        saat mengambil pesanan di kafe atau saat Anda makan di tempat.
                    </p>
                    <p class="text-sm mt-2">Pesanan Anda akan disiapkan setelah pembayaran dikonfirmasi.</p>
                @elseif($order->payment_method === 'bank_transfer')
                    <p>
                        Harap transfer sebesar
                        <strong class="text-coffee-brown">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                        ke rekening berikut:
                    </p>
                    <ul class="list-disc list-inside mt-2">
                        <li>Nama Bank: Bank ABC</li>
                        <li>Nomor Rekening: 1234567890</li>
                        <li>Atas Nama: PT. Ngopi Bareng</li>
                    </ul>
                    <p class="text-sm mt-2">
                        Pesanan Anda akan diproses setelah kami menerima konfirmasi pembayaran Anda.
                        Mohon sertakan nomor pesanan ({{ $order->order_number }}) dalam keterangan transfer.
                    </p>
                @elseif($order->payment_method === 'qris')
                    <p>
                        Silakan scan QRIS berikut untuk melakukan pembayaran sebesar
                        <strong
                            class="text-coffee-brown">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</strong>:
                    </p>
                    <p class="text-sm text-center">Gambar QRIS</p>
                    <p class="text-sm mt-2">Pesanan Anda akan diproses setelah pembayaran QRIS Anda berhasil.</p>
                @else
                    <p>
                        Instruksi pembayaran untuk metode {{ str_replace('_', ' ', $order->payment_method) }} akan
                        diberikan
                        sebentar lagi atau Anda bisa menghubungi staf kami.
                    </p>
                @endif
            </div>

            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                <a href="{{ url('/products') }}"
                    class="bg-coffee-brown text-cream px-6 py-3 rounded-md hover:bg-dark-brown transition-colors duration-300 text-center">
                    Lanjutkan Belanja
                </a>
            </div>
        </div>
    </div>
@endsection
