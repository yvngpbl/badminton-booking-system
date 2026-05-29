@extends('layout')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

{{-- Konfigurasi warna diselaraskan dengan tema gambar referensi (Terang & Oranye) --}}
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          'anton': ['Anton', 'sans-serif'],
          'inter': ['Inter', 'sans-serif'],
        },
        colors: {
          brandOrange: '#ff5c00', // Warna oranye utama
          darkBg: '#1e2025',      // Warna gelap untuk section bawah
          darkCard: '#111111',
        }
      }
    }
  }
</script>

<div class="bg-white min-h-screen font-inter selection:bg-brandOrange selection:text-white relative overflow-hidden">
    
    {{-- 1. HERO SECTION (Diubah menjadi putih terang dengan teks tebal hitam) --}}
    <div class="bg-white overflow-hidden relative px-6 pt-24 pb-32">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="font-anton text-[4rem] md:text-[6rem] text-[#1a1a1a] uppercase tracking-wide leading-[0.9] mb-6">
                Badminton Arena <br> 
                <span class="text-brandOrange relative inline-block mt-2">
                    UNAMA
                </span>
            </h1>
            <p class="mt-8 text-lg text-gray-500 font-medium max-w-2xl mx-auto mb-10 leading-relaxed">
                Tempat olahraga terbaik untuk menyalurkan bakat dan hobi. Fasilitas lengkap, lokasi strategis, dan atmosfer pertandingan yang seru.
            </p>
            <div class="mt-10 flex justify-center">
                <a href="#fasilitas" class="bg-gray-200 text-[#1a1a1a] px-8 py-4 rounded-full font-bold hover:bg-gray-300 hover:scale-105 transition-all duration-300 flex items-center justify-center inline-flex uppercase tracking-widest text-sm">
                    Lihat Fasilitas
                </a>
            </div>
        </div>

        {{-- Gambar Hero Floating --}}
        <div class="mt-16 max-w-5xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl h-[300px] md:h-[500px] relative group border-4 border-white">
            <img src="{{ asset('images/lapanganatas.jpg') }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" alt="Suasana GOR">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>
            <div class="absolute bottom-6 left-6 bg-brandOrange text-white px-6 py-3 rounded-full font-bold text-sm shadow-[0_10px_20px_rgba(255,92,0,0.4)] flex items-center z-10">
                <span class="w-2 h-2 rounded-full bg-white mr-3 animate-ping"></span> Start Your Match
            </div>
        </div>
    </div>

    {{-- 2. STATISTIK SECTION --}}
    <div class="max-w-7xl mx-auto px-6 py-16 border-b border-gray-200 relative z-10">
        <div class="grid grid-cols-3 gap-8 text-center divide-x divide-gray-200">
            <div class="group cursor-default">
                <div class="text-4xl md:text-6xl font-black text-gray-300 mb-2 group-hover:text-brandOrange transition-colors">08+</div>
                <div class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-bold">Lapangan</div>
            </div>
            <div class="group cursor-default">
                <div class="text-4xl md:text-6xl font-black text-gray-300 mb-2 group-hover:text-brandOrange transition-colors">20+</div>
                <div class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-bold">Raket Sewa</div>
            </div>
            <div class="group cursor-default">
                <div class="text-4xl md:text-6xl font-black text-gray-300 mb-2 group-hover:text-brandOrange transition-colors">01</div>
                <div class="text-xs md:text-sm text-gray-500 uppercase tracking-widest font-bold">Kantin</div>
            </div>
        </div>
    </div>

    {{-- 3. TENTANG KAMI SECTION --}}
    <div class="max-w-7xl mx-auto px-6 py-24 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="font-anton text-4xl md:text-6xl text-[#1a1a1a] uppercase mb-6 leading-[0.9]">
                    Tentang <br> <span class="text-gray-400">Arena Kami</span>
                </h2>
                <div class="w-16 h-2 bg-brandOrange mb-8"></div>
                <p class="text-gray-600 font-medium leading-relaxed text-lg mb-8 bg-gray-50 p-6 rounded-3xl border border-gray-200">
                    Arena kami hadir dengan standar kualitas yang tinggi untuk memastikan setiap smash dan gerakan Anda maksimal. Dilengkapi dengan pencahayaan yang tidak menyilaukan dan sirkulasi udara yang terjaga.
                </p>
            </div>
            <div class="relative">
                {{-- Aksen Kotak Abu-abu di Belakang Gambar --}}
                <div class="absolute -inset-4 bg-gray-200 rounded-[2.5rem] transform -rotate-3"></div>
                
                <img src="{{ asset('images/tampilan.jpg') }}" alt="Tampilan GOR" class="rounded-[2.5rem] relative z-10 w-full object-cover h-[350px] md:h-[450px] transition duration-500 shadow-xl border-4 border-white">
                
                {{-- Label Kotak Oranye Floating --}}
                <div class="absolute -bottom-6 -left-6 bg-brandOrange text-white p-6 rounded-2xl font-bold text-xs tracking-widest z-20 shadow-[0_15px_30px_rgba(255,92,0,0.3)] max-w-[220px] uppercase">
                    A Professional <br><span class="text-[#1a1a1a]">Badminton Arena</span>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. FASILITAS SECTION (Dibuat mode gelap seperti bagian bawah gambar referensi) --}}
    <div id="fasilitas" class="px-6 py-12 mb-24 relative z-10">
        <div class="max-w-7xl mx-auto bg-darkBg rounded-[3rem] p-8 md:p-16 shadow-2xl relative overflow-hidden">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 relative z-10">
                
                {{-- Bagian Kiri: Teks & List --}}
                <div class="md:col-span-6">
                    <div class="inline-block bg-white/10 text-white px-4 py-2 rounded-full font-bold text-xs mb-6 uppercase tracking-widest">
                        Fasilitas Unggulan
                    </div>
                    <h2 class="font-anton text-3xl md:text-5xl text-white mb-4 leading-tight tracking-wide uppercase">Kami menyediakan semua<br>kebutuhan pertandingan Anda</h2>
                    <p class="text-gray-400 mb-10 text-sm font-medium">Dengan standar profesional untuk kenyamanan maksimal.</p>
                    
                    <div class="space-y-4">
                        {{-- List 1 --}}
                        <div class="p-5 border border-white/10 rounded-2xl hover:border-brandOrange transition-colors cursor-default group bg-darkCard">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-4">
                                    <span class="font-black text-gray-600 group-hover:text-brandOrange transition-colors">01</span>
                                    <span class="font-bold text-white group-hover:text-brandOrange transition-colors">Lapangan Standar Pro</span>
                                </div>
                                <span class="text-gray-600 group-hover:text-brandOrange transition-colors">↗</span>
                            </div>
                            <p class="pl-10 pr-4 text-xs text-gray-400 font-medium leading-relaxed">Lantai vinyl interlock dengan peredam kejut untuk melindungi sendi pemain saat melompat dan mengejar bola.</p>
                        </div>
                        
                        {{-- List 2 --}}
                        <div class="p-5 border border-white/10 rounded-2xl hover:border-brandOrange transition-colors cursor-default group bg-darkCard">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-4">
                                    <span class="font-black text-gray-600 group-hover:text-brandOrange transition-colors">02</span>
                                    <span class="font-bold text-white group-hover:text-brandOrange transition-colors">Rental & Shop Raket</span>
                                </div>
                                <span class="text-gray-600 group-hover:text-brandOrange transition-colors">↗</span>
                            </div>
                            <p class="pl-10 pr-4 text-xs text-gray-400 font-medium leading-relaxed">Tersedia berbagai pilihan raket dari brand ternama (Yonex, Li-Ning, Victor) baik untuk disewa maupun dibeli.</p>
                        </div>
                    </div>
                </div>
                
                {{-- Bagian Kanan: Foto Grid --}}
                <div class="md:col-span-6 grid grid-cols-2 gap-4 md:gap-6 relative">
                    <div class="rounded-[2rem] overflow-hidden h-[250px] md:h-[400px] border-4 border-darkBg shadow-lg">
                        <img src="{{ asset('images/lapangan.jpg') }}" alt="Lapangan" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-[2rem] overflow-hidden h-[250px] md:h-[400px] mt-12 border-4 border-darkBg shadow-lg">
                        <img src="{{ asset('images/raket.jpg') }}" alt="Koleksi Raket" class="w-full h-full object-cover">
                    </div>
                    
                    {{-- Aksen Panah Bulat --}}
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-brandOrange text-white w-16 h-16 rounded-full flex items-center justify-center font-bold text-2xl shadow-[0_10px_20px_rgba(255,92,0,0.5)] z-10 border-4 border-darkBg hover:scale-110 transition-transform">
                        ↗
                    </div>
                </div>
                
            </div>
        </div>
        
        {{-- Marquee Text (Disesuaikan ke terang) --}}
        <div class="mt-20 max-w-7xl mx-auto text-center border-y border-gray-200 py-8 overflow-hidden whitespace-nowrap bg-gray-50 rounded-2xl">
            <h2 class="text-3xl md:text-5xl font-black text-gray-300 tracking-widest uppercase inline-block">
                <span class="text-[#1a1a1a]">SMASH</span> <span class="text-brandOrange text-2xl align-middle mx-4">✦</span> 
                <span class="text-[#1a1a1a]">DEFEND</span> <span class="text-brandOrange text-2xl align-middle mx-4">✦</span> 
                <span class="text-[#1a1a1a]">WIN</span> 
            </h2>
        </div>
    </div>
</div>
@endsection