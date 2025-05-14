<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;

class LaporanForm extends Component
{
    public $name;
    public $no_hp;
    public $kendala;
    public $lokasi;  // Format string untuk ditampilkan
    public $lat;     // Koordinat Latitude
    public $lng;     // Koordinat Longitude
    public $kendalaList = ['Air Keruh', 'Tidak Mengalir', 'Pipa Bocor', 'Lainnya'];
    public $ticket;

    protected $rules = [
        'name' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
        'kendala' => 'required|string',
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
    ];
    
    public function submit()
    {
        // Validasi form
        $this->validate();
        
        // Generate ticket baru
        $this->ticket = 'TIKET-' . strtoupper(uniqid());
        
        // Menyimpan laporan ke database
        Laporan::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'no_hp' => $this->no_hp,
            'kendala' => $this->kendala,
            'lokasi' => $this->lokasi,
            'status' => 'baru',
            'id_ticket' => $this->ticket,
            'latitude' => $this->lat,
            'longitude' => $this->lng,
        ]);
        
        // Kirimkan sesi berhasil
        session()->flash('success', 'Tiket Anda: ' . $this->ticket);
        
        // Reset data form di Livewire
        $this->reset(['name', 'no_hp', 'kendala', 'lokasi', 'lat', 'lng', 'ticket']);
        
        // Kirimkan event untuk reset form UI
        $this->dispatch('resetForm');
    }
    
    
    
    #[On('mapClicked')]
    public function setLokasi($coords)    
    {
        $this->lat = $coords['lat'] ?? null;
        $this->lng = $coords['lng'] ?? null;
        $this->lokasi = $coords['lokasi'] ?? null; // Ini string nama kota atau address
    }
    public function mount()
    {
        // Tidak perlu melakukan apapun saat mount
    }
    

    public function render()
    {
        return view('livewire.laporan-form');
    }
}


