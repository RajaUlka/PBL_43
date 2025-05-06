<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Alat;
use App\Models\Laporan;
use App\Http\Controllers\DashboardController;


Route::middleware(['auth', 'admin'])->get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');


Route::get('/', [DashboardController::class, 'publicDashboard'])->name('public.dashboard');
Route::middleware(['auth', 'admin'])->get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');






Route::get('/user', function () {
    // Mengambil user dengan ID 1
    $user = User::find(1);
    
    return view('user.index', ['user' => $user]);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
