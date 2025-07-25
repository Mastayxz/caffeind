<!-- <!DOCTYPE html>
<html>
<head>
    <title>Product Detail</title>
</head>
<body>
    <h1>{{ $product->name }}</h1>
    <p>Price: ${{ $product->price }}</p>
    <p>Description: {{ $product->description }}</p>
    <p>Image: {{ $product->image }}</p>
    <p>Created At: {{ $product->created_at }}</p>
    <p>Updated At: {{ $product->updated_at }}</p>
    <a href="{{ route('products.index') }}">Back to List</a>
</body>
</html> -->
@extends('layouts.app')
@section('title', 'Product List')
@section('content')
    <header class="bg-coffee-brown text-cream p-6 text-center">
        <h1 class="text-4xl font-bold">Coffee Shop</h1>
        <a href="{{ route('products.index') }}"
            class="mt-2 inline-block text-cream hover:text-light-brown bg-light-brown text-coffee-brown px-4 py-2 rounded-lg shadow-md hover:bg-dark-brown hover:text-cream transition-colors duration-300 flex items-center">
            <span class="mr-2">←</span> Back to Menu
        </a>
    </header>
    <main class="container mx-auto p-6">
        <div class="max-w-full mx-auto bg-light-brown p-8 rounded-lg shadow-lg flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 w-full flex justify-center mb-6 md:mb-0">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-64 h-64 object-cover rounded-lg shadow">
                @else
                    <div class="w-full h-auto flex items-center justify-center bg-gray-200 rounded-lg text-gray-500">
                        <img src="{{ asset('images/caffeind-bg.jpg') }}" alt="">
                    </div>
                @endif
            </div>
            <div class="md:w-1/2 w-full md:pl-8">
                <h2 class="text-3xl font-bold mb-2">{{ $product->name }}</h2>
                <p class="text-xl font-semibold text-coffee-brown mb-4">Price: Rp.{{ number_format($product->price, 2) }}
                </p>
                <p class="mb-2">Stock: <span class="font-semibold">{{ $product->stock ?? 'N/A' }}</span></p>
                <p class="mb-4">Category: {{ $product->category->name ?? '-' }}</p>
                <p class="mb-6 text-gray-700">{{ $product->description ?? 'No description available' }}</p>
                @if ($product->stock > 0)
                    <form action="{{ route('cart.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                            class="bg-amber-900  text-white px-6 py-2 rounded hover:bg-light-brown font-bold transition cursor-pointer">
                            <i class="fa-solid fa-cart-plus"></i> Masukkan Ke Keranjang
                        </button>
                    </form>
                @else
                    <p class="text-sm mt-1 text-red-600 font-bold">Stok Habis</p>
                @endif

            </div>
        </div>
    </main>
@endsection
