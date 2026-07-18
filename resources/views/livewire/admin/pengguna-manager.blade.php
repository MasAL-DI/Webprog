<section class="card bg-white shadow-md">
    <div class="card-body">
    <h2 class="card-title mb-2">{{ $sedangEditUid ? '✏️ Edit Pengguna' : '➕ Buat Akun User' }}</h2>

    @if ($pesan)
        <div class="alert
            {{ $pesanTipe === 'success' ? 'alert-success' : ($pesanTipe === 'error' ? 'alert-error' : 'alert-info') }} text-sm py-2">
            {{ $pesan }}
        </div>
    @endif

    <form wire:submit="simpan" class="space-y-3">
        <div class="form-control">
            <label class="label"><span class="label-text font-semibold">UID Kartu</span></label>
            <input type="text" wire:model.live="uid" maxlength="20" @if($sedangEditUid) disabled @endif
                   class="input input-bordered w-full">
            @error('uid') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-semibold">Nama</span></label>
            <input type="text" wire:model="nama" class="input input-bordered w-full">
            @error('nama') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-semibold">NIM</span></label>
            <input type="text" wire:model="nim" class="input input-bordered w-full">
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-semibold">Kelas</span></label>
            <input type="text" wire:model="kelas" class="input input-bordered w-full">
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-semibold">Email Login</span></label>
            <input type="email" wire:model="email" @if($sedangEditUid) disabled @endif
                   class="input input-bordered w-full">
            @error('email') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-semibold">Password Awal</span></label>
            <input type="password" wire:model="password" @if($sedangEditUid) disabled @endif
                   class="input input-bordered w-full">
            @error('password') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <label class="label cursor-pointer justify-start gap-2">
            <input type="checkbox" wire:model="aktif" class="checkbox checkbox-primary">
            <span class="label-text">Kartu aktif</span>
        </label>
        <div class="flex gap-2 pt-2">
            <button class="btn btn-primary">
                {{ $sedangEditUid ? 'Simpan Perubahan' : 'Buat Akun' }}
            </button>
            @if ($sedangEditUid)
                <button type="button" wire:click="batalEdit" class="btn btn-ghost">Batal</button>
            @endif
        </div>
    </form>
    </div>
</section>
