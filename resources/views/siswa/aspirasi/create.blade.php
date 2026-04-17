@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Buat Laporan Aspirasi Baru</h2>

<form method="POST" action="{{ route('aspirasi.store') }}" class="bg-white p-8 rounded-lg shadow-md border border-gray-100 max-w-2xl">
    @csrf
    
    <label class="block mb-2 font-semibold text-gray-700">Pilih Kategori</label>
    <select name="kategori_id" class="w-full p-3 border border-gray-300 rounded-lg mb-6 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none transition" required>
        <option value="">-- Silakan Pilih Kategori --</option>
        @foreach($kategori as $k)
            <option value="{{ $k->id }}">{{ $k->ket_kategori }}</option>
        @endforeach
    </select>
    
    <label class="block mb-2 font-semibold text-gray-700">Dimana Lokasinya?</label>
    <input type="text" name="lokasi" placeholder="Misal: Toilet Lantai 2" class="w-full p-3 border border-gray-300 rounded-lg mb-6 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none transition" required>
    
    <label class="block mb-2 font-semibold text-gray-700">Jelaskan Permasalahannya</label>
    <textarea name="keterangan" rows="5" placeholder="Keran air bocor dan lantai licin..." class="w-full p-3 border border-gray-300 rounded-lg mb-6 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none transition" required></textarea>
    
    <div class="flex space-x-3 mt-2">
        <button type="submit" class="flex-1 bg-blue-600 text-white font-bold px-4 py-3 rounded-lg shadow hover:bg-blue-700 transition duration-300">
            Kirim Aspirasi Sekarang
        </button>
        <a href="{{ route('aspirasi.index') }}" class="bg-gray-300 text-gray-700 font-bold px-6 py-3 rounded-lg shadow hover:bg-gray-400 transition text-center duration-300">
            Batal
        </a>
    </div>
</form>
@endsection
