@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="flex justify-between items-center border-b pb-3 mb-6">
        <h2 class="text-3xl font-extrabold text-gray-800">Detail & Tanggapan</h2>
        <a href="{{ route('tanggapan.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition font-semibold">
            ← Kembali
        </a>
    </div>

    <!-- Card Detail Pelapor -->
    <div class="bg-pink-50 p-6 rounded-lg border border-pink-100 mb-8 shadow-sm">
        <table class="w-full text-gray-700">
            <tr>
                <td class="py-2 w-40 font-bold">Pelapor</td>
                <td class="py-2">: Siswa (NIS: <span class="font-bold text-pink-700">{{ $data->siswa->nis ?? '-' }}</span>)</td>
            </tr>
            <tr>
                <td class="py-2 font-bold">Lokasi / Tempat</td>
                <td class="py-2">: {{ $data->lokasi }}</td>
            </tr>
            <tr>
                <td class="py-2 font-bold valign-top">Keterangan</td>
                <td class="py-2 bg-white italic p-3 rounded border border-gray-200 mt-2 block w-full">{{ $data->keterangan }}</td>
            </tr>
            <tr>
                <td class="py-3 font-bold">Status Saat Ini</td>
                <td class="py-3">
                    : 
                    <span class="px-3 py-1 ml-2 text-sm font-bold rounded-full text-white shadow-sm
                        {{ $data->status == 'menunggu' ? 'bg-orange-500' : '' }}
                        {{ $data->status == 'proses' ? 'bg-pink-500' : '' }}
                        {{ $data->status == 'selesai' ? 'bg-green-500' : '' }}">
                        {{ strtoupper($data->status) }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Form Beri Tanggapan -->
    <form method="POST" action="{{ route('tanggapan.store', $data->id) }}" class="bg-white p-6 rounded-lg mb-8 border border-gray-200 shadow-sm">
        @csrf
        <h3 class="text-xl font-bold mb-4 text-gray-800">Beri Tindakan</h3>
        
        <label class="block mb-2 font-semibold text-gray-700">Ubah Status Aspirasi</label>
        <select name="status" class="w-full md:w-1/2 p-3 border border-gray-300 rounded-lg mb-5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition" required>
            <option value="menunggu" {{ $data->status == 'menunggu' ? 'selected' : '' }}>Menunggu (Belum Direspon)</option>
            <option value="proses" {{ $data->status == 'proses' ? 'selected' : '' }}>Proses (Sedang Ditangani)</option>
            <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai (Sudah Tuntas)</option>
        </select>
        
        <label class="block mb-2 font-semibold text-gray-700">Balasan / Catatan Admin</label>
        <textarea name="feedback" rows="4" placeholder="Tulis catatan atau tindakan yang sudah dilakukan..." class="w-full p-3 border border-gray-300 rounded-lg mb-5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-pink-400 focus:outline-none transition" required></textarea>
        
        <button type="submit" class="bg-pink-600 text-white font-bold px-6 py-3 rounded-lg shadow hover:bg-pink-700 transition duration-300">
            Simpan Tanggapan
        </button>
    </form>

    <!-- Riwayat Tanggapan -->
    <h3 class="text-xl font-bold mb-4 text-gray-800">Riwayat Tanggapan Sebelumnya</h3>
    @if($data->tanggapan->count() > 0)
        <div class="space-y-4">
            @foreach($data->tanggapan as $t)
                <div class="bg-gray-50 border-l-4 border-pink-500 p-4 rounded shadow-sm">
                    <p class="text-xs text-gray-500 mb-1 font-semibold">Tanggapan dicatat pada: {{ $t->created_at->format('d/m/Y H:i') }}</p>
                    <p class="text-gray-800">"{{ $t->feedback }}"</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic bg-gray-50 p-4 rounded">Belum ada tanggapan yang diberikan untuk aspirasi ini.</p>
    @endif

</div>
@endsection
