<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';

    protected $fillable = ['alat_id', 'lat', 'lng'];
    
    public function dataAlat()
    {
        return $this->hasMany(DataAlat::class, 'alat_id', 'alat_id');
    }
}
