<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Aspirasi;
use App\Models\User;
use App\Models\Siswa;

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

    // Menampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Memproses data register (akun siswa baru)
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'nis' => 'required|numeric|digits_between:1,10|unique:siswas,nis',
            'kelas' => 'required|string|max:10',
        ]);

        // Buat user baru
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Buat data siswa yang terhubung ke user
        Siswa::create([
            'user_id' => $user->id,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
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
