<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'username' => 'siswa1',
            'password' => Hash::make('123456'),
        ]);

        $siswa = Siswa::create([
            'user_id' => $user1->id,
            'nis'=> '1234567890',
            'kelas' => 'XII RPL'
        ]);

        $user2 = User::create([
            'username' => 'siswa2',
            'password' => Hash::make('123456'),
        ]);

        $siswa = Siswa::create([
            'user_id' => $user2->id,
            'nis'=> '0987654321',
            'kelas' => 'XII RPL'
        ]);
    }
}
