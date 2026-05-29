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
        public function lapangan()
{

$data = Lapangan::all();

return view('admin.lapangan',compact('data'));

}

public function storeLapangan(Request $request)
{

Lapangan::create([
'nama'=>$request->nama,
'harga'=>$request->harga
]);

return back();

}
    }
}
