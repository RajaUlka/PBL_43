<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAlat extends Model
{
    protected $table = 'data_alat';

    protected $fillable = ['alat_id', 'ph', 'kekeruhan'];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id', 'alat_id');
    }
}
