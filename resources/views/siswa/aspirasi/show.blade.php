@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="flex justify-between items-center border-b pb-3 mb-6">
        <h2 class="text-3xl font-extrabold text-gray-800">Detail Aspirasi Saya</h2>
        <a href="{{ route('aspirasi.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition font-semibold">
            ← Kembali
        </a>
    </div>

    <!-- Card Detail Aspirasi -->
    <div class="bg-pink-50 p-6 rounded-lg border border-pink-100 mb-8 shadow-sm">
        <table class="w-full text-gray-700">
            <tr>
                <td class="py-2 w-40 font-bold">Kategori</td>
                <td class="py-2">: {{ $data->kategori->nama_kategori }}</td>
            </tr>
            <tr>
                <td class="py-2 font-bold">Lokasi / Tempat</td>
                <td class="py-2">: {{ $data->lokasi }}</td>
            </tr>
            <tr>
                <td class="py-2 font-bold align-top">Keterangan</td>
                <td class="py-2">
                    <div class="bg-white italic p-4 rounded border border-gray-200 mt-1 shadow-inner">
                        {{ $data->keterangan }}
                    </div>
                </td>
            </tr>
            @if($data->foto)
            <tr>
                <td class="py-2 font-bold align-top">Bukti Foto</td>
                <td class="py-2">
                    <div class="mt-2 text-center md:text-left">
                        <img src="{{ asset('storage/' . $data->foto) }}" alt="Bukti Foto" class="max-w-sm h-auto rounded-lg border border-gray-300 shadow-sm hover:scale-[1.02] transition duration-300 cursor-pointer mx-auto md:mx-0" onclick="window.open(this.src)">
                        <p class="text-xs text-gray-500 mt-1 italic">* Klik gambar untuk memperbesar</p>
                    </div>
                </td>
            </tr>
            @endif
            <tr>
                <td class="py-3 font-bold">Status</td>
                <td class="py-3">
                    : 
                    <span class="px-4 py-1.5 ml-2 text-sm font-bold rounded-full text-white shadow-sm
                        {{ $data->status == 'menunggu' ? 'bg-orange-500' : '' }}
                        {{ $data->status == 'proses' ? 'bg-pink-500' : '' }}
                        {{ $data->status == 'selesai' ? 'bg-green-500' : '' }}">
                        {{ strtoupper($data->status) }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Daftar Tanggapan dari Admin -->
    <h3 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
        <span class="bg-pink-600 w-2 h-8 rounded-full mr-3"></span>
        Tanggapan & Feedback Admin
    </h3>

    @if($data->tanggapan->count() > 0)
        <div class="space-y-6 mb-10">
            @foreach($data->tanggapan as $t)
                <div class="bg-white border-l-8 border-pink-500 p-6 rounded-r-lg shadow-md border-y border-r border-gray-100">
                    <div class="flex justify-between items-start mb-3">
                        <span class="bg-pink-100 text-pink-700 text-xs font-bold px-2 py-1 rounded">ADMIN RESPONDED</span>
                        <p class="text-xs text-gray-400 font-medium italic">{{ $t->created_at->translatedFormat('d F Y H:i') }}</p>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-lg">"{{ $t->feedback }}"</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-100 text-gray-500 italic p-8 rounded-lg text-center border-2 border-dashed border-gray-300 mb-10">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            Belum ada tanggapan resmi dari pihak admin untuk saat ini.<br>
            Mohon tunggu informasi selanjutnya.
        </div>
    @endif

</div>
@endsection
