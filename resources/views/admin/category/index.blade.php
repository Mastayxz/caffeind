@extends('layouts.admin')

{{-- @section('title', 'categorys Details') --}}
@section('content')
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-900">Category Details</h1>
        <div class="flex items-center space-x-4">
            <!-- Add Category Modal Toggle -->
            <button data-modal-target="add-category-modal" data-modal-toggle="add-category-modal"
                class="text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none transition-colors">
                + Add New Category
            </button>

            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.category.index') }}" class="flex items-center">
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
                        placeholder="Search Categorys...">
                </div>
                <button type="submit"
                    class="ml-2 text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none transition-colors">
                    Search
                </button>
            </form>
        </div>
    </div>

    <!-- Categorys Table -->
    <div class="relative overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left text-gray-900">
            <thead class="text-xs text-white uppercase bg-[#706D54]">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $category->name }}</td>
                        <td class="px-6 py-4 flex justify-center space-x-2">
                            <!-- Edit Button -->
                            <button data-modal-target="edit-category-modal-{{ $category->id }}"
                                data-modal-toggle="edit-category-modal-{{ $category->id }}"
                                class="font-medium text-[#706D54] hover:text-[#504d30] hover:bg-[#f0eee4] p-2 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>

                            <!-- Delete Button -->
                            <button data-modal-target="delete-category-modal-{{ $category->id }}"
                                data-modal-toggle="delete-category-modal-{{ $category->id }}"
                                class="font-medium text-red-600 hover:text-red-800 hover:bg-red-50 p-2 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Category Modal -->
                    <div id="edit-category-modal-{{ $category->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <!-- Outer container with padding -->
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content with border and rounded corners -->
                            <div class="relative bg-white rounded-lg shadow border border-gray-200">
                                <!-- Modal header with border bottom -->
                                <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        Edit Category
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-toggle="edit-category-modal-{{ $category->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>

                                <!-- Modal body with proper padding -->
                                <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="p-6 space-y-6">
                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900">category
                                                    Name</label>
                                                <input type="text" name="name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5"
                                                    value="{{ old('name', $category->name) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal footer with border top -->
                                    <div class="flex items-center p-6 space-x-3 border-t border-gray-200 rounded-b">
                                        <button type="submit"
                                            class="text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:outline-none focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            Update Category
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div id="delete-category-modal-{{ $category->id }}" tabindex="-1"
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
                                        Category?</h3>
                                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                        class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 transition-colors">
                                            Yes, I'm sure
                                        </button>
                                        <button type="button"
                                            data-modal-toggle="delete-category-modal-{{ $category->id }}"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 transition-colors">
                                            No, cancel
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-10 text-gray-500">
                            <div class="flex flex-col items-center py-20 text-xl ">
                                <!-- Icon kosong -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-20 opacity-50">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                                </svg>

                                <span>Tidak ada data ditemukan</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="p-4">
            {{ $categories->links() }}
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="add-category-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow border border-gray-200">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add New Category
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="add-category-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form class="p-6 space-y-6" method="POST" action="{{ route('admin.category.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">category
                                Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#706D54] focus:border-[#706D54] block w-full p-2.5"
                                placeholder="category name" required>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="text-white bg-[#706D54] hover:bg-[#504d30] focus:ring-4 focus:outline-none focus:ring-[#b3ac73] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
@endsection
