@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b pb-3">
    <h2 class="text-3xl font-extrabold text-gray-800">Daftar Semua Aspirasi Masuk</h2>
    
    <!-- Filter Form & Print Button -->
    <form method="GET" action="{{ route('tanggapan.index') }}" class="flex items-center space-x-2 mt-4 md:mt-0">
        <select name="bulan" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-pink-500 focus:border-pink-500">
            <option value="">Semua Bulan</option>
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                </option>
            @endforeach
        </select>
        
        <input type="number" name="tahun" value="{{ request('tahun', date('Y')) }}" class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-24 focus:ring-pink-500 focus:border-pink-500" placeholder="Tahun">
        
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition shadow">
            Filter
        </button>

        <button type="submit" formaction="{{ route('tanggapan.cetak') }}" class="bg-pink-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-pink-700 transition shadow ml-2 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Laporan
        </button>
    </form>
</div>

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
                <th class="p-4">Nama Siswa</th>
                <th class="p-4 text-center">NIS Siswa</th>
                <th class="p-4">Kategori</th>
                <th class="p-4">Lokasi</th>
                <th class="p-4 text-center">Bukti</th>
                <th class="p-4 text-center">Status</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($data as $d)
            <tr class="border-b hover:bg-gray-50 transition duration-200">
                <td class="p-4 text-center">{{ $loop->iteration }}</td>
                <td class="p-4">{{ $d->siswa->user->username ?? '-' }}</td>
                <td class="p-4 text-center font-bold text-gray-800">{{ $d->siswa->nis ?? '-' }}</td>
                <td class="p-4 text-sm font-semibold">{{ $d->kategori->ket_kategori ?? '-' }}</td>
                <td class="p-4 text-sm">{{ $d->lokasi }}</td>
                <td class="p-4 text-center">
                    @if($d->foto)
                        <span class="text-pink-600 font-bold" title="Ada Foto Bukti">📷</span>
                    @else
                        <span class="text-gray-300">-</span>
                    @endif
                </td>
                <td class="p-4 text-center">
                    <span class="px-3 py-1 text-xs font-bold rounded-full text-white shadow-sm
                        {{ $d->status == 'menunggu' ? 'bg-orange-500' : '' }}
                        {{ $d->status == 'proses' ? 'bg-pink-500' : '' }}
                        {{ $d->status == 'selesai' ? 'bg-green-500' : '' }}
                    ">
                        {{ strtoupper($d->status) }}
                    </span>
                </td>
                <td class="p-4 text-center">
                    <a href="{{ route('tanggapan.show', $d->id) }}" class="inline-block bg-pink-600 font-semibold px-4 py-2 rounded-lg shadow text-white hover:bg-pink-700 transition">
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
