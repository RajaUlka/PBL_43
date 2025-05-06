<?php
namespace Database\Seeders;  // Pastikan namespace ini benar
use Illuminate\Database\Seeder;
use App\Models\Alat;
use Carbon\Carbon;

class AlatSeeder extends Seeder
{
    public function run()
    {
        Alat::create([
            'alat_id' => 'A001',
            'lat' => -6.1751,
            'lng' => 106.8650,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Alat::create([
            'alat_id' => 'A002',
            'lat' => -6.2000,
            'lng' => 106.9000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

