<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MustAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Pastikan user sudah login (seharusnya sudah dicek oleh 'auth')
        if (!Auth::check()) {
            // Jika belum login, arahkan ke login
            return redirect()->route('login');
        }

        // 2. Cek role
        $user = Auth::user();

        // 3. Pastikan field 'role' ada dan bernilai 'admin'
        if (!$user->role || !in_array(strtolower($user->role), ['admin', 'administrator'])) {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}