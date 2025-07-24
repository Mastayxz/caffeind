@extends('layouts.admin')

@section('content')
    <div class="mb-4 flex justify-between">
        <h1 class=" text-4xl">Product Details</h1>
        <div class=""></div>
        <a class= "text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none "
            href="{{ route('product.create') }}">+ Add New Product</a>
        <form method="GET" action="{{ route('product.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="relative overflow-x-auto rounded-t-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-white ">
            <thead class="text-xs textwhite uppercase bg-[#706D54] ">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Price</th>
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
                        <td class="px-6 py-4">{{ $product->description }}</td>
                        <td class="px-6 py-4"><img src="" alt=""></td>
                        <td class="px-6 py-4">
                            <a href="{{ route('product.edit', $product->id) }}">edit</a> | delete
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
