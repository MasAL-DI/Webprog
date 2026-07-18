<?php

namespace App\Livewire\Admin;

use App\Models\Presensi;
use Livewire\Component;

class PresensiLog extends Component
{
    public function getListeners()
    {
        return [
            'echo-private:presensi,PresensiDicatat' => '$refresh',
        ];
    }

    public function render()
    {
        return view('livewire.admin.presensi-log', [
            'daftar' => Presensi::orderByDesc('waktu')->limit(100)->get(),
        ]);
    }
}
