<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaketModel extends Model
{
    protected $fillable = [
        'nama',
        'stok',
        'harga'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
