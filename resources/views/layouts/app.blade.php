<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
    
    <div class="w-64 bg-pink-600 text-white p-5 shadow-lg">
        <div class="flex items-center justify-center gap-3 mb-8 border-b border-pink-400 pb-4">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Sekolah" class="w-10 h-10 rounded-full bg-white p-0.5 shadow">
            <h2 class="text-2xl font-bold">e-Speak</h2>
        </div>
        
        <!-- Menu Khusus Admin -->
        @if(auth()->user()->admin)
            <a href="{{ route('admin.dashboard') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-pink-500 transition duration-300">
                Dashboard Admin
            </a>
            <a href="{{ route('tanggapan.index') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-pink-500 transition duration-300">
                Data Aspirasi Masuk
            </a>
            <a href="{{ route('kategori.index') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-pink-500 transition duration-300">
                Manajemen Kategori
            </a>
            <a href="{{ route('users.index') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-pink-500 transition duration-300">
                Manajemen User
            </a>
        @endif

        <!-- Menu Khusus Siswa -->
        @if(auth()->user()->siswa)
            <a href="{{ route('aspirasi.index') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-pink-500 transition duration-300">
                Aspirasi Saya
            </a>
            <a href="{{ route('siswa.dashboard') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-pink-500 transition duration-300">
                Dashboard Siswa
            </a>
        @endif

        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="w-full bg-red-500 font-bold p-3 rounded shadow hover:bg-red-600 transition duration-300">
                Logout
            </button>
        </form>
    </div>

    <div class="flex-1 p-8">
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            @yield('content')
        </div>

        @include('partials.footer')
    </div>
</div>


</body>
</html>
