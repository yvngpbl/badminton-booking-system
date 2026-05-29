<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    public function run()
    {
        // GANTI 'lapangans' sesuai dengan nama tabel di migration/phpMyAdmin kamu
        $tabelLapangan = 'lapangans'; 
        $tabelRaket = 'rakets';

        // Bersihkan data lama
        DB::table($tabelLapangan)->truncate();
        DB::table($tabelRaket)->truncate();

        // Isi Data Lapangan
        DB::table($tabelLapangan)->insert([
            ['id' => 1, 'nama' => 'Lapangan Semen Flat', 'harga' => 35000, 'status' => 'tersedia'],
            ['id' => 2, 'nama' => 'Vinyl Interlock Pro', 'harga' => 50000, 'status' => 'tersedia'],
            ['id' => 3, 'nama' => 'BWF Premium Arena', 'harga' => 70000, 'status' => 'tersedia'],
        ]);

        // Isi Data Raket
        DB::table($tabelRaket)->insert([
            ['id' => 1, 'nama' => 'Raket Carbon Frame', 'harga' => 10000, 'status' => 'tersedia'],
            ['id' => 2, 'nama' => 'Li-Ning G-Force', 'harga' => 15000, 'status' => 'tersedia'],
            ['id' => 3, 'nama' => 'Victor Thruster K', 'harga' => 20000, 'status' => 'tersedia'],
            ['id' => 4, 'nama' => 'Yonex Astrox 88D Pro', 'harga' => 25000, 'status' => 'tersedia'],
        ]);
    }
}