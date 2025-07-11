<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\UserDashboardController;

// 🔓 Halaman publik
Route::get('/', [PublicPageController::class, 'index'])->name('public.home');

// ✅ Authenticated + Verified (Jetstream)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // 🔁 Role-based redirection ke dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if (in_array($user->role, ['admin', 'teknisi'])) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // 👨‍🔧 Admin + Teknisi dashboard
    Route::middleware(['role:admin,teknisi'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart.data');

        // Halaman admin yang boleh dilihat teknisi juga
        Route::view('/data-alat', 'admin.data-alat')->name('data-alat.index');
        Route::view('/daftar-alat', 'admin.daftar-alat')->name('daftar-alat.index');
        Route::view('/laporan-user', 'admin.laporan-user')->name('laporan-user.index');
    });

    // 🔐 Khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::view('/user', 'admin.user')->name('user.index');
    });

    // 👤 User biasa
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::view('/laporan/create', 'user.buatlaporan')->name('laporan.create');
        Route::view('/laporan/cek', 'user.ceklaporan')->name('laporan.cek');
    });

    // 🛠 Profile Jetstream
    Route::view('/profile', 'profile.show')->name('profile.show');
});
