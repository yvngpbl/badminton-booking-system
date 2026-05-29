<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaketModel extends Model
{
    use HasFactory;

    protected $table = 'rakets'; // Sesuaikan dengan nama tabel raket di database

    protected $fillable = ['nama_raket', 'harga_sewa'];
}