<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            // uid kartu RFID jadi primary key, sama seperti dokumen Firestore dulu
            $table->string('uid', 20)->primary();
            $table->string('nama');
            $table->string('nim');
            $table->string('kelas');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('aktif')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
