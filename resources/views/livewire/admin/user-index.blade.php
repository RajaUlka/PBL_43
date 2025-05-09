<div>
    <!-- Tombol Tambah -->
    <button wire:click="openModal" class="bg-green-500 text-white px-3 py-1 rounded mb-4">Tambah User</button>
    <div class="mb-4">
    <label for="filterRole" class="mr-2 font-semibold">Filter Role:</label>
    <select wire:model="filterRole" id="filterRole" class="border px-2 py-1 rounded">
        <option value="">-- Semua --</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
        <option value="teknisi">Teknisi</option>
    </select>


    <!-- Tabel User -->
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b">#</th>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Role</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->role ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">
                        <button wire:click="edit({{ $user->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $user->id }})" onclick="return confirm('Yakin ingin hapus user ini?')" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Form -->
    @if($showModal)
    <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h3 class="text-lg font-semibold mb-4">{{ $editId ? 'Edit User' : 'Tambah User' }}</h3>

            <div class="mb-4">
                <input wire:model="name" placeholder="Nama" class="border px-2 py-1 rounded w-full">
            </div>
            <div class="mb-4">
                <input wire:model="email" placeholder="Email" class="border px-2 py-1 rounded w-full">
            </div>
            @if(!$editId)
                <div class="mb-4">
                    <input wire:model="password" placeholder="Password" type="password" class="border px-2 py-1 rounded w-full">
                </div>
            @endif
            <div class="mb-4">
            <select wire:model="role" class="border px-2 py-1 rounded w-full">
                <option value="">-- Role --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="teknisi">Teknisi</option>
            </select>

            </div>

            @if($editId)
                <button wire:click="update" class="bg-blue-500 text-white px-3 py-1 rounded w-full">Update</button>
            @else
                <button wire:click="store" class="bg-green-500 text-white px-3 py-1 rounded w-full">Tambah</button>
            @endif

            <button wire:click="closeModal" class="bg-gray-500 text-white px-3 py-1 rounded w-full mt-2">Cancel</button>
        </div>
    </div>
    @endif
</div>
