<section class="card bg-white shadow-md">
    <div class="card-body">
    <div class="flex justify-between items-center mb-3">
        <div>
            <h2 class="card-title">🕒 Log Absensi</h2>
            <p class="text-slate-500 text-xs">100 aktivitas terbaru.</p>
        </div>
        <span class="badge badge-neutral">{{ $daftar->count() }} log</span>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>UID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Kelas</th>
                    <th>Jenis</th>
                    <th>Perangkat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftar as $data)
                    <tr class="hover">
                        <td class="text-sm">{{ $data->waktu->timezone('Asia/Jakarta')->translatedFormat('d M Y, H:i:s') }}</td>
                        <td class="font-mono font-semibold text-xs">{{ $data->uid }}</td>
                        <td class="font-medium">{{ $data->nama }}</td>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td><span class="badge badge-success badge-outline">{{ $data->jenis }}</span></td>
                        <td class="text-sm text-slate-500">{{ $data->device_id }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-slate-500 py-6">Belum ada log absensi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
</section>
