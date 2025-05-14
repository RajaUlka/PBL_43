<?php

namespace App\Http\Controllers;

use App\Models\Laporan; // Tambahkan ini untuk mengakses model Laporan
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil data tiket yang dilaporkan oleh user yang sedang login
        $tickets = Laporan::where('user_id', Auth::id())->pluck('id_ticket'); // Ambil hanya kode tiket

        // Kembalikan data tiket ke view dashboard
        return view('user.dashboard', compact('tickets'));
    }
}
