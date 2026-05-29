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
          neon: '#ccff00',       /* Hijau Neon (Minggu Ini) */
          neonBlue: '#00f3ff',   /* Biru Neon (Hari Ini) */
          neonPurple: '#b026ff', /* Ungu Neon (Bulan Ini) */
        }
      }
    }
  }
</script>

<div class="min-h-screen bg-darkBg pt-10 pb-24 px-4 sm:px-6 lg:px-8 selection:bg-neon selection:text-black relative overflow-hidden">
    
    {{-- Cahaya Glowing di Background --}}
    <div class="absolute top-[10%] right-[-5%] w-96 h-96 bg-neonBlue/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[10%] left-[-5%] w-96 h-96 bg-neonPurple/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">

        {{-- Header Dashboard --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-white/10 pb-6">
            <div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight uppercase flex items-center">
                    <span class="bg-neon w-2 h-10 rounded-full mr-4 shadow-[0_0_15px_rgba(204,255,0,0.5)]"></span>
                    Dashboard <span class="text-neon ml-3">Admin</span>
                </h2>
                <p class="text-gray-400 mt-3 text-sm tracking-widest uppercase font-semibold">Ringkasan Pendapatan Arena</p>
            </div>
            
            {{-- Tombol Lihat Data Booking (Saya sesuaikan URL-nya agar berfungsi) --}}
            <a href="{{ url('/admin/bookings') }}" class="mt-6 md:mt-0 inline-flex items-center px-6 py-3 bg-white/5 border border-white/10 rounded-full text-white font-bold hover:bg-white hover:text-black hover:border-white transition-all duration-300 shadow-[0_0_15px_rgba(255,255,255,0)] hover:shadow-[0_0_20px_rgba(255,255,255,0.2)] uppercase tracking-widest text-xs group">
                Lihat Data Booking
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        {{-- KOTAK STATISTIK (Grid) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mt-4">
            
            {{-- 1. Pemasukan Hari Ini (Tema Biru Neon) --}}
            <div class="group bg-darkCard/80 backdrop-blur-xl rounded-[2.5rem] p-8 border border-white/10 hover:border-neonBlue/50 transition-all duration-500 relative overflow-hidden shadow-2xl hover:shadow-[0_0_30px_rgba(0,243,255,0.15)]">
                {{-- Aksen Garis Atas --}}
                <div class="absolute top-0 left-0 w-full h-1.5 bg-neonBlue/50 group-hover:bg-neonBlue transition-colors duration-500"></div>
                {{-- Aksen Cahaya Sudut --}}
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-neonBlue/10 rounded-full blur-[30px] group-hover:bg-neonBlue/20 transition-all"></div>
                
                <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-3 text-neonBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Pemasukan Hari Ini
                </h3>
                <p class="text-4xl lg:text-5xl font-black text-white group-hover:text-neonBlue transition-colors duration-500 truncate tracking-tight">
                    <span class="text-xl text-gray-600 font-bold mr-1">Rp</span>{{ number_format($hariIni, 0, ',', '.') }}
                </p>
            </div>

            {{-- 2. Pemasukan Minggu Ini (Tema Hijau Neon - Di-highlight) --}}
            <div class="group bg-darkCard/80 backdrop-blur-xl rounded-[2.5rem] p-8 border border-white/10 hover:border-neon/50 transition-all duration-500 relative overflow-hidden shadow-2xl hover:shadow-[0_0_30px_rgba(204,255,0,0.15)] transform md:-translate-y-4">
                {{-- Aksen Garis Atas --}}
                <div class="absolute top-0 left-0 w-full h-1.5 bg-neon/50 group-hover:bg-neon transition-colors duration-500"></div>
                {{-- Aksen Cahaya Sudut --}}
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-neon/10 rounded-full blur-[30px] group-hover:bg-neon/20 transition-all"></div>
                
                <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-3 text-neon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Pemasukan Minggu Ini
                </h3>
                <p class="text-4xl lg:text-5xl font-black text-white group-hover:text-neon transition-colors duration-500 truncate tracking-tight">
                    <span class="text-xl text-gray-600 font-bold mr-1">Rp</span>{{ number_format($mingguIni, 0, ',', '.') }}
                </p>
            </div>

            {{-- 3. Pemasukan Bulan Ini (Tema Ungu Neon) --}}
            <div class="group bg-darkCard/80 backdrop-blur-xl rounded-[2.5rem] p-8 border border-white/10 hover:border-neonPurple/50 transition-all duration-500 relative overflow-hidden shadow-2xl hover:shadow-[0_0_30px_rgba(176,38,255,0.15)]">
                {{-- Aksen Garis Atas --}}
                <div class="absolute top-0 left-0 w-full h-1.5 bg-neonPurple/50 group-hover:bg-neonPurple transition-colors duration-500"></div>
                {{-- Aksen Cahaya Sudut --}}
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-neonPurple/10 rounded-full blur-[30px] group-hover:bg-neonPurple/20 transition-all"></div>
                
                <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-3 text-neonPurple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Pemasukan Bulan Ini
                </h3>
                <p class="text-4xl lg:text-5xl font-black text-white group-hover:text-neonPurple transition-colors duration-500 truncate tracking-tight">
                    <span class="text-xl text-gray-600 font-bold mr-1">Rp</span>{{ number_format($bulanIni, 0, ',', '.') }}
                </p>
            </div>

        </div>
    </div>
</div>
@endsection