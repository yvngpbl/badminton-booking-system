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
        // 1. Validasi Input
        $request->validate([
            'lapangan_id' => 'required', // Isinya harga: 35000, 50000, dll
            'tanggal'     => 'required|date',
            'jam'         => 'required',
            'bukti'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $hargaInput = $request->lapangan_id;
    
        // ==============================================================
        // PENJAGA 1: CEK KENDALA TEKNIS (STATUS DARI ADMIN)
        // ==============================================================
        // Mencari data lapangan berdasarkan harga yang dikirim user
        $lapangan = \App\Models\LapanganModel::where('harga', $hargaInput)->first();
    
        if ($lapangan) {
            // Jika status di database adalah 'teknis' atau bukan 'tersedia'
            if (trim(strtolower($lapangan->status)) === 'teknis') {
                return back()->with('error', 'MAAF: Lapangan ' . $lapangan->nama . ' sedang tidak bisa dipesan karena ada kendala teknis.')->withInput();
            }
        }
    
        // ==============================================================
        // PENJAGA 2: CEK JADWAL FULL (SUDAH DIPESAN ORANG)
        // ==============================================================
        $isFull = \App\Models\BookingModel::where('lapangan_id', $hargaInput)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->whereIn('status', ['pending', 'approved', 'selesai'])
            ->exists();
    
        if ($isFull) {
            return back()->with('error', 'MAAF: Jadwal ini sudah penuh dipesan orang lain. Silakan pilih jadwal lain.')->withInput();
        }
    
        // ==============================================================
        // PROSES SIMPAN JIKA LOLOS KEDUA PENJAGA DI ATAS
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
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
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