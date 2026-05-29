<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    public function run()
{

    public function run(): void
{
    $this->call([
        AdminSeeder::class,
        FasilitasSeeder::class,
    ]);
}
    // MATIKAN cek foreign key sementara agar bisa menghapus data
    \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

    \Illuminate\Support\Facades\DB::table('lapangan')->truncate();
    \Illuminate\Support\Facades\DB::table('rakets')->truncate();

    // Isi Data Lapangan
    \Illuminate\Support\Facades\DB::table('lapangan')->insert([
        ['id' => 1, 'nama' => 'Lapangan Semen Flat', 'harga' => 35000, 'status' => 'tersedia'],
        ['id' => 2, 'nama' => 'Vinyl Interlock Pro', 'harga' => 50000, 'status' => 'tersedia'],
        ['id' => 3, 'nama' => 'BWF Premium Arena', 'harga' => 70000, 'status' => 'tersedia'],
    ]);

    // Isi Data Raket
    // Isi Data Raket
\Illuminate\Support\Facades\DB::table('rakets')->insert([
    ['id' => 1, 'nama' => 'Raket Carbon Frame', 'harga' => 10000, 'status' => 'tersedia', 'stok' => 5],
    ['id' => 2, 'nama' => 'Li-Ning G-Force', 'harga' => 15000, 'status' => 'tersedia', 'stok' => 5],
    ['id' => 3, 'nama' => 'Victor Thruster K', 'harga' => 20000, 'status' => 'tersedia', 'stok' => 5],
    ['id' => 4, 'nama' => 'Yonex Astrox 88D Pro', 'harga' => 25000, 'status' => 'tersedia', 'stok' => 5],
]);


    // HIDUPKAN KEMBALI cek foreign key
    \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
}
}