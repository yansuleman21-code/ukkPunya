@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Kirim Aspirasi Baru</h2>

    <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori Aspirasi</label>
            <select name="kategori_id" id="kategori_id" class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                <option value="" selected disabled>-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Kejadian</label>
            <input type="text" name="lokasi" id="lokasi" class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" value="{{ old('lokasi') }}" placeholder="Contoh: Kantin, Lab RPL, Parkiran" required>
        </div>

        <div>
            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Detail Aspirasi</label>
            <textarea name="keterangan" id="keterangan" rows="5" class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Ceritakan detail aspirasi atau keluhan Anda..." required>{{ old('keterangan') }}</textarea>
        </div>

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti (Opsional)</label>
            <input type="file" name="foto" id="foto" class="w-full text-gray-700 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal ukuran 2MB.</p>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="{{ route('aspirasi.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition font-medium">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-semibold shadow-md">Kirim Aspirasi</button>
        </div>
    </form>
</div>
@endsection