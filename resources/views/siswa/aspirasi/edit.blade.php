@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Edit Data Aspirasi</h2>

    <form method="POST" action="{{ route('aspirasi.update', $data->id) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori Aspirasi</label>
            <select name="kategori_id" id="kategori_id" class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}" {{ $data->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->ket_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Kejadian</label>
            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $data->lokasi) }}" class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>
        </div>

        <div>
            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Detail Aspirasi</label>
            <textarea name="keterangan" id="keterangan" rows="5" class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>{{ old('keterangan', $data->keterangan) }}</textarea>
        </div>

        {{-- Tampilkan foto lama jika ada --}}
        @if($data->foto)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Saat Ini</label>
            <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto Aspirasi" class="h-40 rounded-lg border border-gray-200 shadow-sm">
        </div>
        @endif

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" id="foto" class="w-full text-gray-700 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal ukuran 2MB. Kosongkan jika tidak ingin mengubah foto.</p>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="{{ route('aspirasi.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition font-medium">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition font-semibold shadow-md">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
