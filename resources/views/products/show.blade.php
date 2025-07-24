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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop - {{ $product->name }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-cream text-dark-brown font-sans">
    <header class="bg-coffee-brown text-cream p-6 text-center">
        <h1 class="text-4xl font-bold">Coffee Shop</h1>
        <a href="{{ route('products.index') }}" class="mt-2 inline-block text-cream underline hover:text-light-brown">Back to Menu</a>
    </header>
    <main class="container mx-auto p-6">
        <div class="max-w-2xl mx-auto bg-light-brown p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold">{{ $product->name }}</h2>
            <p class="text-xl mt-4">Price: ${{ number_format($product->price, 2) }}</p>
            <p class="mt-2">Description: {{ $product->description ?? 'No description available' }}</p>
            @if ($product->stock)
                <p class="mt-2">Stock: {{ $product->stock }}</p>
            @endif
            @if ($product->category_id)
                <p class="mt-2">Category ID: {{ $product->category_id }}</p>
            @endif
            <p class="mt-2">Image: {{ $product->image ?? 'No image available' }}</p>
            <p class="mt-2">Created At: {{ $product->created_at ?? 'Not set' }}</p>
            <p class="mt-2">Updated At: {{ $product->updated_at ?? 'Not set' }}</p>
        </div>
    </main>
</body>
</html>