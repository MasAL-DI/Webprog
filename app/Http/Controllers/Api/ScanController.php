<?php

namespace App\Http\Controllers\Api;

use App\Events\PresensiDicatat;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScanController extends Controller
{
    /**
     * Pengganti alur lama: tulis ke koleksi `scan_masuk` lalu diproses
     * dengan Firestore transaction di browser admin. Sekarang alat
     * langsung memanggil endpoint ini dan semua validasi terjadi di server.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'uid' => ['required', 'string'],
            'device_id' => ['nullable', 'string', 'max:50'],
        ]);

        $uid = Pengguna::normalisasiUid($data['uid']);

        if (! Pengguna::validUid($uid)) {
            return response()->json(['berhasil' => false, 'pesan' => 'UID scan tidak valid.'], 422);
        }

        $presensi = DB::transaction(function () use ($uid, $data) {
            $pengguna = Pengguna::whereKey($uid)->lockForUpdate()->first();

            if (! $pengguna) {
                return ['error' => "UID {$uid} tidak terdaftar."];
            }

            if (! $pengguna->aktif) {
                return ['error' => "Kartu {$uid} tidak aktif."];
            }

            return Presensi::create([
                'uid' => $uid,
                'nama' => $pengguna->nama,
                'nim' => $pengguna->nim,
                'kelas' => $pengguna->kelas,
                'jenis' => 'masuk',
                'device_id' => $data['device_id'] ?? 'wemos-01',
                'waktu' => now(),
            ]);
        });

        if (is_array($presensi)) {
            return response()->json(['berhasil' => false, 'pesan' => $presensi['error']], 422);
        }

        PresensiDicatat::dispatch($presensi);

        return response()->json([
            'berhasil' => true,
            'nama' => $presensi->nama,
            'waktu' => $presensi->waktu->toIso8601String(),
        ]);
    }
}
