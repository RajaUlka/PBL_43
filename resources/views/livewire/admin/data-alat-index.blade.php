<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Data Alat</h2>

    <!-- Tombol Tambah -->
    <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
        Tambah Data Alat
    </button>

    <!-- Tabel Data -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-2 px-4 border-b">#</th>
                    <th class="py-2 px-4 border-b">Nama Alat</th>
                    <th class="py-2 px-4 border-b">pH</th>
                    <th class="py-2 px-4 border-b">Kekeruhan</th>
                    <th class="py-2 px-4 border-b">TDS</th>
                    <th class="py-2 px-4 border-b">Status Air</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataAlat as $index => $data)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $data->alat->nama_alat ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $data->ph }}</td>
                        <td class="py-2 px-4 border-b">{{ $data->kekeruhan }}</td>
                        <td class="py-2 px-4 border-b">{{ $data->tds }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="{{ $data->status_air == 'layak' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ ucfirst($data->status_air) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b space-x-1">
                            <button wire:click="edit({{ $data->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">
                                Edit
                            </button>
                            <button wire:click="delete({{ $data->id }})" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah / Edit -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $editId ? 'Edit' : 'Tambah' }} Data Alat
                </h2>

                <div class="mb-4 space-y-4">
                    <div>
                        <label class="block text-sm mb-1">Pilih Alat</label>
                        <select wire:model="alat_id" class="w-full border rounded px-2 py-1">
                            <option value="">Pilih Alat</option>
                            @foreach ($alats as $alat)
                                <option value="{{ $alat->id }}">{{ $alat->nama_alat }}</option>
                            @endforeach
                        </select>
                        @error('alat_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">pH</label>
                        <input wire:model="ph" type="number" step="0.01" placeholder="pH" class="w-full border rounded px-2 py-1">
                        @error('ph') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Kekeruhan</label>
                        <input wire:model="kekeruhan" type="number" step="0.01" placeholder="Kekeruhan" class="w-full border rounded px-2 py-1">
                        @error('kekeruhan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">TDS</label>
                        <input wire:model="tds" type="number" step="0.01" placeholder="TDS" class="w-full border rounded px-2 py-1">
                        @error('tds') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Update
                        </button>
                    @else
                        <button wire:click="store" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Tambah
                        </button>
                    @endif
                    <button wire:click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
