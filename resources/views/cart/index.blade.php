<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja Anda</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Keranjang Belanja Anda</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if ($cartItems->isEmpty())
                <p class="text-center text-gray-600">Keranjang belanja Anda kosong. Yuk, <a
                        href="{{ url('/products') }}" class="text-blue-600 hover:underline">mulai belanja</a>!</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Produk</th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Harga</th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Jumlah</th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Subtotal</th>
                                <th
                                    class="py-3 px-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach ($cartItems as $item)
                                <tr class="border-b border-gray-200">
                                    <td class="py-3 px-4 text-gray-800">{{ $item->product->name }}</td>
                                    <td class="py-3 px-4 text-gray-800">
                                        Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 text-gray-800">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                            class="flex items-center space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1"
                                                class="w-20 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded text-sm">Update</button>
                                        </form>
                                    </td>
                                    <td class="py-3 px-4 text-gray-800">
                                        Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4">
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded text-sm"
                                                onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $totalPrice += $item->product->price * $item->quantity;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50">
                                <td colspan="3" class="py-3 px-4 text-right text-base font-bold text-gray-900">Total
                                    Belanja:</td>
                                <td colspan="2" class="py-3 px-4 text-base font-bold text-gray-900">
                                    Rp{{ number_format($totalPrice, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="flex justify-end mt-6">
                    <a href="{{ route('checkout.index') }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-md shadow-lg">Lanjutkan
                        ke Pembayaran</a>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
