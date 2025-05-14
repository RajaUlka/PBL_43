<!-- layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
     <!-- Leaflet CSS -->
<!-- Leaflet CSS & JS tanpa integrity -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="flex">
       <!-- Sidebar -->
<div class="flex flex-col w-64 min-h-screen bg-gray-900 text-white p-5">
    <h1 class="text-xl font-abold mb-6">Admin Panel</h1>
    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">
            Dashboard
        </a>
        <a href="{{ route('user.index') }}"
           class="{{ request()->routeIs('user.index') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">
            User
        </a>
        <a href="{{ route('data-alat.index') }}"
           class="{{ request()->routeIs('data-alat.index') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">
            Data Alat
        </a>
        <a href="{{ route('daftar-alat.index') }}"
           class="{{ request()->routeIs('daftar-alat.index') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">
            Daftar Alat
        </a>
        <a href="{{ route('laporan-user.index') }}"
           class="{{ request()->routeIs('laporan-user.index') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">
            Laporan User
        </a>
    </nav>
</div>

        <!-- Main Content Area -->
        <div class="flex-1 p-6">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <!-- Tambahkan menu lain sesuai kebutuhan -->
                    <x-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.index')">
                        {{ __('User') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('data-alat.index') }}" :active="request()->routeIs('data-alat.index')">
                        {{ __('Data Alat') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('daftar-alat.index') }}" :active="request()->routeIs('daftar-alat.index')">
                        {{ __('Daftar Alat') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('laporan-user.index') }}" :active="request()->routeIs('laporan-user.index')">
                        {{ __('Laporan User') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- User Dropdown Menu -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <!-- Foto Profil Pengguna -->
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Profil Pengguna -->
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Log Out -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 px-4 py-2 block">Dashboard</a>
            <a href="{{ route('user.index') }}" class="text-gray-500 hover:text-gray-700 px-4 py-2 block">User</a>
            <a href="{{ route('data-alat.index') }}" class="text-gray-500 hover:text-gray-700 px-4 py-2 block">Data Alat</a>
            <a href="{{ route('daftar-alat.index') }}" class="text-gray-500 hover:text-gray-700 px-4 py-2 block">Daftar Alat</a>
            <a href="{{ route('laporan-user.index') }}" class="text-gray-500 hover:text-gray-700 px-4 py-2 block">Laporan User</a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>


            <!-- Content for the page will go here -->
            @yield('content')
        </div>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
