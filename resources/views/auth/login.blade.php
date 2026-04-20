<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 flex flex-col min-h-screen font-sans">
    <div class="flex-grow flex items-center justify-center py-10">
        <div class="bg-white p-10 rounded-2xl shadow-xl w-96 border-t-8 border-pink-600">
            <a href="{{ route('landing') }}" class="inline-block mb-6 text-gray-500 hover:text-pink-600 font-semibold transition text-sm">
                ← Kembali ke Beranda
            </a>
            <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800">Login Yuk!</h2>
            
            {{-- Tampilkan pesan sukses (misal: setelah register) --}}
            @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-lg border border-green-300 font-medium text-center">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-4 mb-6 rounded-lg border border-red-300 font-medium">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" placeholder="Masukkan kata sandi" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition">
                </div>
                
                <button type="submit" class="w-full bg-pink-600 text-white font-bold p-3 rounded-lg hover:bg-pink-700 shadow-lg transition duration-300">
                    Masuk ke Aplikasi
                </button>
            </form>
            
            <p class="text-center text-gray-500 mt-6 text-sm">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-pink-600 font-bold hover:underline">Buat Akun Baru</a>
            </p>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
