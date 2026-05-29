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

<div class="min-h-screen bg-darkBg pt-10 pb-24 px-4 sm:px-6 lg:px-8 selection:bg-neon selection:text-black relative overflow-hidden">
    
    {{-- Cahaya Glowing di Background --}}
    <div class="absolute top-[20%] left-[-5%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        
        {{-- HEADER DENGAN TOMBOL BLOKIR JADWAL --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 border-b border-white/10 pb-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight uppercase flex items-center">
                    <span class="bg-neon w-2 h-8 rounded-full mr-4 shadow-[0_0_15px_rgba(204,255,0,0.5)]"></span>
                    Manajemen <span class="text-neon ml-2">Booking</span>
                </h2>
                <p class="text-gray-400 mt-2 text-sm tracking-widest uppercase font-semibold">Kelola Persetujuan dan Jadwal Arena</p>
            </div>
            
            <a href="{{ url('/admin/maintenance') }}" class="mt-6 md:mt-0 inline-flex items-center px-6 py-3 bg-white/5 border border-white/10 rounded-full text-white font-bold hover:bg-neon hover:text-black hover:border-neon transition-all duration-300 shadow-[0_0_15px_rgba(204,255,0,0)] hover:shadow-[0_0_20px_rgba(204,255,0,0.3)] uppercase tracking-widest text-xs group">
                <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                Blokir Jadwal (Maintenance)
            </a>
        </div>

        {{-- Notifikasi Sukses / Error --}}
        @if(session('success'))
            <div class="bg-neon/10 border border-neon/30 text-neon px-6 py-4 rounded-2xl mb-8 backdrop-blur-sm shadow-[0_0_15px_rgba(204,255,0,0.1)] flex items-center">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        {{-- TABEL DATA BOOKING --}}
        <div class="bg-darkCard/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden relative">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 border-b border-white/10">
                            <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Pemesan</th>
                            <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Detail Jadwal</th>
                            <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-widest text-center whitespace-nowrap">Bukti</th>
                            <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap min-w-[200px]">Status & Catatan</th>
                            <th class="p-5 text-xs font-bold text-gray-400 uppercase tracking-widest text-center whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($bookings as $b)
                        <tr class="hover:bg-white/5 transition-colors duration-300">
                            
                            {{-- Kolom Pemesan --}}
                            <td class="p-5 align-top">
                                <span class="font-bold text-white block mb-1">{{ $b->nama_pemesan }}</span>
                                @if($b->nama_pemesan == 'MAINTENANCE / DIBLOKIR ADMIN')
                                    <span class="inline-block bg-red-500/20 border border-red-500/50 text-red-500 text-[10px] font-bold px-3 py-1 rounded-full tracking-widest mt-1">SYSTEM</span>
                                @endif
                            </td>
                            
                            {{-- Kolom Detail --}}
                            <td class="p-5 align-top text-sm">
                                <span class="font-bold text-neon block mb-1">{{ $b->lapangan->nama ?? 'Lapangan' }}</span>
                                <span class="text-gray-400 block mb-1">{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }} | {{ $b->jam }} WIB</span>
                                
                                @if($b->nama_pemesan != 'MAINTENANCE / DIBLOKIR ADMIN')
                                    <span class="text-white font-bold bg-white/5 px-2 py-1 rounded mt-1 inline-block text-xs border border-white/10">
                                        Rp {{ number_format($b->total_harga, 0, ',', '.') }}
                                    </span>
                                @endif
                            </td>
                            
                            {{-- Kolom Bukti --}}
                            <td class="p-5 align-top text-center">
                                @if($b->nama_pemesan != 'MAINTENANCE / DIBLOKIR ADMIN')
                                    <a href="{{ asset('storage/'.$b->bukti) }}" target="_blank" class="inline-flex items-center text-neon hover:text-white hover:underline font-bold text-xs bg-neon/10 px-3 py-1.5 rounded-full transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-600 italic text-xs">-</span>
                                @endif
                            </td>
                            
                            {{-- DEKLARASI FORM UPDATE --}}
                            <form action="{{ url('/admin/bookings/'.$b->id.'/update') }}" method="POST" id="update-form-{{ $b->id }}">
                                @csrf
                            </form>

                            {{-- Kolom Status & Catatan --}}
                            <td class="p-5 align-top">
                                <select form="update-form-{{ $b->id }}" name="status" class="w-full p-2.5 bg-[#0a0a0a] text-white border border-white/10 rounded-xl mb-3 text-xs font-bold outline-none focus:border-neon focus:ring-1 focus:ring-neon appearance-none cursor-pointer">
                                    <option value="pending" {{ $b->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="approved" {{ $b->status == 'approved' ? 'selected' : '' }}>✅ Approved (Terima)</option>
                                    <option value="cancel" {{ $b->status == 'cancel' ? 'selected' : '' }}>❌ Cancel (Tolak)</option>
                                    <option value="selesai" {{ $b->status == 'selesai' ? 'selected' : '' }}>🏁 Selesai</option>
                                </select>
                                <input form="update-form-{{ $b->id }}" type="text" name="notes" value="{{ $b->notes }}" 
                                       placeholder="Catatan untuk user..." 
                                       class="w-full p-2.5 bg-[#0a0a0a] text-gray-300 border border-white/10 rounded-xl text-xs outline-none focus:border-neon focus:ring-1 focus:ring-neon placeholder-gray-600">
                            </td>
                            
                            {{-- Kolom Aksi --}}
                            <td class="p-5 align-top text-center min-w-[140px]">
                                <button form="update-form-{{ $b->id }}" type="submit" class="w-full bg-neon text-black hover:bg-lime-400 font-bold py-2.5 px-4 rounded-xl text-xs transition shadow-[0_0_15px_rgba(204,255,0,0.2)] mb-2 tracking-wider uppercase">
                                    Simpan
                                </button>

                                @if($b->status == 'selesai' || $b->nama_pemesan == 'MAINTENANCE / DIBLOKIR ADMIN')
                                <form action="{{ url('/admin/bookings/'.$b->id.'/delete') }}" method="POST" onsubmit="return confirm('Arsipkan data ini dari tabel?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500/10 text-red-500 border border-red-500/30 hover:bg-red-500 hover:text-white font-bold py-2 px-4 rounded-xl text-xs transition uppercase tracking-wider">
                                        Arsipkan
                                    </button>
                                </form>
                                @endif
                            </td>
                            
                        </tr>
                        @endforeach

                        @if($bookings->isEmpty())
                        <tr>
                            <td colspan="5" class="p-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span class="text-gray-500 italic text-lg">Belum ada data booking.</span>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection