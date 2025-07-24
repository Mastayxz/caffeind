@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <section class="bg-white py-12">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Profil Saya</h1>

            <form method="POST" action="{{ route('profile.update') }}"
                class="space-y-6 bg-white border border-gray-200 p-8 rounded-xl shadow-md" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($user->image)
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil"
                            class="w-24 h-24 object-cover rounded-full border border-gray-300 shadow">
                    </div>
                @endif

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                    <input type="file" name="image" id="image"
                        class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border file:border-gray-300 file:text-sm file:font-semibold file:bg-white file:text-gray-700 hover:file:bg-gray-50 transition duration-150 ease-in-out" />
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <input type="text" name="address" id="address"
                        value="{{ old('address', $user->customers->address ?? '') }}"
                        class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" id="phone"
                        value="{{ old('phone', $user->customers->phone ?? '') }}"
                        class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
