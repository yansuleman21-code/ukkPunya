<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Akun | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 flex flex-col min-h-screen font-sans">
    <div class="flex-grow flex items-center justify-center py-12">
        <div class="bg-white p-10 rounded-2xl shadow-xl w-[440px] border-t-8 border-pink-600">
            <a href="{{ route('landing') }}" class="inline-block mb-4 text-gray-500 hover:text-pink-600 font-semibold transition text-sm">
                ← Kembali ke Beranda
            </a>
            <h2 class="text-3xl font-extrabold mb-2 text-center text-gray-800">Buat Akun Baru</h2>
            <p class="text-center text-gray-500 mb-8 text-sm">Daftar sebagai siswa untuk mengirim aspirasi</p>
            
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-4 mb-6 rounded-lg border border-red-300 font-medium text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-1 text-sm">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Buat username unik" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-1 text-sm">NIS (Nomor Induk Siswa)</label>
                    <input type="text" name="nis" value="{{ old('nis') }}" placeholder="Contoh: 1234567890" required maxlength="10"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" inputmode="numeric"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-1 text-sm">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XII RPL" required maxlength="10"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-1 text-sm">Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-1 text-sm">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang password" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                </div>
                
                <button type="submit" class="w-full bg-pink-600 text-white font-bold p-3 rounded-lg hover:bg-pink-700 shadow-lg transition duration-300 mt-2">
                    Daftar Sekarang
                </button>
            </form>
            
            <p class="text-center text-gray-500 mt-6 text-sm">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-pink-600 font-bold hover:underline">Login di sini</a>
            </p>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
