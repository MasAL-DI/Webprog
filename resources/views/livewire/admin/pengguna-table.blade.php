<section class="card bg-white shadow-md">
    <div class="card-body">
    <div class="flex justify-between items-center mb-3">
        <h2 class="card-title">👥 Daftar Pengguna</h2>
        <span class="badge badge-neutral">{{ $daftar->count() }} pengguna</span>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th></th>
                    <th>UID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Kelas</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftar as $data)
                    <tr class="hover">
                        <td>
                            <div class="avatar placeholder">
                                <div class="bg-primary text-primary-content rounded-full w-8">
                                    <span class="text-xs">{{ strtoupper(substr($data->nama, 0, 2)) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="font-mono font-semibold text-xs">{{ $data->uid }}</td>
                        <td class="font-medium">{{ $data->nama }}</td>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td class="text-sm text-slate-500">{{ $data->email }}</td>
                        <td>
                            @if ($data->aktif)
                                <span class="badge badge-success badge-outline">Aktif</span>
                            @else
                                <span class="badge badge-ghost">Nonaktif</span>
                            @endif
                        </td>
                        <td class="space-x-1">
                            <button wire:click="edit('{{ $data->uid }}')" class="btn btn-xs btn-outline">Edit</button>
                            <button wire:click="hapus('{{ $data->uid }}')" wire:confirm="Hapus data pengguna {{ $data->nama }}?"
                                    class="btn btn-xs btn-error btn-outline">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-slate-500 py-6">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
</section>
