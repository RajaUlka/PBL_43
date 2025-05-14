<div class="max-w-lg mx-auto py-8 bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Form Laporan</h2>

    <form wire:submit.prevent="submit" class="space-y-6">
        <div class="flex flex-col space-y-2">
            <label class="text-sm font-semibold text-gray-600">Nama</label>
            <input wire:model="name" type="text" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition ease-in-out">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col space-y-2">
            <label class="text-sm font-semibold text-gray-600">No HP</label>
            <input wire:model="no_hp" type="text" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition ease-in-out">
            @error('no_hp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col space-y-2">
            <label class="text-sm font-semibold text-gray-600">Kendala</label>
            <select wire:model="kendala" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition ease-in-out">
                <option value="">-- Pilih --</option>
                @foreach ($kendalaList as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
            @error('kendala') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col space-y-2">
            <label class="text-sm font-semibold text-gray-600">Pin Lokasi (klik peta)</label>
            <div id="map" wire:ignore class="w-full h-64 rounded-md mb-2 shadow-sm"></div>
        </div>
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif


        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition ease-in-out">Kirim</button>
    </form>

    <div x-data x-init="$nextTick(() => window.dispatchEvent(new Event('init-map')))"></div>
</div>

@push('scripts')
<script>
    let map, marker;

    window.addEventListener('init-map', function () {
        console.log('Inisialisasi peta...');

        map = L.map('map').setView([1.0854, 104.0314], 13); // Batam
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    const lokasi = data.address.city || data.address.town || data.address.village || data.display_name;

                    let component = document.querySelector('[wire\\:id]');
                    if (component) {
                        let livewireInstance = Livewire.find(component.getAttribute('wire:id'));
                        livewireInstance.dispatch('mapClicked', [{ lat, lng, lokasi }]);
                    }
                }).catch(error => {
                    console.error('Gagal ambil lokasi:', error);
                });
        });
    });

    document.addEventListener('livewire:load', function () {
    Livewire.on('resetForm', () => {
        // Reset form inputs di UI
        document.querySelector('form').reset();

        // Reset map marker (jika diperlukan)
        if (marker) {
            map.removeLayer(marker);
            marker = null;
        }
    });
});


</script>
@endpush
