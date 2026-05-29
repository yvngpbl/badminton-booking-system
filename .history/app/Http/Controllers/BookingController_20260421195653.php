<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LapanganModel;
use App\Models\RaketModel;
use App\Models\BookingModel; 
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan Form Booking
     */
    public function bookingForm()
    {
        $lapangan = LapanganModel::all();
        $raket = RaketModel::all();
        return view('user.booking', compact('lapangan', 'raket'));
    }

    /**
     * Memproses Data Booking ke Database
     */
    public function booking(Request $request)
{
    $request->validate([
        'lapangan_id' => 'required',
        'tanggal'     => 'required|date',
        'jam'         => 'required',
        'durasi'      => 'required', 
        'bukti'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // 1. CARI DATA ASLI DARI DATABASE BERDASARKAN ID YANG DIKIRIM FORM
    $lapangan = \App\Models\LapanganModel::find($request->lapangan_id);
    
    if (!$lapangan) {
        return back()->with('error', 'Data lapangan tidak ditemukan.');
    }

    // 2. CEK RAKET (JIKA SEWA)
    $hargaRaket = 0;
    $idRaketAsli = null;
    if ($request->raket_id > 0) {
        $raket = \App\Models\RaketModel::find($request->raket_id);
        if ($raket) {
            $hargaRaket = $raket->harga;
            $idRaketAsli = $raket->id;
        }
    }

    // 3. HITUNG TOTAL HARGA YANG BENAR (Harga Asli Lapangan + Harga Asli Raket) * Durasi
    $totalHarga = ($lapangan->harga + $hargaRaket) * $request->durasi;

    try {
        $path = $request->file('bukti')->store('bukti', 'public');

        \App\Models\BookingModel::create([
            'user_id'      => \Illuminate\Support\Facades\Auth::id(),
            'nama_pemesan' => $request->nama_pemesan,
            'lapangan_id'  => $lapangan->id, 
            'raket_id'     => $idRaketAsli,      
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,
            'durasi'       => $request->durasi,
            'total_harga'  => $totalHarga, // Sekarang pasti nominal aslinya!
            'bukti'        => $path,
            'status'       => 'pending',
        ]);

        return redirect('/history')->with('success', 'Booking berhasil!');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal: ' . $e->getMessage());
    }
}

    /**
     * Menampilkan Riwayat Booking User
     */
    public function history()
    {
        $bookings = BookingModel::where('user_id', Auth::id())
                    ->latest()
                    ->get();
                    
        return view('user.history', compact('bookings'));
    }

    /**
     * Fitur Maintenance Admin
     */
    public function formMaintenance()
    {
        $lapangan = LapanganModel::all();
        return view('admin.MaintenanceAdmin', compact('lapangan'));
    }

    public function simpanMaintenance(Request $request)
    {
        // Penjaga untuk admin agar tidak memblokir jadwal yang sudah ada isinya
        $jadwalBentrok = BookingModel::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->whereIn('status', ['pending', 'approved', 'selesai'])
            ->exists();

        if ($jadwalBentrok) {
            return back()->with('error', 'Gagal! Jadwal tersebut sudah ada yang mem-booking.');
        }

        BookingModel::create([
            'user_id'      => null, 
            'nama_pemesan' => 'MAINTENANCE / DIBLOKIR ADMIN', 
            'lapangan_id'  => $request->lapangan_id,
            'raket_id'     => 0, 
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,
            'durasi'       => 1,
            'bukti'        => 'maintenance.jpg',
            'status'       => 'approved', 
            'notes'        => $request->keterangan ?? 'Diblokir oleh Admin'
        ]);

        return redirect('/admin/bookings')->with('success', 'Jadwal berhasil diblokir!');
    }
}