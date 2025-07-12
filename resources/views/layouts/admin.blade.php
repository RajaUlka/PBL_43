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
<body class="bg-gray-100" x-data="{ sidebarOpen: false, navOpen: false }">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-white p-5 transform transition-transform duration-200 ease-in-out z-40 sm:relative sm:translate-x-0 sm:flex sm:flex-col">
            <div class="flex items-center justify-between mb-6 sm:mb-0">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <button @click="sidebarOpen = false" class="sm:hidden text-gray-400 hover:text-white">
                    ✕
                </button>
            </div>
            <nav class="space-y-2 mt-4">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.index') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">User</a>
                <a href="{{ route('data-alat.index') }}" class="{{ request()->routeIs('data-alat.index') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">Data Alat</a>
                <a href="{{ route('daftar-alat.index') }}" class="{{ request()->routeIs('daftar-alat.index') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">Daftar Alat</a>
                <a href="{{ route('laporan-user.index') }}" class="{{ request()->routeIs('laporan-user.index') ? 'bg-gray-700' : '' }} block px-4 py-2 rounded hover:bg-gray-700">Laporan User</a>
            </nav>
        </div>

        <!-- Overlay (mobile) -->
        <div x-show="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-40 z-30 sm:hidden" @click="sidebarOpen = false"></div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <!-- Top Navbar (gabungan dari kode lama, dengan dropdown & mobile hamburger) -->
            <header class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Hamburger (mobile) -->
                            <button @click="sidebarOpen = true" class="sm:hidden mr-4 text-gray-600 hover:text-gray-800">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>

                            <!-- Logo -->
                            <a href="{{ route('dashboard') }}" class="flex items-center">
                                <x-application-mark class="block h-9 w-auto" />
                            </a>

                            <!-- Desktop Nav Links -->
                            <div class="hidden sm:flex space-x-8 ml-10">
                                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                                <x-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.index')">{{ __('User') }}</x-nav-link>
                                <x-nav-link href="{{ route('data-alat.index') }}" :active="request()->routeIs('data-alat.index')">{{ __('Data Alat') }}</x-nav-link>
                                <x-nav-link href="{{ route('daftar-alat.index') }}" :active="request()->routeIs('daftar-alat.index')">{{ __('Daftar Alat') }}</x-nav-link>
                                <x-nav-link href="{{ route('laporan-user.index') }}" :active="request()->routeIs('laporan-user.index')">{{ __('Laporan') }}</x-nav-link>
                            </div>
                        </div>

                        <!-- User Profile -->
                        <div class="hidden sm:flex sm:items-center">
                            <div class="ml-3 relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="w-8 h-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link href="{{ route('profile.show') }}">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
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

                        <!-- Hamburger profile (mobile) -->
                        <div class="sm:hidden flex items-center">
                            <button @click="navOpen = !navOpen" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': navOpen, 'inline-flex': !navOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                    <path :class="{ 'hidden': !navOpen, 'inline-flex': navOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Menu (mobile) -->
                <div :class="{ 'block': navOpen, 'hidden': !navOpen }" class="hidden sm:hidden px-4 pb-4">
                    <div class="space-y-1">
                        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.index')">{{ __('User') }}</x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('data-alat.index') }}" :active="request()->routeIs('data-alat.index')">{{ __('Data Alat') }}</x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('daftar-alat.index') }}" :active="request()->routeIs('daftar-alat.index')">{{ __('Daftar Alat') }}</x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('laporan-user.index') }}" :active="request()->routeIs('laporan-user.index')">{{ __('Laporan') }}</x-responsive-nav-link>
                    </div>

                    <!-- Profile Info (mobile) -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center">
                            <div class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            </div>
                            <div>
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">{{ __('Profile') }}</x-responsive-nav-link>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-0">
                @yield('content')
            </main>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>