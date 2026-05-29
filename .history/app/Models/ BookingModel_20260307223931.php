<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingModel extends Model
{
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
        
        public function user()
        {
        return $this->belongsTo(User::class);
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
