@extends('layouts.admin')

@section('content')
    <div class="flex justify-between">
        <h1 class="text-3xl font-semibold pb-10">List Pengguna</h1>

        <form method="GET" action="{{ route('admin.users') }}" class="mb-4 flex items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user..."
                class="px-4 py-2 border rounded-lg w-full" />
            <button type="submit" class="ml-2 px-4 py-2 bg-[#706D54] text-white rounded-lg hover:bg-[#A08963] transition">
                Cari
            </button>
        </form>
    </div>

    <div class="relative overflow-x-auto rounded-t-2xl">
        <table class="w-full text-sm text-left rtl:text-right text-white ">
            <thead class="text-xs textwhite uppercase bg-[#706D54]">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">No. Telp</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-900 whitespace-nowrap">
                @forelse ($user as $users)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $users->name }}</td>
                        <td class="px-6 py-4">{{ $users->email }}</td>
                        <td class="px-6 py-4">{{ $users->customers->address ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $users->customers->phone ?? '-' }}</td>
                        <td class="px-6 py-4 flex items-center gap-2">
                            <!-- Edit -->
                            <button onclick="openModal('modal-edit-{{ $users->id }}')"
                                class="p-2 text-yellow-500 hover:text-yellow-700 rounded-full hover:bg-yellow-100 transition-colors duration-200"
                                title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.862 4.487" />
                                </svg>
                            </button>

                            <!-- Delete -->
                            <form action="{{ route('admin.user.destroy', ['id' => $users->id]) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2 text-red-500 hover:text-red-700 rounded-full hover:bg-red-100 transition-colors duration-200"
                                    title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21a48.108 48.108 0 00-3.478-.397m-12 .562a48.11 48.11 0 013.478-.397M7.5 5.25v-.916C7.5 3.154 8.41 2.17 9.59 2.133a51.964 51.964 0 013.32 0C14.09 2.17 15 3.154 15 4.334v.916" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 5.25h10.5M4.772 5.79l1.068 13.883a2.25 2.25 0 002.244 2.077h8.832a2.25 2.25 0 002.244-2.077L19.228 5.79" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    @include('partials.modal-user-edit', ['user' => $users])

                    {{-- jika data kosong atau tidak ditemukan --}}
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-500">
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
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }
    </script>
@endsection
