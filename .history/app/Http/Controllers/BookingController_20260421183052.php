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
        // 1. Validasi
        $request->validate([
            'lapangan_id' => 'required', // Berisi HARGA (35000, 50000, 70000)
            'tanggal'     => 'required|date',
            'jam'         => 'required',
            'bukti'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Bersihkan input harga
        $hargaInput = trim($request->lapangan_id);
    
        // ==============================================================
        // PENJAGA 1: CEK ALASAN TEKNIS (MANUAL ADMIN)
        // ==============================================================
        // Kita cari data di tabel lapangan yang harganya cocok
        $lapangan = \App\Models\LapanganModel::where('harga', $hargaInput)->first();
    
        if ($lapangan) {
            // Cek jika status bukan 'tersedia' (Berarti 'tutup' atau 'teknis')
            if (trim(strtolower($lapangan->status)) !== 'tersedia') {
                return back()->with('error', 'MAAF: Lapangan ' . $lapangan->nama . ' sedang TUTUP (Alasan Teknis/Maintenance). Silakan pilih lapangan lain.')->withInput();
            }
        }
    
        // ==============================================================
        // PENJAGA 2: CEK JADWAL BENTROK (OTOMATIS BOOKING)
        // ==============================================================
        $isFull = \App\Models\BookingModel::where('lapangan_id', $hargaInput)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->whereIn('status', ['pending', 'approved', 'selesai'])
            ->exists();
    
        if ($isFull) {
            return back()->with('error', 'MAAF: Jadwal tersebut sudah dipesan orang lain. Silakan pilih jam/tanggal lain.')->withInput();
        }
    
        // ==============================================================
        // PROSES SIMPAN JIKA LOLOS SEMUA PENJAGA
        // ==============================================================
        try {
            $path = $request->file('bukti')->store('bukti', 'public');
    
            \App\Models\BookingModel::create([
                'user_id'      => \Illuminate\Support\Facades\Auth::id(),
                'nama_pemesan' => $request->nama_pemesan,
                'lapangan_id'  => $hargaInput, 
                'raket_id'     => $request->raket_id, 
                'tanggal'      => $request->tanggal,
                'jam'          => $request->jam,
                'durasi'       => $request->durasi ?? 1,
                'bukti'        => $path,
                'status'       => 'pending',
            ]);
    
            return redirect('/history')->with('success', 'Booking berhasil disimpan!');
    
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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