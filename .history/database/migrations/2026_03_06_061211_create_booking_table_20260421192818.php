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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            
            // 1. Definisikan kolom user_id dan lapangan_id (sudah benar)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lapangan_id')->constrained('lapangan')->onDelete('cascade');

            // 2. PERBAIKAN: Buat dulu kolom raket_id baru buat foreign key-nya
            $table->unsignedBigInteger('raket_id')->nullable(); // Buat kolomnya dulu
            $table->foreign('raket_id')->references('id')->on('rakets')->onDelete('set null');

            $table->date('tanggal');
            $table->string('jam');
            $table->integer('durasi');
            $table->integer('total_harga');
            $table->string('bukti')->nullable();
            
            $table->enum('status', ['pending', 'approved', 'cancel', 'selesai'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};