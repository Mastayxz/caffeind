@extends('layouts.admin')

{{-- @section('title', 'Products Details') --}}
@section('content')
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-900">Product Details</h1>
        <div class="flex items-center space-x-4">
            <!-- Add Product Modal Toggle -->
            <button data-modal-target="add-product-modal" data-modal-toggle="add-product-modal"
                class="text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none transition-colors">
                + Add New Product
            </button>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.product.index') }}" class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-[#706D54] focus:border-[#706D54]"
                        placeholder="Search products...">
                </div>
                <button type="submit"
                    class="ml-2 text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none transition-colors">
                    Search
                </button>
            </form>
        </div>
    </div>

    <!-- Products Table -->
    <div class="relative overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left text-gray-900">
            <thead class="text-xs text-white uppercase bg-[#706D54]">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Image</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ $product->price }}</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                        <td class="px-6 py-4">{{ Str::limit($product->description, 50) }}</td>
                        <td class="px-6 py-4">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="h-10 w-10 object-cover rounded-lg">
                            @else
                                <span class="text-gray-400">No image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex justify-center space-x-2">
                            <!-- Edit Button -->
                            <button data-modal-target="edit-product-modal-{{ $product->id }}"
                                data-modal-toggle="edit-product-modal-{{ $product->id }}"
                                class="font-medium text-[#706D54] hover:text-[#504d30] hover:bg-[#f0eee4] p-2 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>

                            <!-- Delete Button -->
                            <button data-modal-target="delete-product-modal-{{ $product->id }}"
                                data-modal-toggle="delete-product-modal-{{ $product->id }}"
                                class="font-medium text-red-600 hover:text-red-800 hover:bg-red-50 p-2 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Product Modal -->
                    <div id="edit-product-modal-{{ $product->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <!-- Outer container with padding -->
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content with border and rounded corners -->
                            <div class="relative bg-white rounded-lg shadow border border-gray-200">
                                <!-- Modal header with border bottom -->
                                <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        Edit Product
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-toggle="edit-product-modal-{{ $product->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>

                                <!-- Modal body with proper padding -->
                                <div class="p-6 space-y-6">
                                    <form action="{{ route('admin.product.update', $product->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900">Product
                                                    Name</label>
                                                <input type="text"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5"
                                                    name="name" value="{{ old('name', $product->name) }}">
                                            </div>
                                            <div>
                                                <label for="category_id"
                                                    class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                                <select id="category_id" name="category_id" required
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5">
                                                    <option value="" hidden>Select category</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                                                    <input type="number"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5"
                                                        name="price" value="{{ old('price', $product->price) }}">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                                                    <input type="number"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5"
                                                        name="stock" value="{{ old('stock', $product->stock) }}">
                                                </div>
                                            </div>

                                            <div>
                                                <label
                                                    class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                                <textarea name="description"
                                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#706D54] focus:border-[#706D54]"
                                                    rows="4">{{ old('description', $product->description) }}</textarea>
                                            </div>

                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900">Upload
                                                    Image</label>
                                                <div class="flex items-center justify-center w-full">
                                                    <label
                                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 20 16">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                            </svg>
                                                            <p class="mb-2 text-sm text-gray-500"><span
                                                                    class="font-semibold">Click to upload</span> or drag
                                                                and
                                                                drop</p>
                                                            <p class="text-xs text-gray-500">PNG, JPG, JPEG (MAX. 2MB)</p>
                                                        </div>
                                                        <input type="file" class="hidden" name="image" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <!-- Modal footer with border top -->
                                <div class="flex items-center p-6 space-x-3 border-t border-gray-200 rounded-b">
                                    <button type="submit"
                                        class="text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:outline-none focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        Update Product
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div id="delete-product-modal-{{ $product->id }}" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this
                                        product?</h3>
                                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                                        class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 transition-colors">
                                            Yes, I'm sure
                                        </button>
                                        <button type="button"
                                            data-modal-toggle="delete-product-modal-{{ $product->id }}"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 transition-colors">
                                            No, cancel
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="p-4">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="add-product-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow border border-gray-200">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add New Product
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="add-product-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form class="p-6 space-y-6" method="POST" action="{{ route('admin.product.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Product
                                Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5"
                                placeholder="Product name" required>
                        </div>
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                            <select id="category_id" name="category_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5">
                                <option value="" hidden>Select category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                                <input type="number" name="price" id="price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5"
                                    placeholder="Rp. 99.000" required>
                            </div>
                            <div>
                                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                                <input type="number" name="stock" id="stock"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5"
                                    placeholder="100" required>
                            </div>
                        </div>

                        <div>
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#706D54] focus:border-[#706D54]"
                                placeholder="Product description"></textarea>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Upload Image</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                                upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (MAX. 2MB)</p>
                                    </div>
                                    <input id="dropzone-file" name="image" type="file" class="hidden" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:outline-none focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
@endsection
