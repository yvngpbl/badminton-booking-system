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
            'lapangan_id' => 'required', // Ini akan berisi HARGA (sesuai form kamu)
            'tanggal'     => 'required|date',
            'jam'         => 'required',
            'bukti'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // ==============================================================
        // PENJAGA 1: CEK STATUS REAL-TIME (STATUS GLOBAL DARI ADMIN)
        // Karena di form kamu value adalah HARGA, kita cari lapangan berdasarkan harga tersebut
        // ==============================================================
        $cekLapangan = LapanganModel::where('harga', $request->lapangan_id)->first();
        
        if ($cekLapangan && $cekLapangan->status !== 'tersedia') {
            return back()->with('error', 'Maaf, lapangan ini sedang ditutup/penuh secara keseluruhan oleh Admin.')->withInput();
        }

        // Cek status raket jika user menyewa raket (jika value bukan 0)
        if ($request->raket_id != 0) {
            $cekRaket = RaketModel::where('harga', $request->raket_id)->first();
            if ($cekRaket && $cekRaket->status !== 'tersedia') {
                return back()->with('error', 'Maaf, raket yang Anda pilih sedang tidak tersedia saat ini.')->withInput();
            }
        }

        // ==============================================================
        // PENJAGA 2: CEK JADWAL BENTROK (SAMA JAM & TANGGAL)
        // ==============================================================
        $isFull = BookingModel::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->whereIn('status', ['pending', 'approved', 'selesai'])
            ->exists();

        if ($isFull) {
            return back()->with('error', 'Maaf, jadwal tersebut sudah terisi. Silakan pilih jadwal lain.')->withInput();
        }

        try {
            // 2. Proses Upload File
            $path = $request->file('bukti')->store('bukti', 'public');

            // 3. Simpan ke Database
            BookingModel::create([
                'user_id'      => Auth::id(),
                'nama_pemesan' => $request->nama_pemesan,
                'lapangan_id'  => $request->lapangan_id, // Menyimpan Harga
                'raket_id'     => $request->raket_id,    // Menyimpan Harga
                'tanggal'      => $request->tanggal,
                'jam'          => $request->jam,
                'durasi'       => $request->durasi ?? 1,
                'bukti'        => $path,
                'status'       => 'pending',
                'notes'        => null
            ]);

            return redirect('/history')->with('success', 'Booking berhasil disimpan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal simpan ke database: ' . $e->getMessage());
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