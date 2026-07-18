<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PenggunaDiperbarui implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @param 'created'|'updated'|'deleted' $aksi */
    public function __construct(public string $uid, public string $aksi)
    {
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('pengguna')];
    }

    public function broadcastAs(): string
    {
        return 'PenggunaDiperbarui';
    }

    public function broadcastWith(): array
    {
        return ['uid' => $this->uid, 'aksi' => $this->aksi];
    }
}
