<!-- <!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
    <h1>Products</h1>
    <ul>
        @foreach ($products as $product)
<li>
                <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                - ${{ $product->price }}
            </li>
@endforeach
    </ul>
</body>
</html> -->

@extends('layouts.app')
@section('title', 'Product List')
@section('content')
    <header class="bg-coffee-brown text-cream p-6 text-center">
        <h1 class="text-4xl font-bold">Coffee Shop Menu</h1>
    </header>
    <main class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-light-brown p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-lg mt-2">${{ number_format($product->price, 2) }}</p>
                    @if ($product->stock > 0)
                        <p class="text-sm mt-1">Stock: {{ $product->stock }}</p>

                        <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit"
                                class="inline-block bg-coffee-brown text-cream px-4 py-2 rounded hover:bg-dark-brown transition-colors duration-300">
                                Tambahkan Ke Keranjang
                            </button>
                        </form>
                    @else
                        <p class="text-sm mt-1 text-red-600 font-bold">Stok Habis</p>
                    @endif
                    <a href="{{ route('products.show', $product->id) }}"
                        class="mt-4 inline-block bg-coffee-brown text-cream px-4 py-2 rounded hover:bg-dark-brown transition-colors duration-300">View
                        Details</a>
                </div>
            @endforeach
        </div>
    </main>
@endsection
