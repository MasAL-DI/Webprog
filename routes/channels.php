<?php

use Illuminate\Support\Facades\Broadcast;

// Hanya admin yang login yang boleh dengar update daftar pengguna.
Broadcast::channel('pengguna', function () {
    return auth('web')->check();
});

// Admin ATAU pemilik kartu yang login boleh dengar log presensi.
Broadcast::channel('presensi', function () {
    return auth('web')->check() || auth('pengguna')->check();
});
