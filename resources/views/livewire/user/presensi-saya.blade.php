<section class="card bg-white shadow-md">
    <div class="card-body">
    <div class="flex justify-between items-center mb-3">
        <h2 class="card-title">📋 Riwayat Presensi</h2>
        <span class="badge badge-neutral">{{ $daftar->count() }} log</span>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Jenis</th>
                    <th>Perangkat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftar as $data)
                    <tr class="hover">
                        <td>{{ $data->waktu->timezone('Asia/Jakarta')->translatedFormat('d M Y, H:i:s') }}</td>
                        <td><span class="badge badge-success badge-outline">{{ $data->jenis }}</span></td>
                        <td class="text-sm text-slate-500">{{ $data->device_id }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center text-slate-500 py-6">Belum ada riwayat presensi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
</section>
