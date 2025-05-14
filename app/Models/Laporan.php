<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'name',
        'no_hp',
        'kendala',
        'lokasi',
        'status',
        'id_ticket',
        'latitude',
        'longitude',
        'user_id', // Kolom user_id
    ];

    protected $casts = [
        'status' => 'string',  // enum 'baru', 'proses', 'selesai'
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke model User
    }
}


