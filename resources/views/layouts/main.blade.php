<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Umum')</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="//unpkg.com/alpinejs" defer></script>


    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
         
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col">

    <!-- Navbar Elegan -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('image/logo-admin.png') }}" alt="Logo Sistem Monitoring Air" class="h-10 mr-2">
                <span class="text-xl font-bold text-blue-600">Sistem Monitoring Air</span>
            </a>

            <!-- Menu Navigasi -->
            <nav class="flex space-x-6 items-center">
                <a href="{{ route('public.home') }}" class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('home') ? 'border-b-2 border-blue-600 pb-1' : '' }}">
                    Beranda
                </a>

                @auth
                    <!-- Foto Profil dan Dropdown -->
                    <div class="relative">
                        <button id="userDropdown" class="flex items-center text-sm focus:outline-none group">
                            <img class="w-8 h-8 rounded-full object-cover border border-gray-300" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            <span class="ml-2 text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                            <svg class="ml-1 h-4 w-4 text-gray-500 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200 z-10">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Masuk</a>
                    <a href="{{ route('register') }}" class="ml-2 bg-blue-600 text-white px-4 py-1.5 rounded hover:bg-blue-700 font-medium">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow py-6">
        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer (opsional) -->
    <footer class="bg-white border-t text-center text-sm text-gray-500 py-4">
        &copy; {{ date('Y') }} Sistem Monitoring Air. Hak cipta dilindungi.
    </footer>

    <!-- Script untuk dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('userDropdown');
            const menu = document.getElementById('userMenu');

            btn?.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>

    @stack('scripts')    
    @livewireScripts
    
</body>
</html>
