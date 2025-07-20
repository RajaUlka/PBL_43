<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistem Kualitas Air') }}</title>

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<!-- bg (semisal gak pake bg foto pake ini) -->
 <body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col">

<!-- bg (ini kalo pake bg) -->
 <!--<body class="bg-center bg-cover font-sans antialiased min-h-screen flex flex-col" style="background-image: url('{{ asset('image/bg-login.jpg') }}')"> -->


    <!-- Navbar (mengikuti struktur layout main) -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('image/logo-admin.png') }}" alt="Logo Sistem Monitoring Air" class="h-10 mr-2">
                <span class="text-xl font-bold text-blue-600">Sistem Monitoring Air</span>
            </a>

            <!-- Menu Navigasi -->
            <nav class="flex space-x-6 items-center">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                    Beranda
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login</a>
                    <a href="{{ route('register') }}" class="ml-2 bg-blue-600 text-white px-4 py-1.5 rounded hover:bg-blue-700 font-medium">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Konten Halaman -->
    <main class="flex-grow flex flex-col items-center justify-center">
        {{ $slot }}
    </main>

    <!-- Footer opsional jika ingin ditambahkan -->
    <footer class="bg-white border-t text-center text-sm text-gray-500 py-4">
        &copy; {{ date('Y') }} Sistem Monitoring Air. Hak cipta dilindungi.
    </footer>

    @livewireScripts
</body>
</html>
