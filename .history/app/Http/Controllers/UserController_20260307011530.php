<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LapanganModel; // Pastikan ini sesuai dengan nama file di folder Models
use App\Models\Booking;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function lapangan()
    {
        // PERBAIKAN: Nama class harus sama dengan yang di-import di atas (LapanganModel)
        $lapangan = LapanganModel::all(); 
        return view('user.lapangan', compact('lapangan'));
    }

    public function history()
    {
        // Tambahkan with('lapangan') jika nanti ingin menampilkan nama lapangan di riwayat
        $booking = Booking::where('user_id', auth()->id())->get();
        return view('user.history', compact('booking'));
    }
}