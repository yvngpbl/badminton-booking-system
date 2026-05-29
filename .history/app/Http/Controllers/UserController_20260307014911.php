<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LapanganModel; // Import model lapangan
use App\Models\BookingModel;  // WAJIB ADA INI BIAR GAK ERROR CLASS NOT FOUND
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function lapangan()
    {
        $lapangan = LapanganModel::all();
        return view('user.lapangan', compact('lapangan'));
    }

    public function history()
    {
        $booking = \App\Models\BookingModel::with('lapangan')->where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
    return view('user.history', compact('booking'));;
    }
}