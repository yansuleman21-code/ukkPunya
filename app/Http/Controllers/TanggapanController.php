<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TanggapanController extends Controller
{
    // Tampilkan semua aspirasi (untuk admin) dengan filter bulan/tahun
    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Aspirasi::with('siswa.user', 'kategori');

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $data = $query->latest()->get();
        return view('admin.tanggapan.index', compact('data', 'bulan', 'tahun'));
    }

    // Fungsi Cetak Laporan PDF
    public function cetakLaporan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Aspirasi::with('siswa.user', 'kategori');

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $data = $query->latest()->get();

        $pdf = Pdf::loadView('admin.tanggapan.pdf', compact('data', 'bulan', 'tahun'))
                  ->setPaper('a4', 'landscape');
        
        $filename = 'Laporan_Pengaduan';
        if ($bulan && $tahun) {
            $namaBulan = \DateTime::createFromFormat('!m', $bulan)->format('F');
            $filename .= "_{$namaBulan}_{$tahun}";
        } elseif ($bulan) {
            $namaBulan = \DateTime::createFromFormat('!m', $bulan)->format('F');
            $filename .= "_{$namaBulan}";
        } elseif ($tahun) {
            $filename .= "_{$tahun}";
        } else {
            $filename .= "_Keseluruhan";
        }
        $filename .= '.pdf';
        
        return $pdf->download($filename);
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
