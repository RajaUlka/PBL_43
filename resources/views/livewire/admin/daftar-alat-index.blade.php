<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Daftar Alat</h2>

    <button wire:click="$set('showModal', true)" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
    Tambah Alat
    </button>



    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b">#</th>
                <th class="py-2 px-4 border-b">Alat ID</th>
                <th class="py-2 px-4 border-b">Latitude</th>
                <th class="py-2 px-4 border-b">Longitude</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alats as $index => $alat)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $alat->alat_id }}</td>
                    <td class="py-2 px-4 border-b">{{ $alat->lat }}</td>
                    <td class="py-2 px-4 border-b">{{ $alat->lng }}</td>
                    <td class="py-2 px-4 border-b">
                        <button wire:click="edit({{ $alat->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $alat->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Pop-up untuk Edit dan Tambah -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">{{ $editId ? 'Edit' : 'Tambah' }} Alat</h2>
                
                <div class="mb-4">
                    <input wire:model="alat_id" placeholder="Alat ID" class="border px-2 py-1 rounded w-full">
                    @error('alat_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input wire:model="lat" placeholder="Latitude" type="number" class="border px-2 py-1 rounded w-full">
                    @error('lat') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input wire:model="lng" placeholder="Longitude" type="number" class="border px-2 py-1 rounded w-full">
                    @error('lng') <span class="text-red-500">{{ $message }}</span> @enderror
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
