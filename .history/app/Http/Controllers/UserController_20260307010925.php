<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan daftar lapangan yang tersedia untuk user.
     */
    public function index()
    {
        $lapangans = Lapangan::all();
        return view('user.dashboard', compact('lapangans'));
    }

    /**
     * Menampilkan detail lapangan tertentu.
     */
    public function show($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('user.detail_lapangan', compact('lapangan'));
    }

    /**
     * Menyimpan data booking dari user ke database.
     */
    public function storeBooking(Request $request)
    {
        // Validasi input
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'tgl_main'    => 'required|date|after_or_equal:today',
            'jam_mulai'   => 'required',
            'durasi'      => 'required|integer|min:1',
        ]);

        // Simpan data booking
        Booking::create([
            'user_id'     => Auth::id(), // Mengambil ID user yang sedang login
            'lapangan_id' => $request->lapangan_id,
            'tgl_main'    => $request->tgl_main,
            'jam_mulai'   => $request->jam_mulai,
            'durasi'      => $request->durasi,
            'status'      => 'pending', // Status awal booking
        ]);

        return redirect()->route('user.history')
                         ->with('success', 'Booking berhasil diajukan! Menunggu konfirmasi admin.');
    }
}