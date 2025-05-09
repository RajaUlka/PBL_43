<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\DataAlat;
use App\Models\Alat;

class DataAlatIndex extends Component
{
    public $alat_id, $ph, $kekeruhan;
    public $editId = null;
    public $showModal = false;


    protected $rules = [
        'alat_id' => 'required|exists:alat,alat_id',
        'ph' => 'required|numeric',
        'kekeruhan' => 'required|numeric',
    ];

    public function mount()
    {
        // Any initial setup if needed
    }

    public function store()
    {
        $this->validate();
    
        DataAlat::create([
            'alat_id' => $this->alat_id,
            'ph' => $this->ph,
            'kekeruhan' => $this->kekeruhan,
        ]);
    
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $dataAlat = DataAlat::find($id);
        $this->editId = $dataAlat->id;
        $this->alat_id = $dataAlat->alat_id;
        $this->ph = $dataAlat->ph;
        $this->kekeruhan = $dataAlat->kekeruhan;
    
        $this->showModal = true;
    }
    

    public function update()
    {
        $this->validate();

        $dataAlat = DataAlat::find($this->editId);
        $dataAlat->update([
            'alat_id' => $this->alat_id,
            'ph' => $this->ph,
            'kekeruhan' => $this->kekeruhan,
        ]);

        $this->resetForm();
        $this->showModal = false;
    }

    public function delete($id)
    {
        DataAlat::find($id)->delete();
    }

    public function resetForm()
    {
        $this->reset(['alat_id', 'ph', 'kekeruhan', 'editId']);
    }

    public function openModal()
{
    $this->resetForm();
    $this->showModal = true;
}


    public function render()
    {
        // Mengambil semua data alat
        $dataAlat = DataAlat::all();
        $alats = Alat::all();  // Data alat yang dibutuhkan untuk ditampilkan pada dropdown atau tabel
    
        // Mengirimkan data alat dan data alat ke view
        return view('livewire.admin.data-alat-index', compact('dataAlat', 'alats'));
    }
    
    
}

