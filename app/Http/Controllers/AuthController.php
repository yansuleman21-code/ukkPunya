<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Aspirasi;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Pengecekan Hak Akses: Login sebagai Admin atau Siswa?
            // Menggunakan relasi yang sudah kita buat di model User
            $user = Auth::user();
            
            if ($user->admin) { // Jika punya data di tabel admins
                return redirect()->route('admin.dashboard');
            } elseif ($user->siswa) { // Jika punya data di tabel siswas
                return redirect()->route('siswa.dashboard');
            }

            // Jika tidak ada data spesifik (fallback back)
            Auth::logout();
            return back()->withErrors(['username' => 'Akun tidak memiliki hak akses yang jelas.']);
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Menangani Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function adminDashboard()
    {
        $totalAspirasi = Aspirasi::count();
        $belumDitanggapi = Aspirasi::where('status', 'menunggu')->count();

        $kategoriTerbanyak = Aspirasi::select('kategori_id', DB::raw('count(*) as total'))
            ->groupBy('kategori_id')
            ->with('kategori')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalAspirasi', 'belumDitanggapi', 'kategoriTerbanyak'));
    }

    public function siswaDashboard()
    {
        return view('siswa.dashboard');
    }
}
