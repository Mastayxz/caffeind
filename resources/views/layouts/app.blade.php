<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

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
                <a href="{}" class="mx-4 hover:text-gray-500">Cart</a>
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
                    <a href="{{ route('account.profile') }}" class="mr-4 hover:text-gray-500">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-4 hover:text-gray-500">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-gray-500">Register</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

    <main class="container mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </main>

    <footer class="bg-white shadow mt-10 py-6">
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
