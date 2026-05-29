<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    use HasFactory;

    // Paksa gunakan nama tabel 'booking' sesuai screenshot database kamu
    protected $table = 'booking';

    // Izinkan semua kolom ini diisi
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'raket_id',
        'tanggal',
        'jam',
        'bukti',
        'status',
        'notes'
    ];
}