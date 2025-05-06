<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    public $timestamps = false;


    protected $fillable = [
        'name', 'no_hp', 'kendala', 'lokasi', 'status', 'id_ticket'
    ];

    protected $casts = [
        'status' => 'string',  // enum 'baru', 'proses', 'selesai'
    ];
}
