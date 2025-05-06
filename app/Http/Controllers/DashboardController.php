<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Fungsi untuk menampilkan public dashboard
public function publicDashboard()
{
    $alat = Alat::with('dataAlat')->get();

    // Pastikan ada data yang dikembalikan
    if ($alat->isEmpty()) {
        dd('Data Alat Kosong');
    }

    $labels = $alat->pluck('alat_id')->toArray();
    $phData = $alat->map(fn($a) => optional($a->dataAlat->last())->ph ?? 0)->toArray();
    $kekeruhanData = $alat->map(fn($a) => optional($a->dataAlat->last())->kekeruhan ?? 0)->toArray();

    // Ambil data untuk kolom lain
    $locations = $alat->map(fn($a) => [
        'alat_id' => $a->alat_id,
        'lat' => $a->lat,
        'lng' => $a->lng,
        'status' => 'active', // Set status selalu active
    ])->toArray();

    return view('public_dashboard', compact('labels', 'phData', 'kekeruhanData', 'locations', 'alat'));
}

    
    // Fungsi untuk menampilkan admin dashboard
    public function adminDashboard()
    {
        // Statistik Admin
        $jumlahUserTeknisi = User::where('role', 'teknisi')->count();
        $jumlahLaporan = Laporan::count();
        $laporanSelesai = Laporan::where('status', 'selesai')->count();
        $laporanBelumSelesai = Laporan::where('status', '!=', 'selesai')->count();

        // Kembalikan tampilan untuk admin dashboard
        return view('admin_dashboard', compact(
            'jumlahUserTeknisi', 
            'jumlahLaporan', 
            'laporanSelesai', 
            'laporanBelumSelesai'
        ));
    }
}
