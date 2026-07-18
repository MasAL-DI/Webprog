@extends('layouts.app')
@section('title', 'Login Presensi')
@section('content')
<div class="min-h-[80vh] flex items-center justify-center">
<div class="card w-full max-w-md bg-white shadow-xl">
    <div class="card-body">
    <div class="text-center mb-2">
        <div class="text-4xl mb-2">🪪</div>
        <h1 class="text-xl font-bold">Login Presensi</h1>
        <p class="text-slate-500 text-sm">Masuk dengan akun yang diberikan admin.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-error text-sm py-2">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('user.login') }}" class="space-y-3 mt-2">
        @csrf
        <div class="form-control">
            <label class="label"><span class="label-text font-semibold">Email</span></label>
            <input type="email" name="email" required autofocus class="input input-bordered w-full">
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-semibold">Password</span></label>
            <input type="password" name="password" required class="input input-bordered w-full">
        </div>
        <button class="btn btn-success w-full text-white">Masuk</button>
    </form>
    </div>
</div>
</div>
@endsection
