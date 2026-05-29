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
        // 1. Validasi: Pastikan nama input sesuai dengan form di Blade
        $request->validate([
            'lapangan_id' => 'required',
            'tanggal'     => 'required|date',
            'jam'         => 'required',
            'bukti'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // 2. Proses Upload File ke storage/app/public/bukti
            $path = $request->file('bukti')->store('bukti', 'public');

            // 3. Simpan ke Database
            \App\Models\BookingModel::create([
                'user_id'     => Auth::id(), // Mengambil ID user yang login
                'nama_pemesan' => $request->nama_pemesan,
                'lapangan_id' => $request->lapangan_id,
                'raket_id'    => $request->raket_id, 
                'tanggal'     => $request->tanggal,
                'jam'         => $request->jam,
                'bukti'       => $path,
                'status'      => 'pending',
                'notes'       => null
            ]);

            // 4. Redirect ke history setelah berhasil
            return redirect('/history')->with('success', 'Booking berhasil disimpan!');

        } catch (\Exception $e) {
            // Jika gagal, tampilkan pesan error
            return dd("Gagal simpan ke database: " . $e->getMessage());
        }
    }

    /**
     * Menampilkan Riwayat Booking User
     */
    public function history()
    {
        $bookings = BookingModel::with(['lapangan', 'raket'])
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();
                    
        return view('user.history', compact('bookings'));
    }

    public function storeBooking(Request $request)
{
    // 1. Cek ketersediaan Lapangan di tanggal dan jam yang dipilih
    $lapanganTerpakai = \App\Models\BookingModel::where('lapangan_id', $request->lapangan_id)
        ->where('tanggal', $request->tanggal)
        ->where('jam', $request->jam)
        ->whereIn('status', ['pending', 'approved', 'selesai']) // Status cancel tidak dihitung
        ->exists();

    if ($lapanganTerpakai) {
        return back()->with('error', 'Maaf, lapangan tersebut sudah dipesan pada tanggal dan jam yang Anda pilih. Silakan pilih jadwal lain.')->withInput();
    }

    // 2. (Opsional) Cek ketersediaan Raket jika user menyewa raket
    if ($request->raket_id && $request->raket_id != 0) {
        $raketTerpakai = \App\Models\BookingModel::where('raket_id', $request->raket_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->whereIn('status', ['pending', 'approved', 'selesai'])
            ->exists();

        if ($raketTerpakai) {
            return back()->with('error', 'Maaf, raket tersebut sedang dipinjam orang lain pada jadwal tersebut.')->withInput();
        }
    }

    // 3. Jika aman, lanjutkan proses simpan data booking seperti biasa di bawah ini...
    // BookingModel::create([...]);
    // return redirect(...)->with('success', 'Booking berhasil!');
}
}