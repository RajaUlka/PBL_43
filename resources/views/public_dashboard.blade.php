@extends('layouts.public')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Chart -->
        <div class="md:col-span-2 bg-white p-4 rounded shadow">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold">Sensor Data (6 Jam Terakhir)</h3>
                <button>⚙️</button>
            </div>
            <canvas id="sensorChart"></canvas>
        </div>

        <!-- Map -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-2">Maps</h3>
            <div id="map" class="w-full h-40 bg-gray-200 rounded"></div>
        </div>
    </div>

    <!-- Table Realtime Data -->
    <div class="bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold">Realtime Sensor Data</h3>
            <button>⚙️</button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Nama</th>
                        <th class="p-2">Lokasi</th>
                        <th class="p-2">PH</th>
                        <th class="p-2">Kekeruhan</th>
                        <th class="p-2">Kode Lokasi</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alat as $a)
                        <tr class="border-b">
                            <td class="p-2">{{ $a->alat_id }}</td>
                            <td class="p-2">{{ $a->lat }}, {{ $a->lng }}</td>
                            <td class="p-2">{{ optional($a->dataAlat->last())->ph ?? 'N/A' }}</td>
                            <td class="p-2">{{ optional($a->dataAlat->last())->kekeruhan ?? 'N/A' }}</td>
                            <td class="p-2">{{ $a->alat_id }}</td>
                            <td class="p-2">
                                <span class="text-green-600">{{ 'active' }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
