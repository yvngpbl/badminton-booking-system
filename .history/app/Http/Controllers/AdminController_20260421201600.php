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
        // LOGIKA BARU: 
        // 1. Hanya hitung status 'selesai' atau 'approved'
        // 2. SEKARANG LANGSUNG AMBIL DARI KOLOM total_harga
    
        $statusSah = ['approved', 'selesai'];

        $hariIni = BookingModel::whereIn('status', $statusSah)
            ->whereDate('tanggal', Carbon::today())
            ->sum('total_harga'); // <-- PERBAIKAN DI SINI

        $mingguIni = BookingModel::whereIn('status', $statusSah)
            ->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total_harga'); // <-- PERBAIKAN DI SINI

        $bulanIni = BookingModel::whereIn('status', $statusSah)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('total_harga'); // <-- PERBAIKAN DI SINI

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
        $lapangan = \App\Models\LapanganModel::find($id);

        if ($lapangan) {
            // 2. Update kolom status dengan nilai dari <select>
            $lapangan->status = $request->status;
            $lapangan->save();

            return back()->with('success', 'Status lapangan berhasil diupdate ke database!');
        }

        return back()->with('error', 'Lapangan tidak ditemukan.');
    }

    public function updateStatusRaket(Request $request, $id)
    {
        $raket = \App\Models\RaketModel::findOrFail($id);
        $raket->update(['status' => $request->status]);

        return back()->with('success', 'Status Raket ' . $raket->nama . ' Diperbarui!');
    }

    public function lapanganAdmin() 
    {
        $lapangan = \App\Models\LapanganModel::all(); 
        $raket = \App\Models\RaketModel::all(); 
        return view('admin.LapanganAdmin', compact('lapangan', 'raket'));
    }

    public function destroy($id)
    {
        $booking = BookingModel::findOrFail($id);
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
        // Cek apakah jadwal tersebut sudah ada yang booking duluan
        $jadwalBentrok = \App\Models\BookingModel::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->whereIn('status', ['pending', 'approved', 'selesai'])
            ->exists();

        if ($jadwalBentrok) {
            return back()->with('error', 'Gagal! Jadwal tersebut sudah ada yang mem-booking.');
        }

        // Simpan "Booking Fiktif" ke database 
        \App\Models\BookingModel::create([
            'user_id'      => null, 
            'nama_pemesan' => 'MAINTENANCE / DIBLOKIR ADMIN', 
            'lapangan_id'  => $request->lapangan_id,
            'raket_id'     => null, // <-- PERBAIKAN: Harus null (bukan 0) agar tidak error database
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,
            'durasi'       => 1,
            'total_harga'  => 0,    // <-- PERBAIKAN: Kolom ini wajib diisi sekarang
            'bukti'        => 'maintenance.jpg', 
            'status'       => 'approved', 
            'notes'        => $request->keterangan ?? 'Diblokir oleh Admin'
        ]);

        return redirect('/admin/bookings')->with('success', 'Jadwal berhasil diblokir!');
    }
}