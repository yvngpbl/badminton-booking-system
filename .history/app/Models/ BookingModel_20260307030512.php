<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    // Sesuai screenshot, nama tabel kamu adalah 'booking'
    protected $table = 'booking'; 

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

    public function lapangan() {
        return $this->belongsTo(LapanganModel::class, 'lapangan_id');
    }

    public function raket() {
        return $this->belongsTo(RaketModel::class, 'raket_id');
    }
}