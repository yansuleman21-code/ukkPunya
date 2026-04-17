@extends('layouts.app')

@section('content')
<h2 class="text-3xl font-extrabold mb-6 text-gray-800 border-b pb-3">Daftar Semua Aspirasi Masuk</h2>

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
                <th class="p-4 text-center">NIS Siswa</th>
                <th class="p-4">Kategori</th>
                <th class="p-4">Lokasi</th>
                <th class="p-4 text-center">Status</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($data as $d)
            <tr class="border-b hover:bg-gray-50 transition duration-200">
                <td class="p-4 text-center">{{ $loop->iteration }}</td>
                <td class="p-4 text-center font-bold text-gray-800">{{ $d->siswa->nis ?? '-' }}</td>
                <td class="p-4 text-sm font-semibold">{{ $d->kategori->ket_kategori ?? '-' }}</td>
                <td class="p-4 text-sm">{{ $d->lokasi }}</td>
                <td class="p-4 text-center">
                    <span class="px-3 py-1 text-xs font-bold rounded-full text-white shadow-sm
                        {{ $d->status == 'menunggu' ? 'bg-orange-500' : '' }}
                        {{ $d->status == 'proses' ? 'bg-blue-500' : '' }}
                        {{ $d->status == 'selesai' ? 'bg-green-500' : '' }}
                    ">
                        {{ strtoupper($d->status) }}
                    </span>
                </td>
                <td class="p-4 text-center">
                    <a href="{{ route('tanggapan.show', $d->id) }}" class="inline-block bg-blue-600 font-semibold px-4 py-2 rounded-lg shadow text-white hover:bg-blue-700 transition">
                        Tanggapi
                    </a>
                </td>
            </tr>
            @endforeach
            
            @if($data->count() == 0)
            <tr>
                <td colspan="6" class="p-6 text-center text-gray-400 italic">Belum ada aspirasi yang masuk.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
