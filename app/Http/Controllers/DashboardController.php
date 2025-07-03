<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Laporan;
use App\Models\User;
use Carbon\Carbon;
use App\Models\DataAlat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman Admin (Dashboard yang tampilkan data)
    public function adminDashboard()
    {
        $data = DataAlat::where('created_at', '>=', Carbon::now()->subHours(6))
            ->orderBy('created_at')
            ->get();
    
        $labels = [];
        $phData = [];
        $kekeruhanData = [];
        $layakFlags = [];
    
        foreach ($data as $item) {
            $labels[] = $item->created_at->format('H:i');
            $phData[] = $item->ph;
            $kekeruhanData[] = $item->kekeruhan;
            $layakFlags[] = ($item->ph >= 6.5 && $item->ph <= 8.5 && $item->kekeruhan <= 5) ? 1 : 0;
        }
    
        $jumlahUser = User::where('role', '!=', 'admin')->count();
        $jumlahLaporan = Laporan::count();
        $laporanSelesai = Laporan::where('status', 'selesai')->count();
        $laporanBelum = Laporan::where('status', '!=', 'selesai')->count();
    
        $lokasiLaporan = Laporan::select('id', 'latitude', 'longitude', 'kendala', 'status')
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->where('status', '!=', 'selesai')
        ->get();
    
    
        return view('admin_dashboard', compact(
            'labels', 'phData', 'kekeruhanData', 'layakFlags',
            'jumlahUser', 'jumlahLaporan', 'laporanSelesai', 'laporanBelum', 'lokasiLaporan'
        ));
    }
}
