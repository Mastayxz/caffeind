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
                    <img src="{{ asset('images/BrandLogo.png') }}" alt="" class="w-10 h-auto">
                    <span>Caffeind</span>
                </a>
            </h1>

            <nav>
                @auth
                    <a href="{{ route('account.profile') }}" class="mr-4">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-4">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
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

    {{-- <footer class="text-center mt-10 text-sm text-gray-500 py-4">
        &copy; {{ date('Y') }} MyApp. All rights reserved.
    </footer> --}}

</body>

</html>
