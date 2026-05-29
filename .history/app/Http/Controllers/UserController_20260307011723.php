<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LapanganModel; // Pastikan nama ini sinkron
use App\Models\Booking;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function lapangan()
    {
        // Memanggil class yang benar: LapanganModel
        $lapangan = LapanganModel::all(); 
        return view('user.lapangan', compact('lapangan'));
    }

    public function history()
    {
        // Mengambil riwayat booking user yang sedang login
        $booking = Booking::with('lapangan')->where('user_id', auth()->id())->get();
        return view('user.history', compact('booking'));
    }
}