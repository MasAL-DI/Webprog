<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 20)->index();
            $table->foreign('uid')->references('uid')->on('pengguna')->cascadeOnDelete();
            $table->string('nama');
            $table->string('nim');
            $table->string('kelas');
            $table->string('jenis')->default('masuk');
            $table->string('device_id')->nullable();
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();

            $table->index('waktu');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
