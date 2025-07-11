<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Alat;


class DaftarAlatIndex extends Component
{
    public $nama_alat, $lat, $lng;
    public $editId = null;
    public $showModal = false;

    protected function rules()
    {
        return [
            'nama_alat' => 'required|string|unique:alat,nama_alat,' . $this->editId,
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ];
    }

    public function store()
    {
        $this->validate();

        Alat::create([
            'nama_alat' => $this->nama_alat,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);

        $this->resetForm();
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $this->editId = $alat->id;
        $this->nama_alat = $alat->nama_alat;
        $this->lat = $alat->lat;
        $this->lng = $alat->lng;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $alat = Alat::findOrFail($this->editId);
        $alat->update([
            'nama_alat' => $this->nama_alat,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        Alat::findOrFail($id)->delete();
    }

    public function resetForm()
    {
        $this->reset(['nama_alat', 'lat', 'lng', 'editId']);
        $this->showModal = false;
    }

    public function render()
    {
        $alats = Alat::all();
        return view('livewire.admin.daftar-alat-index', compact('alats'));
    }
}


