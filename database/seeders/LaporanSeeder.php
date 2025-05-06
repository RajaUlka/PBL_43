<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Laporan;

class LaporanSeeder extends Seeder
{
    public function run()
    {
        Laporan::create([
            'name' => 'Budi',
            'no_hp' => '08123456789',
            'kendala' => 'Sensor tidak aktif',
            'lokasi' => 'Jakarta',
            'status' => 'baru',
            'id_ticket' => 'TCK123'
        ]);

        Laporan::create([
            'name' => 'Ani',
            'no_hp' => '08987654321',
            'kendala' => 'Data tidak muncul',
            'lokasi' => 'Depok',
            'status' => 'selesai',
            'id_ticket' => 'TCK124'
        ]);
    }
}
