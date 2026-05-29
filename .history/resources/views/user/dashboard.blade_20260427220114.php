@extends('layout')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          'anton': ['Anton', 'sans-serif'],
          'inter': ['Inter', 'sans-serif'],
        },
        colors: {
          brandOrange: '#FF5000', // Oranye yang lebih punchy dan premium
          brandDark: '#0D0F12',   // Hitam kebiruan untuk kesan elegan
          brandGray: '#F3F4F6',
        }
      }
    }
  }
</script>

<style>
  /* Efek teks transparan dengan outline (Stroke Text) untuk Marquee */
  .text-stroke {
    color: transparent;
    -webkit-text-stroke: 1px #e5e7eb;
  }
  .text-stroke-dark {
    color: transparent;
    -webkit-text-stroke: 1px #374151;
  }
</style>

<div class="bg-[#FAFAFA] min-h-screen font-inter selection:bg-brandOrange selection:text-white relative overflow-hidden">
    
    {{-- Latar Belakang Grid Pattern (Kesan Modern Tech/Sport) --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.03]" style="background-image: linear-gradient(#000 1px, transparent 1px), linear-gradient(90deg, #000 1px, transparent 1px); background-size: 32px 32px;"></div>

    {{-- 1. HERO SECTION --}}
    <div class="relative z-10 px-6 pt-20 pb-16 md:pt-32 max-w-[1400px] mx-auto w-full flex flex-col lg:flex-row items-center justify-between gap-12">
        
        {{-- Kiri: Teks Tipografi Massive --}}
        <div class="w-full lg:w-1/2 relative z-20">
            <div class="inline-block bg-brandDark text-white px-4 py-1.5 rounded-full font-bold text-[10px] md:text-xs mb-8 uppercase tracking-[0.2em] shadow-lg">
                <span class="text-brandOrange">●</span> Premium Court
            </div>
            
            <h1 class="font-anton text-[4.5rem] md:text-[6.5rem] lg:text-[7.5rem] text-brandDark uppercase tracking-normal leading-[0.85] mb-6 drop-shadow-sm">
                Badminton <br> 
                <span class="text-brandOrange relative inline-block">
                    Arena
                </span><br>
                UNAMA
            </h1>
            
            <p class="mt-8 text-base md:text-lg text-gray-500 font-medium max-w-md leading-relaxed border-l-2 border-brandOrange pl-6">
                Tempat olahraga terbaik untuk menyalurkan bakat dan hobi. Fasilitas lengkap, lokasi strategis, dan atmosfer pertandingan yang seru.
            </p>
            
            <div class="mt-12 flex flex-wrap items-center gap-6">
                <a href="#fasilitas" class="bg-brandOrange text-white px-8 py-4 rounded-full font-bold hover:bg-orange-600 hover:shadow-[0_10px_30px_rgba(255,80,0,0.4)] hover:-translate-y-1 transition-all duration-300 flex items-center justify-center uppercase tracking-widest text-sm">
                    Lihat Fasilitas
                </a>
                <div class="flex items-center gap-3 text-sm font-bold text-brandDark uppercase tracking-widest">
                    <span class="w-10 h-[2px] bg-gray-300"></span> Scroll Down
                </div>
            </div>
        </div>

        {{-- Kanan: Gambar Hero Asimetris dengan Statistik Mengambang --}}
        <div class="w-full lg:w-1/2 relative mt-12 lg:mt-0">
            {{-- Aksen Latar Belakang Oranye --}}
            <div class="absolute -top-6 -right-6 w-full h-full bg-brandOrange rounded-[2.5rem] opacity-20 transform rotate-3 z-0"></div>
            
            <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl h-[400px] md:h-[600px] border-[6px] border-white group">
                <img src="{{ asset('images/lapanganatas.jpg') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="Suasana GOR">
                <div class="absolute inset-0 bg-gradient-to-t from-brandDark/80 via-transparent to-transparent opacity-80 pointer-events-none"></div>
            </div>

            {{-- Statistik Mengambang (Floating Glassmorphism Box) --}}
            <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2 lg:-translate-x-10 w-[90%] md:w-[450px] bg-brandDark/95 backdrop-blur-md rounded-2xl p-6 border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.3)] z-30 flex justify-between items-center divide-x divide-gray-700">
                <div class="px-4 text-center group w-1/3">
                    <div class="text-3xl font-black text-white group-hover:text-brandOrange transition-colors">08+</div>
                    <div class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mt-1">Lapangan</div>
                </div>
                <div class="px-4 text-center group w-1/3">
                    <div class="text-3xl font-black text-white group-hover:text-brandOrange transition-colors">20+</div>
                    <div class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mt-1">Raket Sewa</div>
                </div>
                <div class="px-4 text-center group w-1/3">
                    <div class="text-3xl font-black text-white group-hover:text-brandOrange transition-colors">01</div>
                    <div class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mt-1">Kantin</div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. TENTANG KAMI SECTION (Dengan Watermark Teks Raksasa) --}}
    <div class="max-w-[1400px] mx-auto px-6 py-32 mt-10 relative z-10 overflow-hidden">
        {{-- Watermark Background --}}
        <div class="absolute top-1/2 left-0 transform -translate-y-1/2 font-anton text-[12rem] text-stroke opacity-30 whitespace-nowrap pointer-events-none -z-10">
            THE ARENA THE ARENA
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-16 items-center">
            <div class="md:col-span-5 relative">
                <div class="aspect-[4/5] rounded-[2rem] overflow-hidden shadow-2xl relative z-10 border-[6px] border-white">
                    <img src="{{ asset('images/tampilan.jpg') }}" alt="Tampilan GOR" class="w-full h-full object-cover">
                </div>
                {{-- Label Oranye --}}
                <div class="absolute -bottom-8 -right-8 bg-brandOrange text-white p-6 md:p-8 rounded-[1.5rem] font-black text-sm tracking-widest z-20 shadow-[0_15px_30px_rgba(255,80,0,0.3)] w-[200px] md:w-[240px] uppercase leading-snug">
                    A Professional <br><span class="text-brandDark">Badminton Arena</span>
                    <div class="mt-4 flex justify-end">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-7 md:pl-12">
                <h2 class="font-anton text-5xl md:text-6xl lg:text-7xl text-brandDark uppercase mb-6 leading-[0.9]">
                    Tentang <br> <span class="text-gray-300">Arena Kami</span>
                </h2>
                <div class="w-24 h-2 bg-brandOrange mb-10"></div>
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_10px_40px_rgba(0,0,0,0.04)] border border-gray-100">
                    <p class="text-gray-600 font-medium leading-relaxed text-lg mb-6">
                        Arena kami hadir dengan standar kualitas yang tinggi untuk memastikan setiap smash dan gerakan Anda maksimal. Dilengkapi dengan pencahayaan yang tidak menyilaukan dan sirkulasi udara yang terjaga.
                    </p>
                    <p class="text-sm font-bold text-brandDark uppercase tracking-widest border-t border-gray-100 pt-6">Experience the difference</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. FASILITAS SECTION (Dark Premium Dashboard Feel) --}}
    <div id="fasilitas" class="w-full bg-brandDark pt-24 pb-12 relative z-10 rounded-t-[3rem] md:rounded-t-[5rem] overflow-hidden">
        
        {{-- Pola Latar Belakang Mode Gelap --}}
        <div class="absolute inset-0 z-0 pointer-events-none opacity-10" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="max-w-[1400px] mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                
                {{-- Bagian Kiri: Header & Interaktif List --}}
                <div class="lg:col-span-5 flex flex-col justify-center">
                    <div class="inline-block border border-gray-700 bg-gray-800/50 text-gray-300 px-4 py-2 rounded-full font-bold text-[10px] mb-6 uppercase tracking-[0.2em] self-start">
                        <span class="text-brandOrange mr-2">✦</span> Fasilitas Unggulan
                    </div>
                    
                    <h2 class="font-anton text-4xl md:text-6xl text-white mb-6 leading-[0.9] uppercase">
                        Kebutuhan <br><span class="text-gray-600">Pertandingan</span> Anda
                    </h2>
                    <p class="text-gray-400 mb-12 text-sm font-medium max-w-sm">Dengan standar profesional untuk kenyamanan maksimal saat berlatih maupun bertanding.</p>
                    
                    <div class="space-y-4">
                        {{-- List 1 (Premium Dashboard Row) --}}
                        <div class="group bg-[#15181E] border border-gray-800 p-6 rounded-2xl hover:border-brandOrange hover:bg-[#1A1E24] hover:-translate-y-1 transition-all duration-300 cursor-default shadow-lg flex flex-col gap-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-gray-800 group-hover:bg-brandOrange flex items-center justify-center transition-colors">
                                        <span class="font-black text-white text-sm">01</span>
                                    </div>
                                    <span class="font-bold text-white text-lg uppercase tracking-wide">Lapangan Standar Pro</span>
                                </div>
                                <div class="w-8 h-8 rounded-full border border-gray-700 group-hover:border-brandOrange flex items-center justify-center transition-colors">
                                    <span class="text-gray-500 group-hover:text-brandOrange transition-colors text-sm">↗</span>
                                </div>
                            </div>
                            <p class="pl-14 pr-4 text-sm text-gray-400 font-medium leading-relaxed">Lantai vinyl interlock dengan peredam kejut untuk melindungi sendi pemain saat melompat dan mengejar bola.</p>
                        </div>
                        
                        {{-- List 2 --}}
                        <div class="group bg-[#15181E] border border-gray-800 p-6 rounded-2xl hover:border-brandOrange hover:bg-[#1A1E24] hover:-translate-y-1 transition-all duration-300 cursor-default shadow-lg flex flex-col gap-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-gray-800 group-hover:bg-brandOrange flex items-center justify-center transition-colors">
                                        <span class="font-black text-white text-sm">02</span>
                                    </div>
                                    <span class="font-bold text-white text-lg uppercase tracking-wide">Rental & Shop Raket</span>
                                </div>
                                <div class="w-8 h-8 rounded-full border border-gray-700 group-hover:border-brandOrange flex items-center justify-center transition-colors">
                                    <span class="text-gray-500 group-hover:text-brandOrange transition-colors text-sm">↗</span>
                                </div>
                            </div>
                            <p class="pl-14 pr-4 text-sm text-gray-400 font-medium leading-relaxed">Tersedia berbagai pilihan raket dari brand ternama (Yonex, Li-Ning, Victor) baik untuk disewa maupun dibeli.</p>
                        </div>
                    </div>
                </div>
                
                {{-- Bagian Kanan: Foto Grid dengan Styling Premium --}}
                <div class="lg:col-span-7 relative h-full min-h-[500px]">
                    <div class="absolute top-0 right-0 w-[80%] h-[60%] rounded-[2rem] overflow-hidden border border-gray-800 shadow-2xl z-10 group">
                        <img src="{{ asset('images/lapangan.jpg') }}" alt="Lapangan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="absolute bottom-0 left-0 w-[65%] h-[55%] rounded-[2rem] overflow-hidden border-[8px] border-brandDark shadow-2xl z-20 group">
                        <img src="{{ asset('images/raket.jpg') }}" alt="Koleksi Raket" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    
                    {{-- Aksen Tombol Play/Explore --}}
                    <div class="absolute top-[45%] left-[30%] transform -translate-x-1/2 -translate-y-1/2 bg-brandOrange text-white w-20 h-20 rounded-full flex items-center justify-center shadow-[0_10px_30px_rgba(255,80,0,0.5)] z-30 border-[6px] border-brandDark hover:scale-110 cursor-pointer transition-transform">
                        <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
                
            </div>
        </div>
        
        {{-- Marquee Text (Gaya Super Modern dengan Stroke) --}}
        <div class="mt-32 w-full border-t border-gray-800 bg-[#0A0C0F] py-6 overflow-hidden whitespace-nowrap flex items-center">
            <h2 class="font-anton text-[4rem] md:text-[6rem] tracking-wider uppercase inline-block animate-[pulse_4s_ease-in-out_infinite] leading-none">
                <span class="text-white">SMASH</span> <span class="text-brandOrange text-4xl align-middle mx-8">✦</span> 
                <span class="text-stroke-dark">DEFEND</span> <span class="text-brandOrange text-4xl align-middle mx-8">✦</span> 
                <span class="text-white">WIN</span> <span class="text-brandOrange text-4xl align-middle mx-8">✦</span>
                <span class="text-stroke-dark">SMASH</span> <span class="text-brandOrange text-4xl align-middle mx-8">✦</span> 
                <span class="text-white">DEFEND</span>
            </h2>
        </div>
    </div>
</div>
@endsection