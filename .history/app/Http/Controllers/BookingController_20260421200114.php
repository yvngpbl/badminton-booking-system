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
        'lapangan_id' => 'required',
        'tanggal'     => 'required|date',
        'jam'         => 'required',
        'durasi'      => 'required', 
        'bukti'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $inputLapangan = $request->lapangan_id;
    $inputRaket = $request->raket_id ?? 0;
    $durasi = $request->durasi;

    // --- CARI DATA LAPANGAN DULU ---
    // Perbaikan: Pakai orWhere agar aman kalau form mengirim ID (1) atau Harga (35000)
    $lapangan = \App\Models\LapanganModel::where('id', $inputLapangan)
                ->orWhere('harga', $inputLapangan)
                ->first();

    if (!$lapangan) {
        return back()->with('error', 'Data lapangan tidak ditemukan.')->withInput();
    }
    if (trim(strtolower($lapangan->status)) === 'teknis') {
        return back()->with('error', 'Lapangan sedang ada kendala teknis.')->withInput();
    }

    // --- CARI DATA RAKET DULU ---
    $idRaketAsli = null; 
    $hargaRaketAsli = 0; // Default jika tidak sewa

    if ($inputRaket > 0) {
        $raket = \App\Models\RaketModel::where('id', $inputRaket)
                ->orWhere('harga', $inputRaket)
                ->first();
        if ($raket) {
            $idRaketAsli = $raket->id;
            $hargaRaketAsli = $raket->harga; // Ambil harga asli
        }
    }

    // --- PERBAIKAN: Hitung Total Harga MENGGUNAKAN DATA DATABASE ---
    // (Harga Asli Lapangan + Harga Asli Raket) * Durasi
    $totalHarga = ($lapangan->harga + $hargaRaketAsli) * $durasi;

    try {
        // 2. Proses Upload File
        $path = $request->file('bukti')->store('bukti', 'public');

        // 3. Simpan ke Database
        \App\Models\BookingModel::create([
            'user_id'      => \Illuminate\Support\Facades\Auth::id(),
            'nama_pemesan' => $request->nama_pemesan,
            
            'lapangan_id'  => $lapangan->id,     // Aman
            'raket_id'     => $idRaketAsli,      // Aman
            
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,
            'durasi'       => $durasi,
            'total_harga'  => $totalHarga,       // Sekarang PASTI akurat!
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