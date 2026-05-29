@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
{{-- Kita tambahkan sedikit konfigurasi custom color agar warna neon-nya persis contoh --}}
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          darkBg: '#0a0a0a',
          neonLime: '#a3e635', // Warna khas Creatix
        }
      }
    }
  }
</script>

<div class="bg-darkBg min-h-screen font-sans selection:bg-neonLime selection:text-black">
    
    {{-- 1. HERO SECTION (Gaya Oval Besar) --}}
    <div class="bg-white rounded-b-[3rem] md:rounded-b-[5rem] overflow-hidden relative px-6 pt-16 pb-32">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6">
                Badminton Arena <br> 
                <span class="text-black relative inline-block">
                    UNAMA
                    <svg class="absolute w-full h-4 -bottom-1 left-0 text-neonLime" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none"/></svg>
                </span>
            </h1>
            <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto mb-10">
                Tempat olahraga terbaik untuk menyalurkan bakat dan hobi. Fasilitas lengkap, lokasi strategis, dan atmosfer pertandingan yang seru.
            </p>
            <div class="mt-8">
                {{-- PERBAIKAN: Ejaan 'Lihata' diubah jadi 'Lihat' --}}
                <a href="#fasilitas" class="bg-neonLime text-black px-8 py-4 rounded-full font-bold hover:bg-lime-400 transition shadow-[0_10px_40px_rgba(163,230,53,0.4)] flex items-center justify-center inline-flex">
                    Lihat Fasilitas
                </a>
            </div>
        </div>

        {{-- Gambar Hero Floating (Overlap) --}}
        <div class="mt-16 max-w-5xl mx-auto rounded-[3rem] overflow-hidden shadow-2xl h-[300px] md:h-[500px] relative">
            <img src="{{ asset('images/lapanganatas.jpg') }}" class="w-full h-full object-cover" alt="Suasana GOR">
            <div class="absolute bottom-6 left-6 bg-neonLime text-black px-6 py-3 rounded-full font-bold text-sm shadow-lg flex items-center">
                <span class="w-2 h-2 rounded-full bg-black mr-2 animate-pulse"></span> Start Your Match
            </div>
        </div>
    </div>

    {{-- 2. STATISTIK SECTION (Angka Neon di Latar Gelap) --}}
    <div class="max-w-7xl mx-auto px-6 py-16 border-b border-gray-800">
        <div class="grid grid-cols-3 gap-8 text-center divide-x divide-gray-800">
            <div>
                <div class="text-4xl md:text-6xl font-bold text-neonLime mb-2">08+</div>
                <div class="text-xs md:text-sm text-gray-400 uppercase tracking-widest font-semibold">Lapangan</div>
            </div>
            <div>
                <div class="text-4xl md:text-6xl font-bold text-neonLime mb-2">20+</div>
                <div class="text-xs md:text-sm text-gray-400 uppercase tracking-widest font-semibold">Raket Sewa</div>
            </div>
            <div>
                <div class="text-4xl md:text-6xl font-bold text-neonLime mb-2">01</div>
                <div class="text-xs md:text-sm text-gray-400 uppercase tracking-widest font-semibold">Kantin</div>
            </div>
        </div>
    </div>

    {{-- 3. TENTANG KAMI SECTION (Gaya Overlap Kotak Mewah) --}}
    <div class="max-w-7xl mx-auto px-6 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                    Tentang <br> Arena Kami
                </h2>
                <p class="text-gray-400 leading-relaxed text-lg mb-8">
                    Arena kami hadir dengan standar kualitas yang tinggi untuk memastikan setiap smash dan gerakan Anda maksimal. Dilengkapi dengan pencahayaan yang tidak menyilaukan dan sirkulasi udara yang terjaga.
                </p>
            </div>
            <div class="relative">
                {{-- Aksen Neon Kotak di Belakang Gambar ala Creatix --}}
                <div class="absolute -inset-4 bg-neonLime rounded-[2rem] transform -rotate-3 opacity-90"></div>
                
                <img src="{{ asset('images/tampilan.jpg') }}" alt="Tampilan GOR" class="rounded-[2rem] relative z-10 w-full object-cover h-[350px] md:h-[450px] grayscale hover:grayscale-0 transition duration-500 shadow-2xl">
                
                {{-- Label Kotak Hijau Floating --}}
                <div class="absolute -bottom-6 -left-6 bg-neonLime text-black p-5 rounded-xl font-bold text-sm z-20 shadow-xl max-w-[220px]">
                    A PROFESSIONAL BADMINTON ARENA
                </div>
            </div>
        </div>
    </div>

    {{-- 4. FASILITAS SECTION (Gaya "Our Services" Kotak List Hitam) --}}
    <div id="fasilitas" class="max-w-7xl mx-auto px-6 py-12 mb-24">
        <div class="bg-[#111111] rounded-[3rem] p-8 md:p-16 border border-gray-800">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                
                {{-- Bagian Kiri: Teks & List --}}
                <div class="md:col-span-6">
                    <div class="inline-block bg-neonLime text-black px-4 py-2 rounded-full font-bold text-xs mb-6 uppercase tracking-wider">
                        Fasilitas Unggulan
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Kami menyediakan semua kebutuhan pertandingan Anda</h2>
                    <p class="text-gray-400 mb-10 text-sm">Dengan standar profesional untuk kenyamanan maksimal.</p>
                    
                    <div class="space-y-4">
                        {{-- List 1 --}}
                        <div class="flex items-center justify-between p-5 border border-gray-700 rounded-full hover:border-neonLime hover:text-neonLime transition cursor-pointer group bg-[#0a0a0a]">
                            <div class="flex items-center gap-4">
                                <span class="font-bold text-gray-500 group-hover:text-neonLime">01</span>
                                <span class="font-bold text-white group-hover:text-neonLime">Lapangan Standar Pro</span>
                            </div>
                            <span class="text-gray-500 group-hover:text-neonLime">→</span>
                        </div>
                        <p class="pl-14 pr-4 text-xs text-gray-500 mb-4">Lantai vinyl interlock dengan peredam kejut untuk melindungi sendi pemain saat melompat dan mengejar bola.</p>
                        
                        {{-- List 2 --}}
                        <div class="flex items-center justify-between p-5 border border-gray-700 rounded-full hover:border-neonLime hover:text-neonLime transition cursor-pointer group bg-[#0a0a0a]">
                            <div class="flex items-center gap-4">
                                <span class="font-bold text-gray-500 group-hover:text-neonLime">02</span>
                                <span class="font-bold text-white group-hover:text-neonLime">Rental & Shop Raket</span>
                            </div>
                            <span class="text-gray-500 group-hover:text-neonLime">→</span>
                        </div>
                        <p class="pl-14 pr-4 text-xs text-gray-500">Tersedia berbagai pilihan raket dari brand ternama (Yonex, Li-Ning, Victor) baik untuk disewa maupun dibeli.</p>
                    </div>
                </div>
                
                {{-- Bagian Kanan: Foto Grid --}}
                <div class="md:col-span-6 grid grid-cols-2 gap-4 md:gap-6 relative">
                    <div class="rounded-[2rem] overflow-hidden h-[250px] md:h-[400px]">
                        <img src="{{ asset('images/lapangan.jpg') }}" alt="Lapangan" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                    </div>
                    <div class="rounded-[2rem] overflow-hidden h-[250px] md:h-[400px] mt-12">
                        <img src="{{ asset('images/raket.jpg') }}" alt="Koleksi Raket" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                    </div>
                    
                    {{-- Aksen Panah Bulat --}}
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-neonLime text-black w-16 h-16 rounded-full flex items-center justify-center font-bold text-2xl shadow-xl z-10 border-4 border-[#111111]">
                        ↗
                    </div>
                </div>
                
            </div>
        </div>
        
        {{-- Marquee Text Ala Creatix --}}
        <div class="mt-16 text-center border-y border-gray-800 py-6 overflow-hidden whitespace-nowrap">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white tracking-widest uppercase inline-block animate-[pulse_3s_ease-in-out_infinite]">
                SMASH <span class="text-neonLime text-2xl align-middle">✦</span> 
                DEFEND <span class="text-neonLime text-2xl align-middle">✦</span> 
                WIN 
            </h2>
        </div>
    </div>
</div>
@endsection