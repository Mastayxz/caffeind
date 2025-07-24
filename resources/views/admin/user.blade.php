@extends('layouts.admin')

@section('content')
    <div class="relative overflow-x-auto rounded-t-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-white ">
            <thead class="text-xs textwhite uppercase bg-[#706D54] ">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">email</th>

                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody scope="row" class="text-gray-900 whitespace-nowrap">
                @foreach ($user as $users)
                    <tr class="bg-white border-b  border-gray-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $users->name }}</td>
                        <td class="px-6 py-4">{{ $users->email }}</td>
                        <td class="px-6 py-4">
                            <a href="">edit</a> | delete
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Links -->
        {{-- <div class="mt-4">
            {{ $products->links() }}
        </div> --}}
    </div>

    @foreach ($user as $users)
    @endforeach
@endsection
