<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    use HasFactory;

    protected $table = 'booking'; // Titik koma wajib ada!

    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tgl_main',
        'jam_mulai',
        'durasi',
        'status'
    ];

    public function lapangan()
    {
        return $this->belongsTo(LapanganModel::class, 'lapangan_id');
    }
}