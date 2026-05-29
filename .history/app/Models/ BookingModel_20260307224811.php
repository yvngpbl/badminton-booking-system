<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        
        public function user()
        {
        return $this->belongsTo(User::class, 'user_id');
        }
        
        public function lapangan()
        {
        return $this->belongsTo(LapanganModel::class, 'lapangan_id');
        }
        
        public function raket()
        {
        return $this->belongsTo(RaketModel::class, 'raket_id');
        }
}
