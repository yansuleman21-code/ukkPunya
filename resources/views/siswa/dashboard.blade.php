@extends('layouts.app')

@section('content')
<div class="bg-pink-50 border-l-8 border-pink-600 p-8 rounded-xl shadow-sm mb-8 relative overflow-hidden">
    <div class="absolute -right-10 -top-10 bg-pink-200 opacity-50 w-40 h-40 rounded-full"></div>
    <div class="relative z-10">
        <h2 class="text-4xl font-extrabold text-pink-900 mb-3">Selamat Datang, {{ auth()->user()->username }}! 👋</h2>
        <p class="text-gray-700 text-lg">
            NIS Anda: <span class="font-bold bg-pink-100 px-2 py-1 rounded text-pink-800">{{ auth()->user()->siswa->nis ?? '-' }}</span> 
        </p>
    </div>
</div>

<div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100 text-center">

    <img src="https://cdni.iconscout.com/illustration/premium/thumb/student-studying-online-4438318-3718491.png" alt="Welcome" class="h-64 mx-auto mb-8 opacity-90 drop-shadow-md">
    
    <h3 class="text-3xl font-bold text-gray-800 mb-4">Sistem Pelaporan Aspirasi Sekolah</h3>
    <p class="text-gray-500 mb-10 max-w-2xl mx-auto text-lg leading-relaxed">
        Sampaikan keluhan, masukan, atau saran Anda demi lingkungan sekolah yang lebih baik. Kami siap menampung dan menindaklanjuti setiap laporan yang Anda berikan secara profesional.
    </p>
    
    <a href="{{ route('aspirasi.create') }}" class="bg-pink-600 font-extrabold text-white px-10 py-4 rounded-full shadow-lg hover:bg-pink-700 hover:shadow-pink-300 transition duration-300 transform hover:-translate-y-1 inline-block text-lg">
        ✍️ Tulis Aspirasi Sekarang
    </a>
</div>
@endsection

