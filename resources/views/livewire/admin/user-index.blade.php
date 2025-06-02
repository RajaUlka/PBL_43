<div class="p-6 bg-white shadow-md rounded-lg">
    <!-- Tombol Tambah dan Filter -->
    <div class="flex justify-between items-center mb-6">
        <!-- Tombol Tambah User -->
        <button wire:click="openModal" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Tambah User
        </button>

        <!-- Filter Role -->
        <div class="flex items-center space-x-4">
            <label for="filterRole" class="font-semibold text-gray-700">Filter Role:</label>
            <select wire:model="filterRole" id="filterRole" class="border px-4 py-2 rounded-lg">
                <option value="">-- Semua --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="teknisi">Teknisi</option>
            </select>
        </div>
    </div>

    <!-- Tabel User -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left">#</th>
                    <th class="py-3 px-4 border-b text-left">Nama</th>
                    <th class="py-3 px-4 border-b text-left">Email</th>
                    <th class="py-3 px-4 border-b text-left">Role</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->role ?? '-' }}</td>
                        <td class="py-2 px-4 border-b text-center space-x-2">
                            <button wire:click="edit({{ $user->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition duration-200">
                                Edit
                            </button>
                            <button wire:click="delete({{ $user->id }})" onclick="return confirm('Yakin ingin hapus user ini?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition duration-200">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Form -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-96">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">{{ $editId ? 'Edit User' : 'Tambah User' }}</h3>

                <!-- Input Form -->
                <div class="mb-4">
                    <input wire:model="name" placeholder="Nama" class="border px-4 py-2 rounded-lg w-full">
                </div>
                <div class="mb-4">
                    <input wire:model="email" placeholder="Email" class="border px-4 py-2 rounded-lg w-full">
                </div>
                @if(!$editId)
                    <div class="mb-4">
                        <input wire:model="password" placeholder="Password" type="password" class="border px-4 py-2 rounded-lg w-full">
                    </div>
                @endif
                <div class="mb-4">
                    <select wire:model="role" class="border px-4 py-2 rounded-lg w-full">
                        <option value="">-- Role --</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="teknisi">Teknisi</option>
                    </select>
                </div>

                <!-- Submit & Cancel Buttons -->
                <div class="flex gap-2 mt-4">
                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full">
                            Update
                        </button>
                    @else
                        <button wire:click="store" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg w-full">
                            Tambah
                        </button>
                    @endif
                    <button wire:click="closeModal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg w-full">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
