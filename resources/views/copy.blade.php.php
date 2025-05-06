@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>Jumlah User Teknisi</h3>
            <p>{{ $jumlahUserTeknisi }}</p>
        </div>
        <div class="col-md-6">
            <h3>Jumlah Laporan</h3>
            <p>{{ $jumlahLaporan }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Laporan Selesai</h3>
            <p>{{ $laporanSelesai }}</p>
        </div>
        <div class="col-md-6">
            <h3>Laporan Belum Selesai</h3>
            <p>{{ $laporanBelumSelesai }}</p>
        </div>
    </div>
    <h2 class="text-xl font-bold mt-6">Grafik Data Sensor</h2>

<canvas id="phChart" width="400" height="200"></canvas>
<canvas id="kekeruhanChart" width="400" height="200" class="mt-4"></canvas>


    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Grafik Perkembangan pH dan Kekeruhan</h3>
            <canvas id="grafikSensor" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Menyimpan data alat dalam atribut data-alat -->
    <div id="grafikSensor" data-alat='@json($alat)'></div>
</div>

<script>
    // Ambil data alat dari atribut data-alat pada elemen div
    const el = document.getElementById('grafikSensor');
    const alat = JSON.parse(el.dataset.alat);

    // Ambil data pH dan Kekeruhan dari data alat
    const labels = alat.map(a => a.alat_id);  // Alat ID sebagai label
    const phData = alat.map(a => a.dataAlat.map(d => d.ph).slice(-1)[0] || 0);  // Ambil nilai pH terakhir
    const turbidityData = alat.map(a => a.dataAlat.map(d => d.kekeruhan).slice(-1)[0] || 0);  // Ambil nilai kekeruhan terakhir

    // Membuat grafik menggunakan Chart.js
    const ctx = document.getElementById('grafikSensor').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'pH',
                    data: phData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                },
                {
                    label: 'Kekeruhan',
                    data: turbidityData,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    fill: false,
                },
            ]
        },
    });
</script>
@endsection
