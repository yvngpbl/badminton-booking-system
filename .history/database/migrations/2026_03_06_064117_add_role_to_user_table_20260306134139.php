<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Menambahkan kolom role setelah kolom password
        // Default kita set 'user' agar pendaftar biasa otomatis jadi user
        $table->string('role')->default('user')->after('password');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}
