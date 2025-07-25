<div id="modal-edit-{{ $user->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 relative">
        <h3 class="text-lg font-semibold mb-4">Edit User - {{ $user->name }}</h3>
        <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name-{{ $user->id }}" class="block mb-1 font-medium">Nama</label>
                <input type="text" id="name-{{ $user->id }}" name="name" value="{{ $user->name }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="email-{{ $user->id }}" class="block mb-1 font-medium">Email</label>
                <input type="email" id="email-{{ $user->id }}" name="email" value="{{ $user->email }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="address-{{ $user->id }}" class="block mb-1 font-medium">Alamat</label>
                <input type="text" id="address-{{ $user->id }}" name="address" value="{{ $user->customers->address ?? '' }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label for="phone-{{ $user->id }}" class="block mb-1 font-medium">No. Telp</label>
                <input type="text" id="phone-{{ $user->id }}" name="phone" value="{{ $user->customers->phone ?? '' }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('modal-edit-{{ $user->id }}')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Close</button>
                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Save</button>
            </div>
        </form>
    </div>
</div>
