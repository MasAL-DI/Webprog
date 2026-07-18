<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenggunaLoginController extends Controller
{
    public function form()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::guard('pengguna')->attempt($credentials)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        $pengguna = Auth::guard('pengguna')->user();
        if (! $pengguna->aktif) {
            Auth::guard('pengguna')->logout();
            return back()->withErrors(['email' => 'Kartu Anda tidak aktif. Hubungi admin.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('user.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::guard('pengguna')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}
