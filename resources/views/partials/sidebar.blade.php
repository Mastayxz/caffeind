<div :class="open ? 'w-64 transition-all duration-300' : 'w-16 transition-all duration-300'"
    class="bg-[#706D54] h-full flex flex-col border-r border-gray-200">

    <div class="p-4 text-white">
        <div class="flex items-center justify-between">
            <div class="flex justify-center items-center">
                <img src="{{ asset('images/BrandLogo.png') }}" alt="Logo Brand" class="w-9" x-show="open">
                <span x-show="open" class="text-lg font-bold">Caffeind</span>
            </div>
            <button @click="open = !open">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <div class="mt-4 ms-1 h-px bg-gray-300 w-full"></div>
    </div>

    <nav class="flex-1">
        <ul class="space-y-2 px-2 text-white ">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'bg-[#A08963]' : 'bg-[#706D54]' }} flex items-center p-2 rounded  hover:bg-[#4B352A] ms-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>

                    <span x-show="open" class="ml-2 font-semibold">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users') }}"
                    class="{{ request()->routeIs('admin.users') ? 'bg-[#A08963]' : 'bg-[#706D54]' }} flex items-center p-2 rounded  hover:bg-[#4B352A] ms-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span x-show="open" class="ml-2 font-semibold">Daftar Pengguna</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.product.index') }}"
                    class="{{ request()->routeIs('admin.product.*') ? 'bg-[#A08963]' : 'bg-[#706D54]' }} flex items-center p-2 rounded hover:bg-[#4B352A] ms-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <span x-show="open" class="ml-2 font-semibold">Produk</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.category.index') }}"
                    class="{{ request()->routeIs('admin.category.*') ? 'bg-[#A08963]' : 'bg-[#706D54]' }} flex items-center p-2 rounded hover:bg-[#4B352A] ms-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    <span x-show="open" class="ml-2 font-semibold">Kategori</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
