<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tambahkan Tailwind CSS atau Bootstrap jika perlu -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 overflow-hidden">
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-3">
        <div class="relative p-8 md:p-12 flex flex-col justify-center lg:col-span-2"
            style="background-image: url('{{ asset('images/caffeind-bg.jpg') }}'); background-size: cover; background-position: center;">
        </div>
        <div class="bg-gradient-to-br from-[#543310] to-[#AF8F6F] backdrop-blur-md flex items-center justify-center p-8">


            <div class="w-full max-w-sm">
                <img src="{{ asset('images/logo.jpg') }}" alt="Sawah Bank Icon"
                    class="h-16 w-auto mx-auto mb-6 rounded object-contain">
                <h2 class="text-3xl font-bold text-center text-white mb-8">Buat Akun </h2>
                <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="text-sm font-medium text-gray-300">Alamat Email</label>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 mt-1 bg-gray-800 bg-opacity-50 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label for="password" class="text-sm font-medium text-gray-300">Password</label>
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full px-4 py-3 mt-1 bg-gray-800 bg-opacity-50 border border-gray-700 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>


                    <div>
                        <button type="submit"
                            class="w-full px-4 py-3 mt-2 font-semibold text-white bg-[#543310] rounded-md hover:bg-[#FFB22C] hover:cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-black focus:ring-amber-500">
                            Login
                        </button>
                    </div>
                </form>
                <p class="mt-8 text-sm text-center text-white">
                    Belum punya akun? <a href="{{ route('register') }}"
                        class="font-medium text-amber-300 hover:text-[#543310]">Register</a>
                </p>
                <p class="mt-6 text-xs text-center text-white">&copy; Copyright Caffeind</p>
            </div>
        </div>
    </div>
</body>

</html>
