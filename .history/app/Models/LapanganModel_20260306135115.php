<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapanganModel extends Model
{
    protected $fillable = [
        'nama',
        'harga'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
