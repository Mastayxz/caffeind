<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tambahkan Tailwind CSS atau Bootstrap jika perlu -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 ">
    <header class="bg-white shadow p-4 mb-6">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold flex items-center space-x-2">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/BrandLogo.png') }}" alt="Caffeind Logo" class="w-10 h-auto">
                <span>Caffeind</span>
            </a>
        </h1>
        <nav class="flex items-center w-full justify-between">
            <!-- Centered Navigation Links -->
            <div class="flex justify-center flex-1">
                <a href="{{ route('products.index') }}" class="mx-4 hover:text-gray-500">Products</a>
                <a href="{{ route('cart.index') }}" class="mx-4 hover:text-gray-500">Cart</a>
                <div class="flex items-center mx-4">
                    <form action="{{ route('search') }}" method="GET" class="flex items-center">
                        <input type="text" name="query" placeholder="Search coffee..." class="border border-gray-300 rounded-l-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-coffee-brown">
                        <button type="submit" class="bg-coffee-brown text-cream rounded-r-md px-3 py-1 hover:bg-dark-brown transition-colors duration-300">🔍</button>
                    </form>
                </div>
            </div>
            <!-- Search Bar -->
            <!-- Authentication Links -->
            <div class="flex items-center space-x-4">
                @auth
                        @if (Auth::user()->role === 'user')
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                            </form>
                            <a href="{{ route('account.profile') }}"
                                class="mr-4 hover:text-gray-500">{{ Auth::user()->name }}</a>
                        @elseif (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="mr-4 hover:text-gray-500">Admin Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                            </form>
                            @endif
                        @else
                        <a href="{{ route('login') }}" class="mr-4 hover:text-gray-500">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-gray-500">Register</a>
                    @endauth
            </div>
        </nav>
    </div>
</header>
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <section class="w-full h-[600px] bg-center bg-no-repeat bg-cover"
        style="background-image: url('{{ asset('images/Caffeind.png') }}')">

        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-80">
            <!-- Hero content if any -->
        </div>
    </section>




    <section>
        <main class="container mx-auto p-6">
            <h1 class="text-3xl font-bold mb-6 text-center">Welcome to Caffeind</h1>
            <p class="mb-4 text-center">Explore our products and services:</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                    <div class="bg-light-brown p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('images/caffeind-bg.jpg') }}" alt="">
                        <h2 class="text-2xl font-semibold">{{ $product->name }}</h2>
                        <p class="text-lg mt-2">${{ number_format($product->price, 2) }}</p>
                        @if ($product->stock)
                            <p class="text-sm mt-1">Stock: {{ $product->stock }}</p>
                        @endif
                        <div class="flex items-center space-x-2 mt-4">
                            <a href="{{ route('products.show', $product->id) }}"
                                class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition-colors duration-300 text-sm">
                                View Details
                            </a>
                            @if ($product->stock > 0)
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="inline-block bg-coffee-brown text-cream px-4 py-2 rounded hover:bg-dark-brown transition-colors duration-300 cursor-pointer text-sm">
                                        Masukkan Ke Keranjang
                                    </button>
                                </form>
                            @else
                                <p class="text-sm mt-1 text-red-600 font-bold">Stok Habis</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('products.index') }}"
                    class="inline-block bg-coffee-brown text-cream px-6 py-3 rounded hover:bg-dark-brown transition-colors duration-300">View
                    All Products</a>
        </main>
    </section>
    <footer class="bg-gray-300 shadow mt-10 py-6">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-2 mb-2 md:mb-0">
                <img src="{{ asset('images/BrandLogo.png') }}" alt="Caffeind Logo" class="w-8 h-auto">
                <span class="font-semibold text-gray-700">Caffeind</span>
            </div>
            <div class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Caffeind. All rights reserved.
            </div>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-blue-500 transition-colors"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-pink-500 transition-colors"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>
    <!-- Font Awesome CDN for icons -->
    <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
</body>

</html>
