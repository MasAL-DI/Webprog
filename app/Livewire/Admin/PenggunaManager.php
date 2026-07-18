<?php

namespace App\Livewire\Admin;

use App\Events\PenggunaDiperbarui;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class PenggunaManager extends Component
{
    public string $uid = '';
    public string $nama = '';
    public string $nim = '';
    public string $kelas = '';
    public string $email = '';
    public string $password = '';
    public bool $aktif = true;

    public ?string $sedangEditUid = null;
    public string $pesan = '';
    public string $pesanTipe = 'info';

    protected function rules(): array
    {
        $emailRule = $this->sedangEditUid
            ? []
            : ['required', 'email', 'unique:pengguna,email'];

        $passwordRule = $this->sedangEditUid
            ? []
            : ['required', 'min:6'];

        return [
            'uid' => ['required', 'string'],
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50'],
            'kelas' => ['required', 'string', 'max:50'],
            'email' => $emailRule,
            'password' => $passwordRule,
        ];
    }

    public function updatedUid($value): void
    {
        $this->uid = Pengguna::normalisasiUid($value);
    }

    public function simpan(): void
    {
        $this->validate();

        $uid = $this->sedangEditUid ?? Pengguna::normalisasiUid($this->uid);

        if (! Pengguna::validUid($uid)) {
            $this->pesan = 'UID harus 8-20 karakter HEX, jumlah genap.';
            $this->pesanTipe = 'error';
            return;
        }

        if ($this->sedangEditUid) {
            $pengguna = Pengguna::findOrFail($uid);
            $pengguna->update([
                'nama' => $this->nama,
                'nim' => $this->nim,
                'kelas' => $this->kelas,
                'aktif' => $this->aktif,
            ]);
            PenggunaDiperbarui::dispatch($uid, 'updated');
            $this->pesan = 'Data pengguna berhasil diperbarui.';
        } else {
            if (Pengguna::whereKey($uid)->exists()) {
                $this->pesan = 'UID kartu sudah terdaftar.';
                $this->pesanTipe = 'error';
                return;
            }

            Pengguna::create([
                'uid' => $uid,
                'nama' => $this->nama,
                'nim' => $this->nim,
                'kelas' => $this->kelas,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'aktif' => $this->aktif,
            ]);
            PenggunaDiperbarui::dispatch($uid, 'created');
            $this->pesan = 'Akun berhasil dibuat.';
        }

        $this->pesanTipe = 'success';
        $this->reset(['uid', 'nama', 'nim', 'kelas', 'email', 'password', 'sedangEditUid']);
        $this->aktif = true;
    }

    #[On('mulai-edit')]
    public function mulaiEdit(string $uid): void
    {
        $pengguna = Pengguna::findOrFail($uid);
        $this->sedangEditUid = $uid;
        $this->uid = $pengguna->uid;
        $this->nama = $pengguna->nama;
        $this->nim = $pengguna->nim;
        $this->kelas = $pengguna->kelas;
        $this->email = $pengguna->email;
        $this->password = '';
        $this->aktif = $pengguna->aktif;
    }

    public function batalEdit(): void
    {
        $this->reset(['uid', 'nama', 'nim', 'kelas', 'email', 'password', 'sedangEditUid']);
        $this->aktif = true;
    }

    #[On('hapus-pengguna')]
    public function hapus(string $uid): void
    {
        Pengguna::destroy($uid);
        PenggunaDiperbarui::dispatch($uid, 'deleted');
        if ($this->sedangEditUid === $uid) {
            $this->batalEdit();
        }
        $this->pesan = 'Pengguna berhasil dihapus.';
        $this->pesanTipe = 'success';
    }

    public function render()
    {
        return view('livewire.admin.pengguna-manager');
    }
}
