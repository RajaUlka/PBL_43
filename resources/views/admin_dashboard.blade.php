@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Dashboard Admin</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Chart -->
        <div class="md:col-span-2 bg-white p-4 rounded shadow">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold">Sensor Data (6 Jam Terakhir)</h3>
            </div>
            <canvas id="sensorChart"></canvas>
        </div>

        <!-- Map -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-2">Maps</h3>
            <div id="map" class="w-full h-40 bg-gray-200 rounded"></div>
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
    const labels = @json($labels);
    const phData = @json($phData);
    const kekeruhanData = @json($kekeruhanData);

    const ctx = document.getElementById('sensorChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'pH',
                    data: phData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                },
                {
                    label: 'Kekeruhan',
                    data: kekeruhanData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                }
            ]
        }
    });
</script>
@endsection
