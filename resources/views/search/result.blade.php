@extends('layout')

@section('title', 'Search Results')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Search Results for "{{ request()->query('query') }}"</h2>
        @if ($results->isEmpty())
            <p>No results found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($results as $item)
                    <div class="bg-light-brown p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-xl font-semibold">{{ $item->name }}</h3>
                        <p class="text-md mt-2">${{ number_format($item->price, 2) }}</p>
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="mt-2 w-full h-48 object-cover rounded">
                        @else
                            <p class="mt-2 text-center">No image available</p>
                        @endif
                        <p class="mt-2">{{ $item->description ?? 'No description available' }}</p>
                        @if (get_class($item) === 'App\Models\Product')
                            <a href="{{ route('products.show', $item->id) }}" class="mt-4 inline-block bg-coffee-brown text-cream px-4 py-2 rounded hover:bg-dark-brown transition-colors duration-300">View Product</a>
                        @else
                            <a href="{{ route('gear.show', $item->id) }}" class="mt-4 inline-block bg-coffee-brown text-cream px-4 py-2 rounded hover:bg-dark-brown transition-colors duration-300">View Gear</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection