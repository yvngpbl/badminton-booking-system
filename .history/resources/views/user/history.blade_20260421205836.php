@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          darkBg: '#050505',
          darkCard: '#111111',
          neon: '#ccff00',
        }
      }
    }
  }
</script>

<div class="min-h-screen bg-darkBg py-12 px-4 selection:bg-neon selection:text-black relative overflow-hidden pt-10 pb-24">
    
    {{-- Cahaya Glowing di Background --}}
    <div class="absolute top-[10%] right-[-10%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        
        {{-- Header History --}}
        <div class="mb-10">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight uppercase flex items-center">
                <span class="bg-neon w-2 h-10 rounded-full mr-4 shadow-[0_0_15px_rgba(204,255,0,0.5)]"></span>
                Riwayat <span class="text-neon ml-3">Booking</span>
            </h2>
        </div>

        {{-- Tabel Glassmorphism --}}
        <div class="bg-darkCard/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-[50px] pointer-events-none"></div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 border-b border-white/10">
                            <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Nama Pemesan</th>
                            <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Lapangan</th>
                            <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Tanggal & Jam</th>
                            <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Total Bayar</th>
                            <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Status</th>
                            <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Catatan Admin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($bookings as $b)
                        <tr class="hover:bg-white/5 transition-colors duration-300 group">
                            <td class="p-6 text-white font-medium">
                                {{ $b->nama_pemesan }}
                            </td>
                            <td class="p-6 text-gray-300 font-bold group-hover:text-white transition-colors">
                                {{-- PERBAIKAN 1: nama_lapangan diganti jadi nama --}}
                                {{ $b->lapangan->nama ?? 'Lapangan' }}
                            </td>
                            <td class="p-6 text-gray-400 whitespace-nowrap">
                                <span class="block font-bold text-white">{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</span>
                                <span class="text-xs text-neon tracking-wider">{{ $b->jam }} WIB</span>
                            </td>
                            
                            <td class="p-6 whitespace-nowrap">
                                <span class="text-white font-bold text-lg">
                                    {{-- PERBAIKAN 2: Menggunakan kolom total_harga dari database --}}
                                    Rp {{ number_format($b->total_harga, 0, ',', '.') }}
                                </span>
                            </td>

                            <td class="p-6">
                                @if($b->status == 'pending')
                                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-orange-500/10 border border-orange-500/30 text-orange-400 whitespace-nowrap shadow-[0_0_10px_rgba(249,115,22,0.1)]">
                                        Menunggu Konfirmasi
                                    </span>
                                @elseif($b->status == 'approved')
                                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-neon/10 border border-neon/30 text-neon whitespace-nowrap shadow-[0_0_10px_rgba(204,255,0,0.1)]">
                                        Booking Disetujui
                                    </span>
                                @elseif($b->status == 'cancel')
                                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-red-500/10 border border-red-500/30 text-red-400 whitespace-nowrap shadow-[0_0_10px_rgba(239,68,68,0.1)]">
                                        Dibatalkan/Ditolak
                                    </span>
                                @elseif($b->status == 'selesai')
                                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-blue-500/10 border border-blue-500/30 text-blue-400 whitespace-nowrap shadow-[0_0_10px_rgba(59,130,246,0.1)]">
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
                            <td colspan="6" class="p-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span class="text-gray-500 italic text-lg">Belum ada riwayat booking.</span>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-10 text-center md:text-left">
            <a href="{{ url('/booking') }}" class="inline-flex items-center px-8 py-4 bg-white/5 border border-white/10 rounded-full text-white font-bold hover:bg-neon hover:text-black hover:border-neon transition-all duration-300 shadow-[0_0_15px_rgba(204,255,0,0)] hover:shadow-[0_0_20px_rgba(204,255,0,0.3)] uppercase tracking-widest text-sm group">
                <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Tambah Booking Baru
            </a>
        </div>
    </div>
</div>

@endsection