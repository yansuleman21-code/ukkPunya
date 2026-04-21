<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | SMKN 1 Limboto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-overlay {
            background: linear-gradient(135deg, rgba(252, 189, 214, 0.85) 0%, rgba(255, 192, 220, 0.7) 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .info-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .info-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease forwards; }
        .animate-delay-1 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.4s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.6s; opacity: 0; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    <!-- HERO SECTION  -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/smealUkk.jpg') }}" alt="SMKN 1 Limboto" class="w-full h-full object-cover">
            <div class="hero-overlay absolute inset-0"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white px-6 max-w-4xl mx-auto">
            <!-- Logo -->
            <div class="animate-fade-in-up mb-6">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMKN 1 Limboto" class="w-24 h-24 mx-auto rounded-full border-4 border-white/30 shadow-2xl bg-white p-1">
            </div>

            <h1 class="animate-fade-in-up text-5xl md:text-6xl font-extrabold mb-4 leading-tight drop-shadow-lg">
                SMKN 1 Limboto
            </h1>
            <p class="animate-fade-in-up animate-delay-1 text-xl md:text-2xl font-medium text-with-100 mb-3">
                {{ config('app.name') }} - Sistem Pengaduan & Aspirasi Siswa
            </p>
            <p class="animate-fade-in-up animate-delay-2 text-white-200 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
                Sampaikan keluhan, masukan, atau saran Anda demi lingkungan sekolah yang lebih baik. 
                Kami siap menampung dan menindak lanjuti setiap aspirasi secara profesional dan transparan.
            </p>

            <div class="animate-fade-in-up animate-delay-3 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" class="bg-white text-pink-700 font-bold px-8 py-4 rounded-full shadow-xl hover:bg-pink-50 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-lg">
                    🔐 Masuk ke Aplikasi
                </a>
                <a href="{{ route('register') }}" class="glass-card text-white font-bold px-8 py-4 rounded-full shadow-xl hover:bg-white/20 transition duration-300 transform hover:-translate-y-1 text-lg">
                    📝 Daftar Akun Baru
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-8 h-8 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- ===== INFO SECTION ===== -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Tentang SMKN 1 Limboto</h2>
                <div class="w-20 h-1.5 bg-pink-600 rounded-full mx-auto mb-6"></div>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                    SMKN 1 Limboto adalah sekolah menengah kejuruan negeri terkemuka di Kabupaten Gorontalo, Provinsi Gorontalo. Sekolah ini berfokus pada pendidikan vokasi dengan sarana prasarana yang dikembangkan untuk mendukung kompetensi siswa, serta dikenal memiliki fasilitas techno park sebagai wadah penghubung dengan dunia industri.
                </p>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card Lokasi -->
                <div class="info-card bg-white rounded-2xl p-8 border border-gray-100 shadow-lg text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 50z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Lokasi Sekolah</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Jl. Abdulrahman Moito, Nomor 117, Dutulanaa, Limboto, Gorontalo, 96213
                    </p>
                </div>

                <!-- Card Kontak -->
                <div class="info-card bg-white rounded-2xl p-8 border border-gray-100 shadow-lg text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Contact Person</h3>
                    <div class="text-gray-500 space-y-2">
                        <p>📞 <span class="font-medium text-gray-700">0435-2012001</span></p>
                        <p>📧 <span class="font-medium text-gray-700">smkn.limboto79@gmail.com</span></p>
                        <p>🌐 <a href="http://smkn1limboto.sch.id" target="_blank" class="font-medium text-pink-600 hover:underline">smkn1limboto.sch.id</a></p>
                    </div>
                </div>

                <!-- Card Visi -->
                <div class="info-card bg-white rounded-2xl p-8 border border-gray-100 shadow-lg text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Aspirasi Siswa</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Kami percaya setiap suara siswa penting. Gunakan platform ini untuk menyampaikan aspirasi dan bersama mewujudkan sekolah yang lebih baik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 px-6 bg-gradient-to-br from-pink-50 to-rose-50">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Galeri Sekolah</h2>
            <div class="w-20 h-1.5 bg-pink-600 rounded-full mx-auto"></div>
        </div>

        <div class="relative w-full overflow-hidden rounded-2xl shadow-2xl group" id="galeri-container">
            
            <div class="flex transition-transform duration-500 ease-in-out" id="slider-wrapper">

                <div class="w-full flex-shrink-0">
                    <img src="{{ asset('images/smealUkk.jpg') }}" alt="Gedung SMKN 1 Limboto" class="w-full h-[450px] object-cover">
                </div>

                <div class="w-full flex-shrink-0">
                    <img src="{{ asset('images/ukk1.jpeg') }}" alt="Gedung SMKN 1 Limboto" class="w-full h-[450px] object-cover">
                </div>

                <div class="w-full flex-shrink-0">
                    <img src="{{ asset('images/ukk2.jpg') }}" alt="Gedung SMKN 1 Limboto" class="w-full h-[450px] object-cover">
                </div>

                <div class="w-full flex-shrink-0">
                    <img src="{{ asset('images/ukk3.png') }}" alt="Gedung SMKN 1 Limboto" class="w-full h-[450px] object-cover">
                </div>
            </div>

            <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-pink-600 hover:text-white text-gray-800 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>

            <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-pink-600 hover:text-white text-gray-800 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

    </div>

    <script>
        const wrapper = document.getElementById('slider-wrapper');
        const slides = wrapper.children;
        let currentIndex = 0;

        // Fungsi untuk menggeser wrapper
        function updateSlider() {
            wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        // Fungsi Tombol Next
        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlider();
        }

        // Fungsi Tombol Prev
        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateSlider();
        }

        // Opsional: Membuat gambar bergeser otomatis setiap 4 detik (4000 ms)
        // Hapus baris di bawah ini jika tidak ingin bergeser otomatis
        setInterval(nextSlide, 4000);
    </script>
</section>

    <!-- ===== MAP SECTION ===== -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Lokasi Kami</h2>
                <div class="w-20 h-1.5 bg-pink-600 rounded-full mx-auto mb-6"></div>
                <p class="text-gray-500 text-lg">Temukan kami di Google Maps</p>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-xl border border-gray-200">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.567!2d122.991!3d0.621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x327f16f80e994015%3A0x78ed9e5c4b17e3e6!2sSMKN%201%20Limboto!5e0!3m2!1sid!2sid!4v1713000000000!5m2!1sid!2sid"
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full">
                </iframe>
            </div>
        </div>
    </section>

    <section class="py-16 px-6 bg-gradient-to-r from-pink-600 to-rose-700">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Siap Menyampaikan Aspirasi?</h2>
            <p class="text-pink-100 text-lg mb-8 max-w-2xl mx-auto">
                Login ke akun Anda atau daftar akun baru untuk mulai menyampaikan aspirasi dan keluhan.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" class="bg-white text-pink-700 font-bold px-8 py-4 rounded-full shadow-lg hover:bg-pink-50 transition duration-300 transform hover:-translate-y-1 text-lg">
                    🔐 Login Sekarang
                </a>
                <a href="{{ route('register') }}" class="border-2 border-white text-white font-bold px-8 py-4 rounded-full hover:bg-white/10 transition duration-300 transform hover:-translate-y-1 text-lg">
                    📝 Daftar Akun
                </a>
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
