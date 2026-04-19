@extends('layouts.app')

@section('content')
<div>
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Dashboard Statistik Admin</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-blue-600 text-white p-6 rounded-xl shadow-md flex flex-col justify-center items-center transform transition hover:scale-105">
            <h5 class="text-lg font-medium text-blue-100 mb-1">Total Aspirasi Masuk</h5>
            <span class="text-5xl font-extrabold">{{ $totalAspirasi }}</span>
        </div>
        
        <div class="bg-amber-500 text-white p-6 rounded-xl shadow-md flex flex-col justify-center items-center transform transition hover:scale-105">
            <h5 class="text-lg font-medium text-amber-100 mb-1">Menunggu Tanggapan</h5>
            <span class="text-5xl font-extrabold">{{ $belumDitanggapi }}</span>
        </div>
    </div>

    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 shadow-sm">
        <h5 class="text-xl font-bold mb-4 text-gray-700">Top 5 Kategori Laporan Terbanyak</h5>
        
        @if(count($kategoriTerbanyak) > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($kategoriTerbanyak as $item)
                    <li class="py-3 flex justify-between items-center">
                        <span class="text-gray-800 font-medium">{{ $item->kategori->nama_kategori }}</span>
                        <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full shadow-sm">{{ $item->total }} laporan</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 italic">Belum ada data aspirasi masuk.</p>
        @endif
    </div>
</div>
@endsection