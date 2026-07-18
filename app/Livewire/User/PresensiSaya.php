<?php

namespace App\Livewire\User;

use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PresensiSaya extends Component
{
    public function getListeners()
    {
        return [
            'echo-private:presensi,PresensiDicatat' => '$refresh',
        ];
    }

    public function render()
    {
        $uid = Auth::guard('pengguna')->id();

        return view('livewire.user.presensi-saya', [
            'daftar' => Presensi::where('uid', $uid)->orderByDesc('waktu')->limit(50)->get(),
        ]);
    }
}
