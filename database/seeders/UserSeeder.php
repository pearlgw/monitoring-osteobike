<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'kode_pasien' => null,
                'nama_lengkap' => 'Admin Osteobike',
                'email' => 'osteobike@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'umur' => null,
                'alamat' => null,
                'jenis_kelamin' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'kode_pasien' => 'PSN001',
                'nama_lengkap' => 'Budi Santoso',
                'email' => null,
                'password' => null,
                'role' => 'pasien',
                'umur' => 25,
                'alamat' => 'Semarang',
                'jenis_kelamin' => 'Pria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'kode_pasien' => 'PSN002',
                'nama_lengkap' => 'Siti Aisyah',
                'email' => null,
                'password' => null,
                'role' => 'pasien',
                'umur' => 30,
                'alamat' => 'Jakarta',
                'jenis_kelamin' => 'Wanita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'kode_pasien' => 'PSN003',
                'nama_lengkap' => 'Andi Wijaya',
                'email' => null,
                'password' => null,
                'role' => 'pasien',
                'umur' => 28,
                'alamat' => 'Bandung',
                'jenis_kelamin' => 'Pria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'kode_pasien' => 'PSN004',
                'nama_lengkap' => 'Dewi Lestari',
                'email' => null,
                'password' => null,
                'role' => 'pasien',
                'umur' => 35,
                'alamat' => 'Surabaya',
                'jenis_kelamin' => 'Wanita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
