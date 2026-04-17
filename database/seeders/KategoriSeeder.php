<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create(['ket_kategori' => 'Fasilitas Sekolah']);
        Kategori::create(['ket_kategori' => 'Kebersihan & Lingkungan']);
        Kategori::create(['ket_kategori' => 'Keamanan & Ketertiban']);
        Kategori::create(['ket_kategori' => 'Layanan Akademik']);
        Kategori::create(['ket_kategori' => 'Lain-lain']);
    }
}
