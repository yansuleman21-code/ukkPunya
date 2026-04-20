@extends('layouts.app')

@section('content')
<div>
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Manajemen Kategori</h2>

    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-8 shadow-sm">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Tambah Kategori Baru</h3>
        <form action="{{ route('kategori.store') }}" method="POST" class="flex gap-3">
            @csrf
            <input type="text" name="nama_kategori" placeholder="Nama Kategori (Contoh: Kebersihan)" 
                   class="flex-1 border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 outline-none" required>
            <button type="submit" class="bg-pink-600 text-white px-6 py-2.5 rounded-md font-semibold hover:bg-pink-700 transition">
                Simpan
            </button>
        </form>
        @error('nama_kategori')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100 text-gray-600 font-bold uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($kategoris as $index => $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $item->ket_kategori }}</td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection