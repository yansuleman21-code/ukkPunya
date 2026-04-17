<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengaduan</title>
    <!-- Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">
    
    <!-- Sidebar Kiri -->
    <div class="w-64 bg-blue-600 text-white p-5 shadow-lg">
        <h2 class="text-2xl font-bold mb-8 text-center border-b border-blue-400 pb-4">Pengaduan</h2>
        
        <!-- Menu Khusus Admin -->
        @if(auth()->user()->admin)
            <a href="{{ route('tanggapan.index') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-blue-500 transition duration-300">
                Data Aspirasi Masuk
            </a>
            <a href="{{ route('admin.dashboard') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-blue-500 transition duration-300">
                Dashboard Admin
            </a>
        @endif

        <!-- Menu Khusus Siswa -->
        @if(auth()->user()->siswa)
            <a href="{{ route('aspirasi.index') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-blue-500 transition duration-300">
                Aspirasi Saya
            </a>
            <a href="{{ route('siswa.dashboard') }}" class="block mb-2 p-3 font-semibold rounded hover:bg-blue-500 transition duration-300">
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

    <!-- Area Konten Utama (Kanan) -->
    <div class="flex-1 p-8">
        <!-- Di sinilah halaman-halaman lain akan dimunculkan -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            @yield('content')
        </div>
    </div>
    
</div>

</body>
</html>
