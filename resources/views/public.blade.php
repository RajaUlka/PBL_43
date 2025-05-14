@extends('layouts.main')

@section('content')
<div class="bg-blue-50 py-20">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-5xl font-extrabold text-blue-700 mb-4">Sistem Monitoring Kualitas Air</h1>
        <p class="text-lg text-gray-600 mb-8">Pantau kualitas air secara real-time untuk memastikan keamanan dan kebersihan lingkungan Anda.</p>
        <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition">Daftar/Login untuk melapor</a>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-2">Pemantauan pH</h3>
        <p class="text-gray-600">Memastikan tingkat keasaman air sesuai standar untuk kebutuhan lingkungan dan industri.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-2">Pemantauan Kekeruhan</h3>
        <p class="text-gray-600">Deteksi kekeruhan secara akurat untuk menghindari kontaminasi dan pencemaran air.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-2">Pelaporan & Dashboard</h3>
        <p class="text-gray-600">Data visualisasi dan laporan berbasis lokasi untuk pengambilan keputusan cepat.</p>
    </div>
</div>

<div class="bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-2xl font-bold mb-4">Tentang Kami</h2>
        <p class="text-gray-700">Kami adalah tim pengembang sistem monitoring air berbasis IoT yang berkomitmen membantu pemantauan kualitas air dengan teknologi terkini.</p>
    </div>
</div>
@endsection
