<div class="relative min-h-screen bg-gray-50 py-10 px-4">
    <!-- Tombol Kembali -->
    <div class="absolute top-4 left-4">
        <a href="{{ url('/user/dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">🔍 Cek Status Laporan</h2>

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="cari" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Masukkan ID Tiket</label>
                <input type="text" wire:model="ticket" placeholder="Contoh: TKT-12345"
                    class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
                @error('ticket') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">🔍 Cari Tiket</button>
        </form>

        @if ($laporan)
            <div class="mt-8 p-6 rounded-lg border bg-green-50 border-green-200 shadow-sm">
                <h3 class="text-lg font-semibold text-green-700 mb-3">🎫 Detail Laporan</h3>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>Nama:</strong> {{ $laporan->name }}</li>
                    <li><strong>Nomor HP:</strong> {{ $laporan->no_hp }}</li>
                    <li><strong>Kendala:</strong> {{ $laporan->kendala }}</li>
                    <li><strong>Status:</strong>
                        @if ($laporan->status === 'baru')
                            <span class="text-yellow-600 font-semibold">🕒 Baru</span>
                        @elseif ($laporan->status === 'proses')
                            <span class="text-blue-600 font-semibold">🔄 Diproses</span>
                        @else
                            <span class="text-green-600 font-semibold">✅ Selesai</span>
                        @endif
                    </li>
                </ul>
            </div>
        @endif
    </div>
</div>
