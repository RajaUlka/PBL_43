<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Data Alat</h2>

    <!-- Tombol Tambah -->
    <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
        Tambah Data Alat
    </button>

    <!-- Tabel Data -->
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b">#</th>
                <th class="py-2 px-4 border-b">Alat ID</th>
                <th class="py-2 px-4 border-b">pH</th>
                <th class="py-2 px-4 border-b">Kekeruhan</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataAlat as $index => $data)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $data->alat_id }}</td>
                    <td class="py-2 px-4 border-b">{{ $data->ph }}</td>
                    <td class="py-2 px-4 border-b">{{ $data->kekeruhan }}</td>
                    <td class="py-2 px-4 border-b">
                        <button wire:click="edit({{ $data->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $data->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah / Edit -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">{{ $editId ? 'Edit' : 'Tambah' }} Data Alat</h2>

                <div class="mb-4">
                    <label class="block mb-1 text-sm">Pilih Alat</label>
                    <select wire:model="alat_id" class="border px-2 py-1 rounded w-full">
                        <option value="">-- Pilih Alat --</option>
                        @foreach($alats as $alat)
                            <option value="{{ $alat->alat_id }}">{{ $alat->alat_id }}</option>
                        @endforeach
                    </select>
                    @error('alat_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    <label class="block mt-3 mb-1 text-sm">pH</label>
                    <input wire:model="ph" placeholder="pH" type="number" step="0.01" class="border px-2 py-1 rounded w-full">
                    @error('ph') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    <label class="block mt-3 mb-1 text-sm">Kekeruhan</label>
                    <input wire:model="kekeruhan" placeholder="Kekeruhan" type="number" step="0.01" class="border px-2 py-1 rounded w-full">
                    @error('kekeruhan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2">
                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                    @else
                        <button wire:click="store" class="bg-green-500 text-white px-4 py-2 rounded">Tambah</button>
                    @endif
                    <button wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
    @endif
</div>
