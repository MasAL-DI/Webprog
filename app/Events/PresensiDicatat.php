<?php

namespace App\Events;

use App\Models\Presensi;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PresensiDicatat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Presensi $presensi)
    {
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('presensi')];
    }

    public function broadcastAs(): string
    {
        return 'PresensiDicatat';
    }

    public function broadcastWith(): array
    {
        return [
            'uid' => $this->presensi->uid,
            'nama' => $this->presensi->nama,
            'nim' => $this->presensi->nim,
            'kelas' => $this->presensi->kelas,
            'jenis' => $this->presensi->jenis,
            'device_id' => $this->presensi->device_id,
            'waktu' => $this->presensi->waktu->toIso8601String(),
        ];
    }
}
