<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Kualitas Air') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-white shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-800 hover:text-indigo-600">
                Sistem Kualitas Air
            </a>
            <div class="space-x-4">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-indigo-600 text-sm">Beranda</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-indigo-600 text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 text-sm">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-indigo-600 text-sm">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="min-h-screen flex flex-col items-center justify-center">
        {{ $slot }}
    </div>
    @livewireScripts

</body>
</html>
