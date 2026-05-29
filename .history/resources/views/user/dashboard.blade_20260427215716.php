@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
{{-- Konfigurasi warna diselaraskan dengan seluruh sistem (DarkBg & Neon baru) --}}
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

<div class="bg-darkBg min-h-screen font-sans selection:bg-neon selection:text-black relative overflow-hidden">
    
    {{-- Cahaya Glowing di Background agar selaras dengan halaman lain --}}
    <div class="absolute top-[-5%] left-[-5%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    {{-- 1. HERO SECTION (Diubah dari putih menjadi Dark Card elegan) --}}
    <div class="bg-darkCard border-b border-white/10 rounded-b-[3rem] md:rounded-b-[5rem] overflow-hidden relative px-6 pt-24 pb-32 shadow-[0_10px_50px_rgba(0,0,0,0.5)]">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight leading-tight mb-6">
                Badminton Arena <br> 
                <span class="text-neon relative inline-block mt-2">
                    UNAMA
                    <svg class="absolute w-full h-4 -bottom-2 left-0 text-white/20" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none"/></svg>
                </span>
            </h1>
            <p class="mt-8 text-lg text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                Tempat olahraga terbaik untuk menyalurkan bakat dan hobi. Fasilitas lengkap, lokasi strategis, dan atmosfer pertandingan yang seru.
            </p>
            <div class="mt-10 flex justify-center">
                <a href="#fasilitas" class="bg-neon text-black px-8 py-4 rounded-full font-bold hover:bg-lime-400 hover:scale-105 transition-all duration-300 shadow-[0_0_20px_rgba(204,255,0,0.4)] flex items-center justify-center inline-flex uppercase tracking-widest text-sm">
                    Lihat Fasilitas
                </a>
            </div>
        </div>

        {{-- Gambar Hero Floating --}}
        <div class="mt-16 max-w-5xl mx-auto rounded-[3rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 h-[300px] md:h-[500px] relative group">
            <img src="{{ asset('images/lapanganatas.jpg') }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 grayscale hover:grayscale-0" alt="Suasana GOR">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent pointer-events-none"></div>
            <div class="absolute bottom-6 left-6 bg-neon text-black px-6 py-3 rounded-full font-bold text-sm shadow-[0_0_15px_rgba(204,255,0,0.5)] flex items-center z-10">
                <span class="w-2 h-2 rounded-full bg-black mr-3 animate-ping"></span> Start Your Match
            </div>
        </div>
    </div>

    {{-- 2. STATISTIK SECTION --}}
    <div class="max-w-7xl mx-auto px-6 py-16 border-b border-white/10 relative z-10">
        <div class="grid grid-cols-3 gap-8 text-center divide-x divide-white/10">
            <div class="group cursor-default">
                <div class="text-4xl md:text-6xl font-black text-neon mb-2 group-hover:scale-110 transition-transform">08+</div>
                <div class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-bold">Lapangan</div>
            </div>
            <div class="group cursor-default">
                <div class="text-4xl md:text-6xl font-black text-neon mb-2 group-hover:scale-110 transition-transform">20+</div>
                <div class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-bold">Raket Sewa</div>
            </div>
            <div class="group cursor-default">
                <div class="text-4xl md:text-6xl font-black text-neon mb-2 group-hover:scale-110 transition-transform">01</div>
                <div class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-bold">Kantin</div>
            </div>
        </div>
    </div>

    {{-- 3. TENTANG KAMI SECTION --}}
    <div class="max-w-7xl mx-auto px-6 py-24 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                    Tentang <br> <span class="text-gray-400">Arena Kami</span>
                </h2>
                <div class="w-16 h-1 bg-neon mb-8 rounded-full"></div>
                <p class="text-gray-400 leading-relaxed text-lg mb-8 bg-white/5 p-6 rounded-3xl border border-white/5 backdrop-blur-sm">
                    Arena kami hadir dengan standar kualitas yang tinggi untuk memastikan setiap smash dan gerakan Anda maksimal. Dilengkapi dengan pencahayaan yang tidak menyilaukan dan sirkulasi udara yang terjaga.
                </p>
            </div>
            <div class="relative">
                {{-- Aksen Neon Kotak di Belakang Gambar --}}
                <div class="absolute -inset-4 bg-neon rounded-[2.5rem] transform -rotate-3 opacity-80 blur-[2px]"></div>
                
                <img src="{{ asset('images/tampilan.jpg') }}" alt="Tampilan GOR" class="rounded-[2.5rem] relative z-10 w-full object-cover h-[350px] md:h-[450px] grayscale hover:grayscale-0 transition duration-500 shadow-2xl border border-white/10">
                
                {{-- Label Kotak Hijau Floating --}}
                <div class="absolute -bottom-6 -left-6 bg-darkCard border border-neon/50 text-neon p-5 rounded-2xl font-bold text-xs tracking-widest z-20 shadow-[0_0_20px_rgba(204,255,0,0.2)] max-w-[220px] uppercase">
                    A Professional <br><span class="text-white">Badminton Arena</span>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. FASILITAS SECTION --}}
    <div id="fasilitas" class="max-w-7xl mx-auto px-6 py-12 mb-24 relative z-10">
        <div class="bg-darkCard rounded-[3rem] p-8 md:p-16 border border-white/10 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-neon/5 rounded-full blur-[50px] pointer-events-none"></div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 relative z-10">
                
                {{-- Bagian Kiri: Teks & List --}}
                <div class="md:col-span-6">
                    <div class="inline-block bg-neon/10 border border-neon/30 text-neon px-4 py-2 rounded-full font-bold text-xs mb-6 uppercase tracking-widest shadow-[0_0_10px_rgba(204,255,0,0.1)]">
                        Fasilitas Unggulan
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">Kami menyediakan semua kebutuhan pertandingan Anda</h2>
                    <p class="text-gray-400 mb-10 text-sm">Dengan standar profesional untuk kenyamanan maksimal.</p>
                    
                    <div class="space-y-4">
                        {{-- List 1 --}}
                        <div class="p-5 border border-white/10 rounded-2xl hover:border-neon transition-colors cursor-default group bg-[#0a0a0a]">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-4">
                                    <span class="font-black text-gray-600 group-hover:text-neon transition-colors">01</span>
                                    <span class="font-bold text-white group-hover:text-neon transition-colors">Lapangan Standar Pro</span>
                                </div>
                                <span class="text-gray-600 group-hover:text-neon transition-colors">↗</span>
                            </div>
                            <p class="pl-10 pr-4 text-xs text-gray-500 leading-relaxed">Lantai vinyl interlock dengan peredam kejut untuk melindungi sendi pemain saat melompat dan mengejar bola.</p>
                        </div>
                        
                        {{-- List 2 --}}
                        <div class="p-5 border border-white/10 rounded-2xl hover:border-neon transition-colors cursor-default group bg-[#0a0a0a]">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-4">
                                    <span class="font-black text-gray-600 group-hover:text-neon transition-colors">02</span>
                                    <span class="font-bold text-white group-hover:text-neon transition-colors">Rental & Shop Raket</span>
                                </div>
                                <span class="text-gray-600 group-hover:text-neon transition-colors">↗</span>
                            </div>
                            <p class="pl-10 pr-4 text-xs text-gray-500 leading-relaxed">Tersedia berbagai pilihan raket dari brand ternama (Yonex, Li-Ning, Victor) baik untuk disewa maupun dibeli.</p>
                        </div>
                    </div>
                </div>
                
                {{-- Bagian Kanan: Foto Grid --}}
                <div class="md:col-span-6 grid grid-cols-2 gap-4 md:gap-6 relative">
                    <div class="rounded-[2rem] overflow-hidden h-[250px] md:h-[400px] border border-white/10">
                        <img src="{{ asset('images/lapangan.jpg') }}" alt="Lapangan" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                    </div>
                    <div class="rounded-[2rem] overflow-hidden h-[250px] md:h-[400px] mt-12 border border-white/10">
                        <img src="{{ asset('images/raket.jpg') }}" alt="Koleksi Raket" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                    </div>
                    
                    {{-- Aksen Panah Bulat --}}
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-neon text-black w-16 h-16 rounded-full flex items-center justify-center font-bold text-2xl shadow-[0_0_20px_rgba(204,255,0,0.4)] z-10 border-4 border-darkCard hover:scale-110 transition-transform">
                        ↗
                    </div>
                </div>
                
            </div>
        </div>
        
        {{-- Marquee Text --}}
        <div class="mt-20 text-center border-y border-white/10 py-8 overflow-hidden whitespace-nowrap bg-white/5 backdrop-blur-sm">
            <h2 class="text-3xl md:text-5xl font-black text-white tracking-widest uppercase inline-block animate-[pulse_3s_ease-in-out_infinite]">
                SMASH <span class="text-neon text-2xl align-middle mx-4">✦</span> 
                DEFEND <span class="text-neon text-2xl align-middle mx-4">✦</span> 
                WIN 
            </h2>
        </div>
    </div>
</div>
@endsection