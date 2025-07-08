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
        // Ambil data 6 jam terakhir
        $data = DataAlat::where('created_at', '>=', Carbon::now()->subHours(6))
            ->orderBy('created_at')
            ->get();
    
        // Ambil semua alat unik
        $alatIds = $data->pluck('alat_id')->unique();
    
        $labels = [];
        $datasets = [];
    
        foreach ($alatIds as $alatId) {
            $filtered = $data->where('alat_id', $alatId);
    
            $timestamps = $filtered->pluck('created_at')->map(function ($time) {
                return $time->format('H:i');
            })->toArray();
    
            // Simpan labels hanya sekali
            if (empty($labels)) {
                $labels = $timestamps;
            }
    
            $phValues = $filtered->pluck('ph')->toArray();
            $kekeruhanValues = $filtered->pluck('kekeruhan')->toArray();
    
            // Flag layak per titik (untuk penanda warna nanti)
            $layakFlags = $filtered->map(function ($item) {
                return ($item->ph >= 6.5 && $item->ph <= 8.5 && $item->kekeruhan < 100 && $item->tds < 500) ? 1 : 0;
            })->toArray();
    
            // Dataset pH
            $datasets[] = [
                'label' => "pH ($alatId)",
                'data' => $phValues,
                'borderColor' => $this->getColor($alatId),
                'backgroundColor' => 'transparent',
                'fill' => false,
                'tension' => 0.3,
                'layak_flags' => $layakFlags
            ];
    
            // Dataset Kekeruhan
            $datasets[] = [
                'label' => "Kekeruhan ($alatId)",
                'data' => $kekeruhanValues,
                'borderColor' => $this->getColor($alatId, true),
                'backgroundColor' => 'transparent',
                'fill' => false,
                'borderDash' => [5, 5], // Kekeruhan = garis putus
                'tension' => 0.3,
                'layak_flags' => $layakFlags
            ];
        }
    
        // Statistik
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
            'labels', 'datasets',
            'jumlahUser', 'jumlahLaporan', 'laporanSelesai', 'laporanBelum',
            'lokasiLaporan'
        ));
    }
    
    // Fungsi bantu untuk ambil warna unik berdasarkan alat_id
    private function getColor($id, $secondary = false)
    {
        $colors = [
            'A1' => ['#36A2EB', '#FF6384'],
            'A2' => ['#4BC0C0', '#FF9F40'],
            'A3' => ['#9966FF', '#FFCD56'],
            'A4' => ['#C9CBCF', '#7E57C2'],
            'A5' => ['#2ecc71', '#e67e22'],
        ];
    
        if (!isset($colors[$id])) {
            $hash = crc32($id);
            return sprintf('#%06X', $hash & 0xFFFFFF);
        }
    
        return $colors[$id][$secondary ? 1 : 0];
    }

    public function getChartData()
{
    $data = DataAlat::where('created_at', '>=', Carbon::now()->subHours(6))
        ->orderBy('created_at')
        ->get();

    $alatIds = $data->pluck('alat_id')->unique();
    $labels = [];
    $datasets = [];

    foreach ($alatIds as $alatId) {
        $filtered = $data->where('alat_id', $alatId);

        $timestamps = $filtered->pluck('created_at')->map(function ($time) {
            return $time->format('H:i');
        })->toArray();

        if (empty($labels)) {
            $labels = $timestamps;
        }

        $phValues = $filtered->pluck('ph')->toArray();
        $kekeruhanValues = $filtered->pluck('kekeruhan')->toArray();

        $layakFlags = $filtered->map(function ($item) {
            return ($item->ph >= 6.5 && $item->ph <= 8.5 && $item->kekeruhan < 100 && $item->tds < 500) ? 1 : 0;
        })->toArray();

        $datasets[] = [
            'label' => "pH ($alatId)",
            'data' => $phValues,
            'borderColor' => $this->getColor($alatId),
            'backgroundColor' => 'transparent',
            'fill' => false,
            'tension' => 0.3,
            'layak_flags' => $layakFlags
        ];

        $datasets[] = [
            'label' => "Kekeruhan ($alatId)",
            'data' => $kekeruhanValues,
            'borderColor' => $this->getColor($alatId, true),
            'backgroundColor' => 'transparent',
            'fill' => false,
            'borderDash' => [5, 5],
            'tension' => 0.3,
            'layak_flags' => $layakFlags
        ];
    }

    return response()->json([
        'labels' => $labels,
        'datasets' => $datasets
    ]);
}

    
}
