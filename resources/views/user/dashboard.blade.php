@extends('layouts.main')

@section('content')
<div class="relative min-h-screen bg-cover bg-center" style="background-image: url('/images/logo.png');">
    <div class="absolute inset-0 bg-white bg-opacity-80 backdrop-blur-sm"></div>

    <div class="relative max-w-6xl mx-auto py-16 px-6">
        <h1 class="text-4xl font-bold mb-10 text-center text-gray-800">Dashboard Pengguna</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <a href="{{ route('laporan.create') }}" class="p-8 bg-white bg-opacity-90 rounded-2xl shadow-xl hover:shadow-2xl transition hover:bg-blue-50">
                <h2 class="text-2xl font-semibold text-blue-700">📝 Buat Laporan Baru</h2>
                <p class="text-gray-700 mt-3">Laporkan kendala dan dapatkan tiket pelacakan.</p>
            </a>

            <a href="{{ route('laporan.cek') }}" class="p-8 bg-white bg-opacity-90 rounded-2xl shadow-xl hover:shadow-2xl transition hover:bg-green-50">
                <h2 class="text-2xl font-semibold text-green-700">🔍 Cek Status Laporan</h2>
                <p class="text-gray-700 mt-3">Masukkan ID Tiket atau lihat riwayat laporan Anda.</p>
            </a>
        </div>

        <!-- Bagian Tiket yang Sudah Dilaporkan -->
        <div class="mt-16">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Tiket Laporan Anda</h2>
            
            <!-- Cek apakah pengguna memiliki tiket yang sudah dilaporkan -->
            @if($tickets->isEmpty())
                <p class="text-center text-gray-500">Anda belum memiliki laporan yang dilaporkan.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tickets as $ticket)
                        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                            <h3 class="text-lg font-semibold text-blue-700">Tiket: {{ $ticket }}</h3>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
