<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\DataAlat;
use App\Models\Alat;

class DataAlatIndex extends Component
{
    public $alat_id, $ph, $kekeruhan, $tds;
    public $editId = null;
    public $showModal = false;

    protected $rules = [
        'alat_id' => 'required|exists:alat,id',
        'ph' => 'required|numeric',
        'kekeruhan' => 'required|numeric',
        'tds' => 'required|numeric',
    ];

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();

        DataAlat::create([
            'alat_id' => $this->alat_id,
            'ph' => $this->ph,
            'kekeruhan' => $this->kekeruhan,
            'tds' => $this->tds,
        ]);

        $this->resetForm();
        $this->closeModal();
    }

    public function edit($id)
    {
        $dataAlat = DataAlat::findOrFail($id);
        $this->editId = $dataAlat->id;
        $this->alat_id = $dataAlat->alat_id;
        $this->ph = $dataAlat->ph;
        $this->kekeruhan = $dataAlat->kekeruhan;
        $this->tds = $dataAlat->tds;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        if (!$this->editId) return;

        $dataAlat = DataAlat::findOrFail($this->editId);

        $dataAlat->update([
            'alat_id' => $this->alat_id,
            'ph' => $this->ph,
            'kekeruhan' => $this->kekeruhan,
            'tds' => $this->tds,
        ]);

        $this->resetForm();
        $this->closeModal();
    }

    public function delete($id)
    {
        DataAlat::findOrFail($id)->delete();
    }

    public function resetForm()
    {
        $this->reset(['alat_id', 'ph', 'kekeruhan', 'tds', 'editId']);
    }

    public function cancel()
    {
        $this->resetForm();
        $this->closeModal();
    }

    public function render()
    {
        $dataAlat = DataAlat::with('alat')->orderBy('created_at', 'desc')->get();
        $alats = Alat::all();

        return view('livewire.admin.data-alat-index', compact('dataAlat', 'alats'));
    }
}
