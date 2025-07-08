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
            'alat_id' => 'required|integer', // jika alat_id adalah FK ke id tabel 'alat'
            'ph' => 'required|numeric',
            'kekeruhan' => 'required|numeric',
            'tds' => 'required|numeric',
        ]);

        // Tidak perlu hitung status_air lagi karena model otomatis handle

        $data = DataAlat::create($validated);

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $data
        ], 201);
    }

    public function index()
    {
        $data = DataAlat::orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Data berhasil diambil',
            'data' => $data
        ]);
    }
}
