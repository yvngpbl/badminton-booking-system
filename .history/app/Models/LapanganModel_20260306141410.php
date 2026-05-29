<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapanganModel extends Model
{
    public function bookings()
    {
        protected $fillable = [
            'nama',
            'harga'
        ];
    }
}
