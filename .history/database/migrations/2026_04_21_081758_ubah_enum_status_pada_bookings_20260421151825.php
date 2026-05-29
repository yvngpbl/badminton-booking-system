<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Mengubah tipe enum menggunakan raw query DB agar lebih aman
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'approved', 'cancel', 'selesai') DEFAULT 'pending'");
    }

    public function down()
    {
        // Kembalikan ke asal jika di-rollback
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'approved', 'cancel') DEFAULT 'pending'");
    }
};
