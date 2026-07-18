@extends('layouts.app')
@section('title', 'Presensi Saya')
@section('content')
<div class="navbar bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-2xl shadow-lg mb-6 px-6">
    <div class="flex-1">
        <h1 class="text-xl font-bold">👋 Halo, {{ auth('pengguna')->user()->nama }}</h1>
    </div>
    <div class="flex-none">
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button class="btn btn-sm btn-ghost text-white">Keluar</button>
        </form>
    </div>
</div>

@livewire('user.presensi-saya')
@endsection
