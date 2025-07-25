<header class="bg-white shadow p-4 relative">
    <div class="flex justify-end items-center space-x-4 relative" x-data="{ show: false }">
        <button @click="show = !show" class="flex items-center space-x-2 focus:outline-none">
            <span class="font-medium">Admin</span>
            <img src="{{ asset('images/default_user.png') }}" class="w-10 h-10 rounded-full border-2 " alt="Avatar">
        </button>

        <!-- Dropdown -->
        <div x-show="show" @click.outside="show = false"
             class="absolute right-4 top-16 w-48 bg-red-100 shadow rounded border border-gray-200 z-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-black hover:bg-red-500 hover:text-white focus:outline-none">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
