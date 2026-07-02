<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Ambil nama role dari user yang login
        $userRole = auth()->user()->role->name;

        // Cek apakah role user ada di dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
