<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AspirasiController extends Controller
{
    // Tampilkan semua aspirasi milik siswa
    public function index()
    {
        $siswa = Auth::user()->siswa;
        $data = Aspirasi::where('siswa_id', $siswa->id)->get();
        return view('siswa.aspirasi.index', compact('data'));
    }

    // Form tambah
    public function create()
    {
        $kategori = Kategori::all();
        return view('siswa.aspirasi.create', compact('kategori'));
    }

    // Simpan data
    public function store(Request $request) {
        $request->validate([
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('aspirasi', 'public');
        }

        Aspirasi::create([
            'siswa_id' => Auth::user()->siswa->id,
            'kategori_id' => $request->kategori_id,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'foto' => $fotoPath,
            'status' => 'menunggu'
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dikirim');
    }

    // Form edit (dengan ownership check)
    public function edit($id)
    {
        $data = Aspirasi::findOrFail($id);

        // Pastikan aspirasi ini milik siswa yang login
        if ($data->siswa_id !== Auth::user()->siswa->id) {
            abort(403, 'Anda tidak berhak mengedit aspirasi ini.');
        }

        $kategori = Kategori::all();
        return view('siswa.aspirasi.edit', compact('data', 'kategori'));
    }

    // Update data (dengan ownership check + foto handling)
    public function update(Request $request, $id)
    {
        $data = Aspirasi::findOrFail($id);

        // Pastikan aspirasi ini milik siswa yang login
        if ($data->siswa_id !== Auth::user()->siswa->id) {
            abort(403, 'Anda tidak berhak mengedit aspirasi ini.');
        }

        $request->validate([
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $updateData = [
            'kategori_id' => $request->kategori_id,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ];

        // Handle foto baru (jika diupload)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($data->foto) {
                Storage::disk('public')->delete($data->foto);
            }
            $updateData['foto'] = $request->file('foto')->store('aspirasi', 'public');
        }

        $data->update($updateData);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil diupdate');
    }

    // Hapus data (dengan ownership check + hapus file foto)
    public function destroy($id)
    {
        $data = Aspirasi::findOrFail($id);

        // Pastikan aspirasi ini milik siswa yang login
        if ($data->siswa_id !== Auth::user()->siswa->id) {
            abort(403, 'Anda tidak berhak menghapus aspirasi ini.');
        }

        // Hapus file foto dari storage jika ada
        if ($data->foto) {
            Storage::disk('public')->delete($data->foto);
        }

        $data->delete();
        
        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dihapus');
    }
}
