<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LapanganModel;
use App\Models\RaketModel;
use App\Models\BookingModel;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Catatan Penting: Ganti 'total_harga' dengan nama kolom harga yang ada di database-mu
        // Misalnya jika nama kolomnya 'harga', ubah menjadi ->sum('harga')
    
        $hariIni = BookingModel::withTrashed()
        ->where('status', 'selesai')
        ->whereDate('tanggal', Carbon::today())
        ->sum(DB::raw('lapangan_id + raket_id')); 

$mingguIni = BookingModel::withTrashed()
        ->where('status', 'selesai')
        ->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->sum(DB::raw('lapangan_id + raket_id'));

$bulanIni = BookingModel::withTrashed()
        ->where('status', 'selesai')
        ->whereMonth('tanggal', Carbon::now()->month)
        ->whereYear('tanggal', Carbon::now()->year)
        ->sum(DB::raw('lapangan_id + raket_id'));

return view('admin.DashboardAdmin', compact('hariIni', 'mingguIni', 'bulanIni'));
}
    

        
    

    public function bookings()
    {
        // Mengambil data booking terbaru beserta relasi user dan lapangan
        $bookings = BookingModel::with(['user', 'lapangan'])->latest()->get();
        return view('admin.BookingAdmin', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'notes'  => 'nullable|string|max:255'
        ]);
    
        $booking = BookingModel::findOrFail($id);
        $booking->update([
            'status' => $request->status,
            'notes'  => $request->notes
        ]);
    
        // LOGIKA OTOMATIS: Jika diterima, lapangan jadi 'disewa'
        if ($request->status == 'approved') {
            LapanganModel::where('id', $booking->lapangan_id)->update(['status' => 'disewa']);
        } 
        // Jika selesai atau cancel, lapangan balik jadi 'tersedia'
        elseif (in_array($request->status, ['selesai', 'cancel'])) {
            LapanganModel::where('id', $booking->lapangan_id)->update(['status' => 'tersedia']);
        }
    
        return back()->with('success', 'Booking berhasil diperbarui!');
    }

    public function lapangan()
    {
        $lapangan = \App\Models\LapanganModel::all();
    $raket = \App\Models\RaketModel::all();
        return view('admin.LapanganAdmin', compact('lapangan', 'raket'));
    }

    public function raket()
    {
        $raket = RaketModel::all();
        return view('admin.RaketAdmin', compact('raket'));
    }

    public function updateStatusLapangan(Request $request, $id)
{
    $lapangan = LapanganModel::findOrFail($id);
    $lapangan->update(['status' => $request->status]);
    return back()->with('success', 'Status lapangan diperbarui!');
}

public function updateStatusRaket(Request $request, $id)
{
    $raket = \App\Models\RaketModel::findOrFail($id);
    $raket->update(['status' => $request->status]);

    return back()->with('success', 'Status Raket ' . $raket->nama . ' Diperbarui!');
}
public function lapanganAdmin() // Sesuaikan nama fungsi dengan route kamu
{
    $lapangan = \App\Models\LapanganModel::all(); 
    
    // 2. Ambil data raket dari database (INI YANG SEBELUMNYA TERLEWAT)
    $raket = \App\Models\RaketModel::all(); 

    // 3. Kirim KEDUA variabel tersebut ke view menggunakan compact
    return view('admin.LapanganAdmin', compact('lapangan', 'raket'));
}
public function destroy($id)
{
    $booking = BookingModel::findOrFail($id);
    
    // Ini akan melakukan Soft Delete (hilang dari tabel, tapi tetap di database)
    $booking->delete(); 

    return back()->with('success', 'Data booking berhasil diarsipkan dari tampilan utama!');
}

public function formMaintenance()
    {
        $lapangan = \App\Models\LapanganModel::all();
        return view('admin.MaintenanceAdmin', compact('lapangan'));
    }

    public function simpanMaintenance(Request $request)
    {
        // 1. Cek apakah jadwal tersebut sudah ada yang booking duluan
        $jadwalBentrok = \App\Models\BookingModel::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->whereIn('status', ['pending', 'approved', 'selesai'])
            ->exists();

        if ($jadwalBentrok) {
            return back()->with('error', 'Gagal! Jadwal tersebut sudah ada yang mem-booking atau sudah diblokir sebelumnya.');
        }

        // 2. Simpan "Booking Fiktif" ke database dengan status langsung 'approved'
        \App\Models\BookingModel::create([
            'user_id'      => null, // Bisa dikosongkan untuk admin
            'nama_pemesan' => 'MAINTENANCE / DIBLOKIR ADMIN', // Nama otomatis
            'lapangan_id'  => $request->lapangan_id,
            'raket_id'     => 0, // Tidak sewa raket
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,
            'durasi'       => 1,
            'bukti'        => 'maintenance.jpg', // Bukti fiktif
            'status'       => 'approved', // Langsung dianggap sah sehingga memblokir user lain
            'notes'        => $request->keterangan ?? 'Diblokir oleh Admin'
        ]);

        return redirect('/admin/bookings')->with('success', 'Jadwal pada ' . $request->tanggal . ' jam ' . $request->jam . ' berhasil diblokir!');
    }
}