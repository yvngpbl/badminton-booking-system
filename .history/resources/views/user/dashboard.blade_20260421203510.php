@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

{{-- Konfigurasi Warna & Animasi Khusus --}}
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          darkBg: '#050505',
          darkCard: '#121212',
          neon: '#ccff00', // Warna neon lime yang lebih mencolok
        },
        animation: {
          'spin-slow': 'spin 10s linear infinite',
          'blob': 'blob 7s infinite',
        },
        keyframes: {
          blob: {
            '0%': { transform: 'translate(0px, 0px) scale(1)' },
            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
            '100%': { transform: 'translate(0px, 0px) scale(1)' },
          }
        }
      }
    }
  }
</script>

<style>
  /* Efek Teks Transparan bergaris (Stroke) */
  .text-stroke {
    -webkit-text-stroke: 1.5px rgba(255, 255, 255, 0.15);
    color: transparent;
  }
  .text-stroke-neon {
    -webkit-text-stroke: 1px #ccff00;
    color: transparent;
  }
</style>

<div class="bg-darkBg min-h-screen font-sans selection:bg-neon selection:text-black relative overflow-hidden">
    
    {{-- Cahaya Glowing di Background --}}
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-neon/20 rounded-full mix-blend-screen filter blur-[100px] animate-blob"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[30rem] h-[30rem] bg-indigo-600/20 rounded-full mix-blend-screen filter blur-[120px] animate-blob" style="animation-delay: 2s;"></div>

    {{-- 1. BENTO GRID HERO SECTION --}}
    <div class="max-w-7xl mx-auto px-4 md:px-6 pt-12 pb-24 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6">
            
            {{-- Kotak Kiri (Teks Utama) --}}
            <div class="md:col-span-8 bg-darkCard/80 backdrop-blur-xl border border-white/5 rounded-[2.5rem] p-8 md:p-14 flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-20 text-8xl font-black text-stroke pointer-events-none transform translate-x-10 -translate-y-4 group-hover:text-stroke-neon transition duration-700">
                    UNAMA
                </div>
                <div>
                    <div class="inline-block bg-white/10 text-neon px-4 py-2 rounded-full text-xs font-bold tracking-widest uppercase mb-6 border border-white/10 backdrop-blur-md">
                        Pusat Olahraga Premium
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold text-white leading-[1.1] tracking-tight">
                        Badminton <br>
                        <span class="text-neon inline-block mt-2">Arena.</span>
                    </h1>
                </div>
                <div class="mt-12 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <a href="#fasilitas" class="bg-neon text-black px-8 py-4 rounded-full font-bold hover:scale-105 hover:shadow-[0_0_30px_rgba(204,255,0,0.5)] transition-all duration-300 flex items-center group/btn">
                        Lihat Fasilitas 
                        <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <p class="text-gray-400 max-w-sm text-sm leading-relaxed border-l-2 border-white/10 pl-4">
                        Tempat olahraga terbaik menyalurkan bakat. Fasilitas lengkap, lokasi strategis, atmosfer seru.
                    </p>
                </div>
            </div>

            {{-- Kotak Kanan Atas (Statistik Kaca) --}}
            <div class="md:col-span-4 grid grid-cols-2 gap-4 md:gap-6">
                <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-6 flex flex-col justify-center items-center text-center hover:bg-white/10 transition duration-300">
                    <span class="text-4xl md:text-5xl font-black text-white mb-1">08</span>
                    <span class="text-xs text-neon tracking-widest uppercase font-bold">Lapangan</span>
                </div>
                <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-6 flex flex-col justify-center items-center text-center hover:bg-white/10 transition duration-300">
                    <span class="text-4xl md:text-5xl font-black text-white mb-1">20<span class="text-neon">+</span></span>
                    <span class="text-xs text-gray-400 tracking-widest uppercase font-bold">Raket Sewa</span>
                </div>
            </div>

            {{-- Kotak Kanan Bawah (Gambar dengan Efek Hover) --}}
            <div class="md:col-span-4 bg-darkCard rounded-[2.5rem] overflow-hidden relative group min-h-[250px]">
                <img src="{{ asset('images/lapanganatas.jpg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110 group-hover:rotate-2 opacity-80 group-hover:opacity-100" alt="Suasana GOR">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-6 left-6">
                    <span class="text-white font-bold text-lg">Kantin Tersedia</span>
                    <p class="text-neon text-xs">Fasilitas Lengkap</p>
                </div>
            </div>

        </div>
    </div>

    {{-- 2. TENTANG KAMI (Layout Overlap Unik) --}}
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="flex flex-col md:flex-row gap-12 items-center">
            
            {{-- Gambar Kiri dengan Badge Berputar --}}
            <div class="w-full md:w-1/2 relative">
                <div class="rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl relative z-10">
                    <img src="{{ asset('images/tampilan.jpg') }}" alt="Tampilan GOR" class="w-full h-auto object-cover grayscale hover:grayscale-0 transition duration-700">
                </div>
                
                {{-- Lencana Berputar (Spinning Badge) --}}
                <div class="absolute -top-10 -right-10 md:-right-16 z-20 hidden sm:block">
                    <div class="relative flex items-center justify-center w-32 h-32">
                        <svg class="absolute w-full h-full animate-spin-slow text-white" viewBox="0 0 100 100">
                            <defs><path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0"/></defs>
                            <text class="text-[10.5px] font-bold tracking-[0.2em] uppercase" fill="currentColor">
                                <textPath xlink:href="#circle">✦ Professional Arena ✦ Top Quality</textPath>
                            </text>
                        </svg>
                        <div class="w-10 h-10 bg-neon rounded-full flex items-center justify-center text-black shadow-[0_0_20px_rgba(204,255,0,0.5)]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Teks Kanan --}}
            <div class="w-full md:w-1/2 md:pl-10">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Tentang <span class="text-stroke text-white">Arena Kami</span>
                </h2>
                <div class="w-20 h-1 bg-neon mb-8"></div>
                <p class="text-gray-400 leading-relaxed text-lg mb-8 bg-white/5 p-6 rounded-3xl border border-white/5 backdrop-blur-sm">
                    Arena kami hadir dengan standar kualitas yang tinggi untuk memastikan setiap smash dan gerakan Anda maksimal. Dilengkapi dengan pencahayaan yang tidak menyilaukan dan sirkulasi udara yang terjaga.
                </p>
            </div>
        </div>
    </div>

    {{-- 3. FASILITAS (Interactive Cards) --}}
    <div id="fasilitas" class="max-w-7xl mx-auto px-4 md:px-6 py-20 mb-20 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-6xl font-bold text-white mb-4">Fasilitas <span class="text-neon">Unggulan</span></h2>
            <p class="text-gray-500">Kami menyediakan semua kebutuhan pertandingan Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10">
            
            {{-- Card 1 --}}
            <div class="group relative bg-darkCard border border-white/5 rounded-[3rem] p-3 hover:border-neon/50 transition-colors duration-500">
                <div class="absolute inset-0 bg-gradient-to-b from-neon/5 to-transparent opacity-0 group-hover:opacity-100 rounded-[3rem] transition duration-500"></div>
                <div class="relative overflow-hidden rounded-[2.5rem] h-64 md:h-80 mb-6">
                    <img src="{{ asset('images/lapangan.jpg') }}" alt="Lapangan" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute top-4 left-4 bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-full text-sm font-bold border border-white/10">01</div>
                </div>
                <div class="px-6 pb-6 relative z-10">
                    <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-neon transition">Lapangan Standar Pro</h3>
                    <p class="text-gray-400 text-sm">Lantai vinyl interlock dengan peredam kejut untuk melindungi sendi pemain saat melompat dan mengejar bola.</p>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="group relative bg-darkCard border border-white/5 rounded-[3rem] p-3 md:mt-12 hover:border-neon/50 transition-colors duration-500">
                <div class="absolute inset-0 bg-gradient-to-b from-neon/5 to-transparent opacity-0 group-hover:opacity-100 rounded-[3rem] transition duration-500"></div>
                <div class="relative overflow-hidden rounded-[2.5rem] h-64 md:h-80 mb-6">
                    <img src="{{ asset('images/raket.jpg') }}" alt="Koleksi Raket" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute top-4 left-4 bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-full text-sm font-bold border border-white/10">02</div>
                </div>
                <div class="px-6 pb-6 relative z-10">
                    <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-neon transition">Rental & Shop Raket</h3>
                    <p class="text-gray-400 text-sm">Tersedia berbagai pilihan raket dari brand ternama (Yonex, Li-Ning, Victor) baik untuk disewa maupun dibeli.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection