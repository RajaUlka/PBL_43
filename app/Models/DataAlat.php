<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAlat extends Model
{
    protected $table = 'data_alat';
    public $timestamps = false; // <<< Tambahkan baris ini

    protected $fillable = [
        'alat_id', 'ph', 'kekeruhan'
    ];
}
