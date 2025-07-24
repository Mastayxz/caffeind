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
            
                    <div class="flex items-center space-x-2 mt-4"> 
                        <a href="{{ route('products.show', $product->id) }}"
                            class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition-colors duration-300 text-sm">
                            View Details
                        </a>
                        <form action="{{ route('cart.store') }}" method="POST"> 
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit"
                                class="inline-block bg-coffee-brown text-cream px-4 py-2 rounded hover:bg-dark-brown transition-colors duration-300 cursor-pointer text-sm">
                                Masukkan Ke Keranjang
                            </button>
                        </form>
                    </div>
                @else
                    <p class="text-sm mt-1 text-red-600 font-bold">Stok Habis</p>
                @endif
            </div>
            @endforeach
        </div>
    </main>
@endsection
