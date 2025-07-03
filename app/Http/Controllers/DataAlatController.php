<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAlat;

class DataAlatController extends Controller
{
    // Simpan data dari ESP32
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alat_id' => 'required|string',
            'ph' => 'required|numeric',
            'kekeruhan' => 'required|numeric',
            'tds' => 'required|numeric',
        ]);
    
        // Hitung status air
        $ph = $validated['ph'];
        $kekeruhan = $validated['kekeruhan'];
        $tds = $validated['tds'];
    
        $status = ($ph >= 6.5 && $ph <= 8.5) &&
                  ($kekeruhan < 100) &&
                  ($tds < 500) ? 'layak' : 'tidak layak';
    
        // Simpan ke database
        $data = \App\Models\DataAlat::create([
            'alat_id' => $validated['alat_id'],
            'ph' => $ph,
            'kekeruhan' => $kekeruhan,
            'status_air' => $status,
        ]);
    
        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $data
        ], 201);
    }
    
}
