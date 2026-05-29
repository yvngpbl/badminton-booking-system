<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LapanganModel;
use App\Models\RaketModel;
use App\Models\BookingModel;
use Carbon\Carbon; 

class AdminController extends Controller
{
    public function dashboard()
    {
        // Memanggil resources/views/admin/DashboardAdmin.blade.php
        return view('admin.DashboardAdmin');

        // withTrashed() digunakan agar data yang sudah di-"Hapus" (Soft Delete) tetap dihitung pendapatannya
    $hariIni = BookingModel::withTrashed()
    ->where('status', 'selesai')
    ->whereDate('created_at', Carbon::today())
    ->sum('total_harga'); // Ganti 'total_harga' dengan kolom hargamu

$mingguIni = BookingModel::withTrashed()
    ->where('status', 'selesai')
    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    ->sum('total_harga');

$bulanIni = BookingModel::withTrashed()
    ->where('status', 'selesai')
    ->whereMonth('created_at', Carbon::now()->month)
    ->whereYear('created_at', Carbon::now()->year)
    ->sum('total_harga');

return view('admin.DashboardAdmin', compact('hariIni', 'mingguIni', 'bulanIni'));
}
        
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
    $lapangan = \App\Models\LapanganModel::all(); // Mengambil data lapangan dari DB
    return view('admin.LapanganAdmin', compact('lapangan'));
}


}