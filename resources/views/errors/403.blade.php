@extends('layouts.admin')

@section('title', 'Akses Ditolak')

@section('content')
<div class="flex items-center justify-center h-screen">
    <div class="bg-white p-10 rounded shadow text-center">
        <h1 class="text-6xl font-bold text-red-600">403</h1>
        <p class="text-xl mt-4 font-semibold">Akses Ditolak</p>
        <p class="text-gray-600 mt-2">
            Hanya admin yang memiliki izin untuk mengakses halaman ini.
        </p>
        <a href="{{ route('dashboard') }}"
           class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
