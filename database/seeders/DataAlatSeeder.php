<?php
namespace Database\Seeders;  // Pastikan namespace ini benar
use Illuminate\Database\Seeder;
use App\Models\DataAlat;
use Carbon\Carbon;

class DataAlatSeeder extends Seeder
{
    public function run()
    {
        DataAlat::create([
            'alat_id' => 'A001',
            'ph' => 7.2,
            'kekeruhan' => 3.5,
            'created_at' => Carbon::now(),
        ]);

        DataAlat::create([
            'alat_id' => 'A002',
            'ph' => 6.8,
            'kekeruhan' => 4.1,
            'created_at' => Carbon::now(),
        ]);
    }
}

