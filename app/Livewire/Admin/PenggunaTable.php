<?php

namespace App\Livewire\Admin;

use App\Models\Pengguna;
use Livewire\Attributes\On;
use Livewire\Component;

class PenggunaTable extends Component
{
    public function getListeners()
    {
        return [
            'echo-private:pengguna,PenggunaDiperbarui' => '$refresh',
        ];
    }

    public function edit(string $uid): void
    {
        $this->dispatch('mulai-edit', uid: $uid);
    }

    public function hapus(string $uid): void
    {
        $this->dispatch('hapus-pengguna', uid: $uid);
    }

    public function render()
    {
        return view('livewire.admin.pengguna-table', [
            'daftar' => Pengguna::orderBy('nama')->get(),
        ]);
    }
}
