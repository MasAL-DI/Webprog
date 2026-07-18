@extends('layouts.app')
@section('title', 'Admin Presensi RFID')
@section('content')
<div class="navbar bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl shadow-lg mb-6 px-6">
    <div class="flex-1">
        <h1 class="text-xl font-bold">📡 Admin Presensi RFID</h1>
    </div>
    <div class="flex-none">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-sm btn-ghost text-white">Keluar</button>
        </form>
    </div>
</div>

<div class="stats shadow w-full mb-6 bg-white">
    <div class="stat">
        <div class="stat-figure text-primary text-3xl">👥</div>
        <div class="stat-title">Total Pengguna</div>
        <div class="stat-value text-primary">{{ \App\Models\Pengguna::count() }}</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-success text-3xl">✅</div>
        <div class="stat-title">Kartu Aktif</div>
        <div class="stat-value text-success">{{ \App\Models\Pengguna::where('aktif', true)->count() }}</div>
    </div>
    <div class="stat">
        <div class="stat-figure text-secondary text-3xl">🕒</div>
        <div class="stat-title">Presensi Hari Ini</div>
        <div class="stat-value text-secondary">{{ \App\Models\Presensi::whereDate('waktu', today())->count() }}</div>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6 mb-6">
    @livewire('admin.pengguna-manager')

    <section class="card bg-white shadow-md">
        <div class="card-body">
            <h2 class="card-title">💡 Petunjuk</h2>
            <p class="text-sm text-slate-600">Simpan akan membuat akun login pengguna + kartu RFID sekaligus.</p>
            <p class="text-sm text-slate-600">UID otomatis diubah menjadi huruf kapital tanpa spasi/tanda titik dua.</p>
            <p class="text-sm text-slate-600">Menonaktifkan kartu lebih aman daripada menghapusnya.</p>
        </div>
    </section>
</div>

@livewire('admin.pengguna-table')

<div class="mt-6">
    @livewire('admin.presensi-log')
</div>
@endsection
