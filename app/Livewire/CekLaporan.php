<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Laporan;

class CekLaporan extends Component
{
    public $ticket;
    public $laporan;

    protected $layout = 'layouts.main';

    public function cari()
    {
        $this->validate([
            'ticket' => 'required|string',
        ]);

        $this->laporan = Laporan::where('id_ticket', $this->ticket)->first();

        if (!$this->laporan) {
            session()->flash('error', 'Ticket tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.cek-laporan'); // sesuai blade yang asli
    }
}
