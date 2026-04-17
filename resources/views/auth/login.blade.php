<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Sistem Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex items-center justify-center h-screen font-sans">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-96 border-t-8 border-blue-600">
        <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800">Login Yuk!</h2>
        
        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-3 mb-6 rounded-lg text-center font-semibold border border-red-300">
                {{ session('error') }}
            </div>
        @endif
        
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" placeholder="Masukkan kata sandi" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white font-bold p-3 rounded-lg hover:bg-blue-700 shadow-lg transition duration-300">
                Masuk ke Aplikasi
            </button>
        </form>
    </div>
</body>
</html>
