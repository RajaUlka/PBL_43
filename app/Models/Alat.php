<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';  // Nama tabel harus 'alat'

    protected $fillable = ['nama_alat', 'lat', 'lng'];
    
    public function dataAlat()
    {
        return $this->hasMany(DataAlat::class, 'alat_id', 'id');
    }
}