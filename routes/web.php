<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Alat;
use App\Models\Laporan;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\DataAlatController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\IsAdmin;

use App\Livewire\LaporanForm;
use App\Livewire\CekLaporan;
use Laravel\Jetstream\Http\Controllers\ProfileController;

// 🔓 Halaman publik
Route::get('/', [PublicPageController::class, 'index'])->name('public.home');

// 🧑 Auth + Role: Admin
Route::middleware(['auth', IsAdmin::class])->get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

// 📊 Admin dashboard dengan middleware khusus
Route::middleware(['auth', AdminMiddleware::class])->get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

// ✅ Authenticated + Verified group (Jetstream)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Role-based dashboard redirection
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'teknisi') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // Halaman dashboard user
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Halaman profile Jetstream
    Route::get('/user/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    // Halaman laporan
    Route::get('/laporan/create', fn () => view('user.buatlaporan'))->name('laporan.create');
    Route::get('/laporan/cek', fn () => view('user.ceklaporan'))->name('laporan.cek');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::view('/profile', 'profile.show')->name('profile.show');
});

// 📦 Halaman admin static (user, alat, laporan)
Route::get('/user', fn () => view('admin.user'))->name('user.index');
Route::get('/data-alat', fn () => view('admin.data-alat'))->name('data-alat.index');
Route::get('/daftar-alat', fn () => view('admin.daftar-alat'))->name('daftar-alat.index');
Route::get('/laporan-user', fn () => view('admin.laporan-user'))->name('laporan-user.index');

Route::middleware(['auth', AdminMiddleware::class])
    ->get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])
    ->name('dashboard.chart.data');


