<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Alat;

class DaftarAlatIndex extends Component
{
    public $alat_id, $lat, $lng;
    public $editId = null;
    public $showModal = false;  // Kontrol modal tampil atau tidak

    protected $rules = [
        'alat_id' => 'required|string|unique:alat,alat_id,' .  // update jika edit
        '$this->editId', // Exclude current edit record from validation
    
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
    ];

    public function mount()
    {
        // setup awal, jika ada
    }

    public function store()
    {
        $this->validate();
    
        Alat::create([
            'alat_id' => $this->alat_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
    
        $this->resetForm();
        $this->dispatch('refreshComponent');
        $this->showModal = false;  // Menutup modal setelah tambah
    }
    

    public function edit($id)
    {
        $alat = Alat::find($id);
        $this->editId = $alat->id;
        $this->alat_id = $alat->alat_id;
        $this->lat = $alat->lat;
        $this->lng = $alat->lng;
        
        $this->showModal = true;  // Tampilkan modal saat edit
    }

    public function update()
    {
        $this->validate();
    
        $alat = Alat::find($this->editId);
        $alat->update([
            'alat_id' => $this->alat_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
    
        $this->resetForm();
        $this->showModal = false;  // Menutup modal setelah update
    }

    public function delete($id)
    {
        Alat::find($id)->delete();
    }
    public function resetForm()
    {
        $this->reset(['alat_id', 'lat', 'lng', 'editId']);
        $this->showModal = false;  // Pastikan modal tertutup saat form reset
    }
    

    public function render()
    {
        $alats = Alat::all();
        return view('livewire.admin.daftar-alat-index', compact('alats'));
    }
}




