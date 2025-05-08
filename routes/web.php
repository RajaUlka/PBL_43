<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Alat;
use App\Models\Laporan;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicPageController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\IsAdmin;




Route::get('/', [PublicPageController::class, 'index'])->name('public.home');

Route::middleware(['auth', IsAdmin::class])->get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

Route::middleware(['auth', AdminMiddleware::class])
    ->get('/admin', [DashboardController::class, 'adminDashboard'])
    ->name('admin.dashboard');




    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            $user = Auth::user();
    
            // Arahkan sesuai role
            if ($user->role === 'admin' || $user->role === 'teknisi') {
                return redirect()->route('admin.dashboard');
            }
    
            // Kalau role lain (misal: masyarakat), redirect ke dashboard user biasa
            return redirect()->route('user.dashboard');
        })->name('dashboard');
    });

    
    Route::get('/user', function () {
        return view('admin.user');  // View untuk halaman User
    })->name('user.index');
    
    Route::get('/data-alat', function () {
        return view('admin.data-alat');  // View untuk halaman Data Alat
    })->name('data-alat.index');
    
    Route::get('/daftar-alat', function () {
        return view('admin.daftar-alat');  // View untuk Daftar Alat
    })->name('daftar-alat.index');
    
    Route::get('/laporan-user', function () {
        return view('admin.laporan-user');  // View untuk Laporan User
    })->name('laporan-user.index');

    Route::get('/user', function () {
        $user = User::find(1);
        return view('user.index', ['user' => $user]);
    })->name('user.index');
    