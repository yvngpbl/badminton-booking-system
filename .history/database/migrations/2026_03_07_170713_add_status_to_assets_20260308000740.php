<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lapangan', function (Blueprint $table) {
            // Cek dulu apakah kolom status sudah ada atau belum
            if (!Schema::hasColumn('lapangan', 'status')) {
                $table->string('status')->default('tersedia');
            }
        });
    
        // UBAH 'raket' MENJADI 'rakets' (sesuai foto migrasi kamu)
        Schema::table('rakets', function (Blueprint $table) {
            if (!Schema::hasColumn('rakets', 'status')) {
                $table->string('status')->default('tersedia');
            }
        });
    }
    
    public function down(): void
    {
        Schema::table('lapangan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    
        Schema::table('rakets', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
