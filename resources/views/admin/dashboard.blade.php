@extends('layouts.app')

@section('content')
<div class="bg-indigo-50 border-l-8 border-indigo-600 p-8 rounded-xl shadow-sm mb-8 relative overflow-hidden">
    <div class="absolute -right-10 -top-10 bg-indigo-200 opacity-50 w-40 h-40 rounded-full"></div>
    <div class="relative z-10">
        <h2 class="text-4xl font-extrabold text-indigo-900 mb-3">Selamat Datang Admin, {{ auth()->user()->admin->nama ?? auth()->user()->username }}! 🛡️</h2>
        <p class="text-gray-700 text-lg">Anda bertugas mengelola sistem pelaporan aspirasi sekolah hari ini.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
    <!-- Kotak Menunggu -->
    <div class="bg-white p-6 rounded-2xl shadow-lg border-b-4 border-orange-500 flex items-center space-x-6 transform hover:scale-105 transition duration-300">
        <div class="bg-orange-100 p-5 rounded-full">
            <span class="text-3xl">⏳</span>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Menunggu</p>
            <h3 class="text-4xl font-black text-gray-800">{{ \App\Models\Aspirasi::where('status', 'menunggu')->count() }}</h3>
        </div>
    </div>
    
    <!-- Kotak Diproses -->
    <div class="bg-white p-6 rounded-2xl shadow-lg border-b-4 border-blue-500 flex items-center space-x-6 transform hover:scale-105 transition duration-300">
        <div class="bg-blue-100 p-5 rounded-full">
            <span class="text-3xl">⚙️</span>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Sedang Diproses</p>
            <h3 class="text-4xl font-black text-gray-800">{{ \App\Models\Aspirasi::where('status', 'proses')->count() }}</h3>
        </div>
    </div>

    <!-- Kotak Selesai -->
    <div class="bg-white p-6 rounded-2xl shadow-lg border-b-4 border-green-500 flex items-center space-x-6 transform hover:scale-105 transition duration-300">
        <div class="bg-green-100 p-5 rounded-full">
            <span class="text-3xl">✅</span>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Sudah Selesai</p>
            <h3 class="text-4xl font-black text-gray-800">{{ \App\Models\Aspirasi::where('status', 'selesai')->count() }}</h3>
        </div>
    </div>
</div>

<div class="text-center mt-10">
    <a href="{{ route('tanggapan.index') }}" class="bg-slate-800 text-white font-bold px-10 py-4 rounded-full hover:bg-slate-900 shadow-xl transition-all duration-300 inline-block text-lg border border-slate-700">
        Mulai Beri Tanggapan Laporan →
    </a>
</div>
@endsection
