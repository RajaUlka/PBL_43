<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Daftar Alat</h2>

    <!-- Tombol Tambah Alat -->
    <button wire:click="$set('showModal', true)" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 transition duration-200">
        Tambah Alat
    </button>

    <!-- Tabel Daftar Alat -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700 border border-gray-200 rounded-md overflow-hidden">
            <thead class="bg-gray-100 text-xs font-semibold uppercase tracking-wider text-gray-600">
                <tr>
                    <th class="px-4 py-3 border-b">No</th>
                    <th class="px-4 py-3 border-b">Nama Alat</th>
                    <th class="px-4 py-3 border-b">Latitude</th>
                    <th class="px-4 py-3 border-b">Longitude</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($alats as $index => $alat)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 font-medium">{{ $alat->nama_alat }}</td>
                        <td class="px-4 py-2">{{ $alat->lat }}</td>
                        <td class="px-4 py-2">{{ $alat->lng }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <!-- Tombol Edit dan Hapus -->
                            <button wire:click="edit({{ $alat->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded transition duration-200">
                                Edit
                            </button>
                            <button wire:click="delete({{ $alat->id }})" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition duration-200">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Pop-up untuk Edit dan Tambah -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">{{ $editId ? 'Edit' : 'Tambah' }} Alat</h2>

                <!-- Form Input Alat -->
                <div class="mb-4">
                    <input wire:model="nama_alat" placeholder="Nama Alat" class="border px-2 py-1 rounded w-full">
                    @error('nama_alat') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input wire:model="lat" placeholder="Latitude" type="number" class="border px-2 py-1 rounded w-full">
                    @error('lat') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input wire:model="lng" placeholder="Longitude" type="number" class="border px-2 py-1 rounded w-full">
                    @error('lng') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Tombol Submit dan Cancel -->
                <div class="flex justify-end gap-2">
                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200">
                            Update
                        </button>
                    @else
                        <button wire:click="store" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition duration-200">
                            Tambah
                        </button>
                    @endif
                    <button wire:click="resetForm" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-200">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
