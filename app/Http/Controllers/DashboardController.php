<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman Admin (Dashboard yang tampilkan data)
    public function adminDashboard()
    {
        $alat = Alat::with('dataAlat')->get();

        $labels = $alat->pluck('alat_id')->toArray();
        $phData = $alat->map(fn($a) => optional($a->dataAlat->last())->ph ?? 0)->toArray();
        $kekeruhanData = $alat->map(fn($a) => optional($a->dataAlat->last())->kekeruhan ?? 0)->toArray();

        $jumlahUser = User::where('role', '!=', 'admin')->count();
        $jumlahLaporan = Laporan::count();
        $laporanSelesai = Laporan::where('status', 'selesai')->count();
        $laporanBelum = Laporan::where('status', '!=', 'selesai')->count();

        return view('admin_dashboard', compact(
            'labels', 'phData', 'kekeruhanData',
            'jumlahUser', 'jumlahLaporan', 'laporanSelesai', 'laporanBelum'
        ));
    }
}
