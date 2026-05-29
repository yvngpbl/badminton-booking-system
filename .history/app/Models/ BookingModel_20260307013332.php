<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    use HasFactory;

    // PERBAIKAN: Menambahkan titik koma (;) yang tadi hilang di baris ini
    protected $table = 'booking'; 

    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tgl_main',
        'jam_mulai',
        'durasi',
        'status'
    ];

    // Relasi ke LapanganModel
    public function lapangan()
    {
        return $this->belongsTo(LapanganModel::class, 'lapangan_id');
    }

    // Tambahkan relasi ke User jika ingin menampilkan nama penyewa di Admin
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}