<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['uid', 'nama', 'nim', 'kelas', 'email', 'password', 'aktif'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'aktif' => 'boolean',
        ];
    }

    public function presensi(): HasMany
    {
        return $this->hasMany(Presensi::class, 'uid', 'uid');
    }

    /** Samakan aturan UID dengan versi lama: HEX 8-20 karakter, genap panjangnya. */
    public static function normalisasiUid(string $value): string
    {
        return strtoupper(preg_replace('/[^0-9A-F]/i', '', $value));
    }

    public static function validUid(string $uid): bool
    {
        return (bool) preg_match('/^[0-9A-F]{8,20}$/', $uid) && strlen($uid) % 2 === 0;
    }
}
