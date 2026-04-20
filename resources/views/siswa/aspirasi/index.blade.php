@extends('layouts.app')

@section('content')
<h2 class="text-3xl font-extrabold mb-6 text-gray-800 border-b pb-3">Data Aspirasi Saya</h2>

<a href="{{ route('aspirasi.create') }}" class="inline-block bg-pink-600 text-white font-semibold px-5 py-2 rounded-lg shadow hover:bg-pink-700 transition duration-300">
    + Buat Aspirasi Baru
</a>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 mt-5 rounded-lg border border-green-300 font-medium">
    {{ session('success') }}
</div>
@endif

<div class="overflow-x-auto mt-6">
    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <thead class="bg-gray-100 border-b border-gray-300 text-gray-700 text-left">
            <tr>
                <th class="p-4 w-16 text-center">No</th>
                <th class="p-4">Lokasi</th>
                <th class="p-4">Keterangan</th>
                <th class="p-4 text-center">Status</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($data as $d)
            <tr class="border-b hover:bg-gray-50 transition duration-200">
                <td class="p-4 text-center">{{ $loop->iteration }}</td>
                <td class="p-4 font-semibold text-gray-800">{{ $d->lokasi }}</td>
                <td class="p-4 text-sm">{{ $d->keterangan }}</td>
                <td class="p-4 text-center">
                    <span class="px-3 py-1 text-xs font-bold rounded-full text-white shadow-sm
                        {{ $d->status == 'menunggu' ? 'bg-orange-500' : '' }}
                        {{ $d->status == 'proses' ? 'bg-pink-500' : '' }}
                        {{ $d->status == 'selesai' ? 'bg-green-500' : '' }}
                    ">
                        {{ strtoupper($d->status) }}
                    </span>
                </td>
                <td class="p-4 text-center flex justify-center space-x-2">
                    <a href="{{ route('aspirasi.edit', $d->id) }}" class="bg-yellow-400 font-semibold px-3 py-1 rounded shadow text-white hover:bg-yellow-500 transition">
                        Edit
                    </a>
                    <form action="{{ route('aspirasi.destroy', $d->id) }}" method="POST" class="inline">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus aspirasi ini?');" class="bg-red-500 font-semibold px-3 py-1 rounded shadow text-white hover:bg-red-600 transition">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            
            @if($data->count() == 0)
            <tr>
                <td colspan="5" class="p-6 text-center text-gray-400 italic">Anda belum pernah membuat laporan aspirasi.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
