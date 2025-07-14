@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Dashboard Admin</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Chart -->
        <div class="md:col-span-2 bg-white p-4 rounded shadow">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold">Sensor Data (24 Jam Terakhir)</h3>
            </div>
            <canvas id="sensorChart"></canvas>
        </div>

        <!-- Map -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-2">Maps</h3>
            <div id="map" class="w-full h-96 bg-gray-200 rounded"></div>
        </div>
    </div>

    <!-- Statistik Kotak -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="flex flex-row space-x-4 justify-center mt-8">
            <div class="bg-white rounded-full w-40 h-40 flex items-center justify-center shadow-md">
                <div class="text-center">
                    <p class="text-xl font-bold">{{ $jumlahUser }}</p>
                    <p class="text-sm">User Teknisi</p>
                </div>
            </div>
            <div class="bg-white rounded-full w-40 h-40 flex items-center justify-center shadow-md">
                <div class="text-center">
                    <p class="text-xl font-bold">{{ $jumlahLaporan }}</p>
                    <p class="text-sm">Data Terlapor</p>
                </div>
            </div>
            <div class="bg-white rounded-full w-40 h-40 flex items-center justify-center shadow-md">
                <div class="text-center">
                    <p class="text-xl font-bold">{{ $laporanSelesai }}</p>
                    <p class="text-sm">Laporan Selesai</p>
                </div>
            </div>
            <div class="bg-white rounded-full w-40 h-40 flex items-center justify-center shadow-md">
                <div class="text-center">
                    <p class="text-xl font-bold">{{ $laporanBelum }}</p>
                    <p class="text-sm">Belum Selesai</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('sensorChart').getContext('2d');

let chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: formatDatasets(@json($datasets))
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Grafik pH & Kekeruhan per Alat (24 Jam Terakhir)'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const flag = context.dataset.layak_flags?.[context.dataIndex];
                        const status = flag === 1 ? ' (Layak)' : (flag === 0 ? ' (Tidak Layak)' : '');
                        return `${context.dataset.label}: ${context.formattedValue}${status}`;
                    }
                }
            },
            legend: {
                display: true,
                position: 'bottom'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Nilai Sensor'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Waktu (Jam:Menit)'
                }
            }
        }
    }
});

function formatDatasets(raw) {
    return raw.map(dataset => ({
        ...dataset,
        pointBackgroundColor: (ctx) => {
            const index = ctx.dataIndex;
            const flag = dataset.layak_flags?.[index];
            if (flag === 1) return 'rgba(75, 192, 192, 1)';
            if (flag === 0) return 'rgba(255, 99, 132, 1)';
            return 'gray';
        },
        pointRadius: 4
    }));
}

// Auto refresh grafik setiap 10 detik
setInterval(() => {
    fetch('/dashboard/chart-data')
        .then(response => response.json())
        .then(data => {
            chart.data.labels = data.labels;
            chart.data.datasets = formatDatasets(data.datasets);
            chart.update();
        });
}, 10000); // 10 detik
</script>


@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([1.0456, 104.0305], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Ambil data dari Laravel (tabel laporan)
            var lokasiLaporan = @json($lokasiLaporan);

            lokasiLaporan.forEach(function(laporan) {
                if (laporan.latitude && laporan.longitude) {
                    let warna = 'blue'; // default: baru
                    if (laporan.status === 'proses') warna = 'orange';
                    else if (laporan.status === 'baru') warna = 'blue';

                    const icon = L.icon({
                        iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${warna}.png`,
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    });

                    L.marker([laporan.latitude, laporan.longitude], { icon: icon })
                        .addTo(map)
                        .bindPopup(`<b>${laporan.kendala}</b><br>ID: ${laporan.id}<br>Status: ${laporan.status}`);
                }
            });


        });
    </script>
@endpush

