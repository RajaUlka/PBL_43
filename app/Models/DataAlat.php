<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAlat extends Model
{
    use HasFactory;

    protected $table = 'data_alat';


    protected $fillable = ['alat_id', 'ph', 'kekeruhan', 'tds', 'status_air'];

    public function alat()
    {
        // Default foreign key-nya 'alat_id', dan primary key 'id' di tabel alat
        return $this->belongsTo(Alat::class, 'alat_id', 'id');
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->status_air = self::hitungStatusAir($model->ph, $model->kekeruhan, $model->tds);
        });

        static::updating(function ($model) {
            $model->status_air = self::hitungStatusAir($model->ph, $model->kekeruhan, $model->tds);
        });
    }

    public static function hitungStatusAir($ph, $kekeruhan, $tds)
    {
        return ($ph >= 6.5 && $ph <= 8.5) && ($kekeruhan < 100) && ($tds < 500)
            ? 'layak'
            : 'tidak layak';
    }

}
