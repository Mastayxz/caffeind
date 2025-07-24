@extends('layouts.admin')

@section('content')
    <div class="mb-4 flex justify-between">
        <h1 class=" text-4xl">Product Details</h1>
        <div class="flex ">
            <a class= "text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none "
                href="{{ route('product.create') }}">+ Add New Product</a>

            <form method="GET" action="{{ route('product.index') }}" class="">
                <div class="input-group">
                    <input type="text" name="search"
                        class="font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 border border-[#504d30]"
                        placeholder="Cari produk..." value="{{ request('search') }}">
                    <button
                        class="text-white bg-[#706D54] hover:bg-[#504d30] font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:ring-4 focus:ring-[#b3ac73] focus:outline-none"
                        type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="relative overflow-x-auto rounded-t-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-white ">
            <thead class="text-xs textwhite uppercase bg-[#706D54] ">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Image</th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody scope="row" class="text-gray-900 whitespace-nowrap">
                @foreach ($products as $product)
                    <tr class="bg-white border-b  border-gray-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ $product->price }}</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                        <td class="px-6 py-4">{{ $product->description }}</td>
                        <td class="px-6 py-4"><img src="" alt=""></td>
                        <td class="px-6 py-4 flex items-center justify-center space-x-2">
                            <!-- Edit Button -->
                            <a href="{{ route('product.edit', $product->id) }}"
                                class="p-2 text-yellow-500 hover:text-yellow-700 rounded-full hover:bg-yellow-100 transition-colors duration-200"
                                title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2 text-red-500 hover:text-red-700 rounded-full hover:bg-red-100 transition-colors duration-200"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
