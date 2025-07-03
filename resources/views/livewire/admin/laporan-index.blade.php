

<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Daftar Laporan</h2>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="py-2 px-4 border-b">#</th>
            <th class="py-2 px-4 border-b">Nama</th>
            <th class="py-2 px-4 border-b">No HP</th>
            <th class="py-2 px-4 border-b">Kendala</th>
            <th class="py-2 px-4 border-b">Lokasi</th>
            <th class="py-2 px-4 border-b">Lat</th>
            <th class="py-2 px-4 border-b">Lng</th>
            <th class="py-2 px-4 border-b">Status</th>
            <th class="py-2 px-4 border-b">ID Tiket</th>
            <th class="py-2 px-4 border-b">Aksi</th>
        </tr>
        </thead>

        <tbody>
            @foreach ($laporans as $index => $laporan)
            <tr wire:key="laporan-{{ $laporan->id }}">
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $laporan->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $laporan->no_hp }}</td>
                    <td class="py-2 px-4 border-b">{{ $laporan->kendala }}</td>
                    <td class="py-2 px-4 border-b">{{ $laporan->lokasi }}</td>
                    <td class="py-2 px-4 border-b">{{ $laporan->latitude }}</td>
                    <td class="py-2 px-4 border-b">{{ $laporan->longitude }}</td>
                    <td class="py-2 px-4 border-b">{{ ucfirst($laporan->status) }}</td>
                    <td class="py-2 px-4 border-b">{{ $laporan->id_ticket }}</td>
                    <td class="py-2 px-4 border-b">
                        @if ($editId === $laporan->id)
                            <select wire:model="status" class="border rounded px-2 py-1 text-sm">
                                <option value="baru">Baru</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            <div style="display:none;">Current status: {{ $status }}</div>
                            <button wire:click="saveStatus" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Simpan</button>
                            <button wire:click="$set('editId', null)" class="bg-gray-500 text-white px-2 py-1 rounded text-sm">Batal</button>
                        @else
                            <button wire:click="startEdit({{ $laporan->id }})" class="bg-blue-500 text-white px-2 py-1 rounded text-sm">Edit</button>
                            {{-- <button wire:click="delete({{ $laporan->id }})" onclick="return confirm('Yakin ingin hapus laporan ini?')" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Hapus</button> --}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
