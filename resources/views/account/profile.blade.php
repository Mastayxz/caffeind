@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <section class=" dark:bg-gray-900 py-12">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-white dark:text-white mb-6">Profil Saya</h1>

            <form method="POST" action="{{ route('profile.update') }}"
                class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4 ">
                    @if ($user->image)
                        <div class="mb-6 flex items-center justify-center ">
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil"
                                class="w-20 h-20  object-cover mr-4 bg-gray-200 dark:bg-gray-700 rounded-full p-2">

                        </div>
                    @endif
                    <label for="image" class="block text-sm font-medium text-black dark:text-gray-200">Foto
                        Profil</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 block w-full text-sm text-black dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-50 dark:file:bg-gray-700 file:text-gray-700 dark:file:text-gray-200 hover:file:bg-gray-100 dark:hover:file:bg-gray-600">
                    <div>
                        <label for="name" class="block text-sm font-medium text-white dark:text-gray-200">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-900 dark:bg-gray-700 text-white dark:text-white shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-white dark:text-gray-200">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-900 dark:bg-gray-700 text-white dark:text-white shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-white dark:text-gray-200">Alamat</label>
                        <input type="text" name="address" id="address"
                            value="{{ old('address', $user->customers->address ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-900 dark:bg-gray-700 text-white dark:text-white shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="phone"
                            class="block text-sm font-medium text-white dark:text-gray-200">Telepon</label>
                        <input type="text" name="phone" id="phone"
                            value="{{ old('phone', $user->customers->phone ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-900 dark:bg-gray-700 text-white dark:text-white shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 my-4 bg-blue-700 hover:bg-primary-800 text-white text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Simpan Perubahan
                        </button>
                    </div>
            </form>
        </div>
    </section>

@endsection
