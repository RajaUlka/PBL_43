<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

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
                <p>{{ $jumlahSelesai }}</p>
            </div>
            <div class="col-md-6">
                <h3>Laporan Belum Selesai</h3>
                <p>{{ $jumlahBelum }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
