<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User; // Pastikan model User ada

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak ditemukan.']);
        }

        if ($user->status !== 'aktif') {
            return back()->withErrors(['username' => 'Akun tidak aktif.']);
        }

        // ✅ VERIFIKASI HASH
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        // Simpan session
        // session(['user_id' => $user->id]);
        session(['user_id' => $user->id, 'user_name' => $user->nama_lengkap]);


        return redirect('/home');
    }
}