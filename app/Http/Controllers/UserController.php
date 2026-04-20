<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = User::with('admin', 'siswa')->get();
        return view('admin.users.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,siswa',
            'nama' => 'required_if:role,admin|nullable|string|max:20',
            'nis' => 'required_if:role,siswa|nullable|string|max:10|unique:siswas,nis',
            'kelas' => 'required_if:role,siswa|nullable|string|max:10',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Buat data role sesuai pilihan
        if ($request->role === 'admin') {
            Admin::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
            ]);
        } else {
            Siswa::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'kelas' => $request->kelas,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function edit($id)
    {
        $user = User::with('admin', 'siswa')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::with('admin', 'siswa')->findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6',
            'nama' => 'nullable|string|max:20',
            'nis' => 'nullable|string|max:10|unique:siswas,nis,' . ($user->siswa->id ?? 'NULL'),
            'kelas' => 'nullable|string|max:10',
        ]);

        // Update data user
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Update data role
        if ($user->admin) {
            $user->admin->update(['nama' => $request->nama]);
        }
        if ($user->siswa) {
            $user->siswa->update([
                'nis' => $request->nis,
                'kelas' => $request->kelas,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cegah admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        $user->delete(); // cascade delete akan menghapus data admin/siswa/aspirasi terkait

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
