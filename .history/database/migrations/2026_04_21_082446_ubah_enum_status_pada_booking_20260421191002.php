<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Ganti 'booking' di bawah ini dengan nama tabel aslimu
        DB::statement("ALTER TABLE booking MODIFY COLUMN status ENUM('pending', 'approved', 'cancel', 'selesai') DEFAULT 'pending'");
    }

    public function down()
    {
        // Ganti 'booking' di bawah ini dengan nama tabel aslimu
        DB::statement("ALTER TABLE booking MODIFY COLUMN status ENUM('pending', 'approved', 'cancel') DEFAULT 'pending'");
    }
};
