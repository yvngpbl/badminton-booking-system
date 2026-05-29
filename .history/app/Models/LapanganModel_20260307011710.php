<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LapanganModel extends Model
{
    use HasFactory;

    // Paksa Laravel menggunakan nama tabel 'lapangan' (bukan lapangan_models)
    protected $table = 'lapangan';

    protected $fillable = [
        'nama',
        'harga',
        'deskripsi'
    ];

    // Relasi agar bisa dipanggil di history
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'lapangan_id');
    }
}