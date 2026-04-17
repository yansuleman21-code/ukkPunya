<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    // Tampilkan semua aspirasi (untuk admin)
    public function index()
    {
        // Menggunakan "with" untuk mencegah N+1 Query Problem (sangat efisien!)
        $data = Aspirasi::with('siswa', 'kategori')->get();
        return view('admin.tanggapan.index', compact('data'));
    }

    // Detail aspirasi + Form untuk memberikan tanggapan
    public function show($id)
    {
        $data = Aspirasi::with('tanggapan')->findOrFail($id);
        return view('admin.tanggapan.show', compact('data'));
    }

    // Simpan tanggapan ke database & Update status Aspirasi
    public function store(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required',
            'status' => 'required'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        
        // Buat Tanggapan baru
        Tanggapan::create([
            'aspirasi_id' => $aspirasi->id,
            'admin_id' => Auth::user()->admin->id,
            'feedback' => $request->feedback
        ]);

        // Update status Aspirasi (misal dari "proses" menjadi "selesai")
        $aspirasi->update([
            'status' => $request->status
        ]);

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil dikirim dan status diupdate!');
    }
}
