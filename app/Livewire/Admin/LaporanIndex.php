<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Laporan;

class LaporanIndex extends Component
{
    public $editId = null;
    public $status = '';
    public $filterStatus = '';

    public function startEdit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $this->editId = $id;
        $this->status = $laporan->status;
    }

    public function saveStatus()
    {
        $laporan = Laporan::findOrFail($this->editId);
        $laporan->status = $this->status;
        $laporan->save();

        $this->reset(['editId', 'status']);
    }

    public function delete($id)
    {
        Laporan::findOrFail($id)->delete();
    }

    public function render()
    {
        $query = Laporan::query();

        if ($this->filterStatus !== '') {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.admin.laporan-index', [
            'laporans' => $query->get(),
        ]);
    }
}
