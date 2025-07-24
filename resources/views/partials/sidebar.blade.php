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
                <a href="#" class="flex items-center p-2 rounded  hover:bg-[#A08963]  ms-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>

                    <span x-show="open" class="ml-2 font-semibold">Dashboard</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
