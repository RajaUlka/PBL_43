<?php

use Livewire\Livewire;
use App\Livewire\Admin\LaporanIndex;
use App\Livewire\Admin\UserIndex;
use App\Livewire\Admin\DaftarAlatIndex;
use App\Livewire\Admin\DataAlatIndex;

Livewire::component('admin.laporan-index', LaporanIndex::class);
Livewire::component('admin.user-index', UserIndex::class);
Livewire::component('admin.daftar-alat-index', DaftarAlatIndex::class);
Livewire::component('admin.data-alat-index', DataAlatIndex::class);