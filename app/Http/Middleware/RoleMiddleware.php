<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Cek apakah user punya role yang sesuai.
     * Penggunaan: middleware('role:admin') atau middleware('role:siswa')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Cek role berdasarkan relasi di tabel admins / siswas
        if ($role === 'admin' && !$user->admin) {
            abort(403, 'Akses ditolak. Anda bukan Admin.');
        }

        if ($role === 'siswa' && !$user->siswa) {
            abort(403, 'Akses ditolak. Anda bukan Siswa.');
        }

        return $next($request);
    }
}
