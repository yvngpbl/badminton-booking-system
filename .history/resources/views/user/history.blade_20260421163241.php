@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-50 py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
            <span class="bg-indigo-600 w-2 h-8 rounded-full mr-4"></span>
            History Booking
        </h2>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="p-6 text-sm font-bold text-gray-600 uppercase tracking-wider">Nama Pemesan</th>
                            <th class="p-6 text-sm font-bold text-gray-600 uppercase tracking-wider">Lapangan</th>
                            <th class="p-6 text-sm font-bold text-gray-600 uppercase tracking-wider">Tanggal & Jam</th>
                            {{-- Tambahan Kolom Total Bayar --}}
                            <th class="p-6 text-sm font-bold text-gray-600 uppercase tracking-wider">Total Bayar</th>
                            <th class="p-6 text-sm font-bold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="p-6 text-sm font-bold text-gray-600 uppercase tracking-wider">Catatan Admin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($bookings as $b)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="p-6 text-gray-700 font-medium">
                                {{ $b->nama_pemesan }}
                            </td>
                            <td class="p-6 text-gray-700">
                                {{ $b->lapangan->nama_lapangan ?? 'Lapangan' }}
                            </td>
                            <td class="p-6 text-gray-600 whitespace-nowrap">
                                <span class="block font-bold">{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</span>
                                <span class="text-xs text-gray-400">{{ $b->jam }} WIB</span>
                            </td>
                            
                            {{-- Tambahan Data Total Bayar --}}
                            <td class="p-6 whitespace-nowrap">
                                <span class="text-gray-800 font-bold text-md">
                                    Rp {{ number_format($b->lapangan_id + $b->raket_id, 0, ',', '.') }}
                                </span>
                            </td>

                            <td class="p-6">
                                {{-- Penyesuaian pengecekan status agar sinkron dengan Database --}}
                                @if($b->status == 'pending')
                                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-orange-100 text-orange-600 whitespace-nowrap">
                                        Menunggu Konfirmasi
                                    </span>
                                @elseif($b->status == 'approved')
                                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-green-100 text-green-600 whitespace-nowrap">
                                        Booking Disetujui
                                    </span>
                                @elseif($b->status == 'cancel')
                                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-red-100 text-red-600 whitespace-nowrap">
                                        Dibatalkan/Ditolak
                                    </span>
                                @elseif($b->status == 'selesai')
                                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-blue-100 text-blue-600 whitespace-nowrap">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="p-6 text-sm italic text-gray-500">
                                {{ $b->notes ?? '-' }}
                            </td>
                        </tr>
                        @endforeach

                        @if($bookings->isEmpty())
                        <tr>
                            {{-- Colspan diubah jadi 6 karena sekarang ada 6 kolom --}}
                            <td colspan="6" class="p-12 text-center text-gray-400 italic">
                                Belum ada riwayat booking.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-6">
            <a href="{{ url('/booking') }}" class="inline-flex items-center text-indigo-600 font-semibold hover:text-indigo-800 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Tambah Booking Baru
            </a>
        </div>
    </div>
</div>

@endsection