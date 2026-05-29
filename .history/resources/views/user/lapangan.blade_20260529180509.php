@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          darkBg: '#050505',
          darkCard: '#121212',
          neon: '#ccff00',
        }
      }
    }
  }
</script>

<style>
  .text-stroke-neon {
    -webkit-text-stroke: 1px #ccff00;
    color: transparent;
  }
</style>

<div class="bg-darkBg min-h-screen font-sans selection:bg-neon selection:text-black pt-10">
    <div id="fasilitas" class="py-16 px-4 md:px-6 relative overflow-hidden">
        
        {{-- Cahaya Glowing di Background --}}
        <div class="absolute top-[20%] right-[-10%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px]"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            {{-- Header Katalog --}}
            <div class="text-center mb-24 relative">
                <h2 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight leading-tight uppercase relative inline-block">
                    Katalog <br>
                    
                    <span class="text-neon relative z-10">Fasilitas</span>
                </h2>
                <div class="h-1 w-24 bg-neon mx-auto mt-8 rounded-full"></div>
                <p class="text-gray-400 mt-6 text-lg max-w-2xl mx-auto">Pilih kualitas terbaik untuk performa maksimal Anda di lapangan. Booking sekarang dan kuasai permainan.</p>
            </div>

            {{-- 1. PILIHAN LAPANGAN --}}
            <div class="mb-32">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-12 h-12 rounded-full border border-neon flex items-center justify-center text-neon font-bold text-xl">01</div>
                    <h3 class="text-3xl font-bold text-white tracking-tight uppercase">Area Pertandingan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    
                    {{-- Lapangan 1 (Standar) --}}
                    <div class="group bg-darkCard border border-white/10 rounded-[2.5rem] p-4 hover:border-neon/50 transition-all duration-500 flex flex-col relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/80 z-10 pointer-events-none"></div>
                        
                        <div class="relative overflow-hidden rounded-[2rem] h-64 mb-6">
                            <img src="{{ asset('images/lapangan1.jpg') }}" alt="Lapangan Biasa" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition duration-700">
                            <div class="absolute top-4 left-4 bg-white/10 backdrop-blur-md text-white border border-white/20 px-4 py-2 rounded-full text-xs font-bold uppercase z-20">Standar</div>
                        </div>
                        
                        <div class="flex-grow px-2 relative z-20">
                            <h4 class="text-2xl font-bold text-white mb-2 group-hover:text-neon transition">Lapangan Semen Flat</h4>
                            <p class="text-gray-500 text-sm">Opsi ekonomis dengan pantulan bola yang stabil.</p>
                        </div>
                        
                        <div class="mt-8 flex items-center justify-between px-2 relative z-20">
                            <span class="text-neon font-bold text-lg">Rp 35.000<span class="text-gray-500 text-sm font-normal">/jam</span></span>
                            <a href="{{ url('/booking') }}" class="bg-white/5 hover:bg-neon border border-white/10 hover:text-black text-white px-6 py-3 rounded-full text-sm font-bold transition-colors">Booking</a>
                        </div>
                    </div>

                    {{-- Lapangan 2 (Pro) --}}
                    <div class="group bg-gradient-to-b from-white/10 to-darkCard border border-neon/30 rounded-[2.5rem] p-4 hover:border-neon transition-all duration-500 flex flex-col relative overflow-hidden transform md:-translate-y-4">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-neon/20 rounded-full blur-[30px]"></div>
                        
                        <div class="relative overflow-hidden rounded-[2rem] h-64 mb-6">
                            <img src="{{ asset('images/lapangan2.jpg') }}" alt="Lapangan Pro" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <div class="absolute top-4 left-4 bg-neon text-black px-4 py-2 rounded-full text-xs font-bold uppercase z-20 shadow-[0_0_15px_rgba(204,255,0,0.5)]">Populer</div>
                        </div>
                        
                        <div class="flex-grow px-2 relative z-20">
                            <h4 class="text-2xl font-bold text-white mb-2 group-hover:text-neon transition">Vinyl Interlock Pro</h4>
                            <p class="text-gray-400 text-sm">Lantai vinyl empuk, mengurangi risiko cedera lutut.</p>
                        </div>
                        
                        <div class="mt-8 flex items-center justify-between px-2 relative z-20">
                            <span class="text-white font-bold text-lg">Rp 50.000<span class="text-gray-500 text-sm font-normal">/jam</span></span>
                            <a href="{{ url('/booking') }}" class="bg-neon text-black shadow-[0_0_20px_rgba(204,255,0,0.3)] hover:scale-105 px-6 py-3 rounded-full text-sm font-bold transition-transform">Booking</a>
                        </div>
                    </div>

                    {{-- Lapangan 3 (Premium) --}}
                    <div class="group bg-darkCard border border-white/10 rounded-[2.5rem] p-4 hover:border-white/40 transition-all duration-500 flex flex-col relative overflow-hidden">
                        <div class="relative overflow-hidden rounded-[2rem] h-64 mb-6">
                            <img src="{{ asset('images/lapangan3.png') }}" alt="Lapangan Premium" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition duration-700">
                            <div class="absolute top-4 left-4 bg-white/10 backdrop-blur-md text-white border border-white/20 px-4 py-2 rounded-full text-xs font-bold uppercase z-20">Premium</div>
                        </div>
                        
                        <div class="flex-grow px-2 relative z-20">
                            <h4 class="text-2xl font-bold text-white mb-2 group-hover:text-neon transition">BWF Premium Arena</h4>
                            <p class="text-gray-500 text-sm">Karpet sand-surface BWF, pencahayaan LED no-glare.</p>
                        </div>
                        
                        <div class="mt-8 flex items-center justify-between px-2 relative z-20">
                            <span class="text-neon font-bold text-lg">Rp 70.000<span class="text-gray-500 text-sm font-normal">/jam</span></span>
                            <a href="{{ url('/booking') }}" class="bg-white/5 hover:bg-white border border-white/10 hover:text-black text-white px-6 py-3 rounded-full text-sm font-bold transition-colors">Booking</a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 2. KATALOG RAKET --}}
            <div>
                <div class="flex items-center gap-4 mb-10 justify-end md:justify-start">
                    <div class="w-12 h-12 rounded-full border border-neon flex items-center justify-center text-neon font-bold text-xl">02</div>
                    <h3 class="text-3xl font-bold text-white tracking-tight uppercase">Koleksi Senjata</h3>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    
                    {{-- Raket 1 --}}
                    <div class="group bg-darkCard border border-white/5 rounded-[2rem] p-3 hover:border-neon/50 transition-all text-center flex flex-col relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-neon/5 to-transparent opacity-0 group-hover:opacity-100 rounded-[2rem] transition duration-500 pointer-events-none"></div>
                        <div class="aspect-square overflow-hidden rounded-3xl mb-4 bg-[#0a0a0a] flex items-center justify-center p-6 border border-white/5">
                            <img src="{{ asset('images/raket1.jpg') }}" class="max-h-full group-hover:rotate-12 group-hover:scale-110 transition duration-500 drop-shadow-[0_10px_10px_rgba(255,255,255,0.1)]" alt="Raket Biasa">
                        </div>
                        <div class="flex-grow pb-2 z-10">
                            <h5 class="font-bold text-white group-hover:text-neon transition">Raket Carbon</h5>
                            <p class="text-xs text-gray-500 mt-1">Pemula</p>
                            <p class="text-white font-bold mt-3 border-t border-white/10 pt-3">Rp 10.000</p>
                        </div>
                        <a href="{{ url('/booking') }}" class="mt-2 block py-3 bg-white/5 text-gray-300 rounded-full text-xs font-bold hover:bg-neon hover:text-black transition relative z-10">Pilih Raket</a>
                    </div>

                    {{-- Raket 2 --}}
                    <div class="group bg-darkCard border border-white/5 rounded-[2rem] p-3 hover:border-neon/50 transition-all text-center flex flex-col relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-neon/5 to-transparent opacity-0 group-hover:opacity-100 rounded-[2rem] transition duration-500 pointer-events-none"></div>
                        <div class="aspect-square overflow-hidden rounded-3xl mb-4 bg-[#0a0a0a] flex items-center justify-center p-6 border border-white/5">
                            <img src="{{ asset('images/raket2.jpg') }}" class="max-h-full group-hover:rotate-12 group-hover:scale-110 transition duration-500 drop-shadow-[0_10px_10px_rgba(255,255,255,0.1)]" alt="Li-Ning">
                        </div>
                        <div class="flex-grow pb-2 z-10">
                            <h5 class="font-bold text-white group-hover:text-neon transition">Li-Ning G-Force</h5>
                            <p class="text-xs text-gray-500 mt-1">Balanced</p>
                            <p class="text-white font-bold mt-3 border-t border-white/10 pt-3">Rp 15.000</p>
                        </div>
                        <a href="{{ url('/booking') }}" class="mt-2 block py-3 bg-white/5 text-gray-300 rounded-full text-xs font-bold hover:bg-neon hover:text-black transition relative z-10">Pilih Raket</a>
                    </div>

                    {{-- Raket 3 --}}
                    <div class="group bg-darkCard border border-white/5 rounded-[2rem] p-3 hover:border-neon/50 transition-all text-center flex flex-col relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-neon/5 to-transparent opacity-0 group-hover:opacity-100 rounded-[2rem] transition duration-500 pointer-events-none"></div>
                        <div class="aspect-square overflow-hidden rounded-3xl mb-4 bg-[#0a0a0a] flex items-center justify-center p-6 border border-white/5">
                            <img src="{{ asset('images/raket3.jpeg') }}" class="max-h-full group-hover:-rotate-12 group-hover:scale-110 transition duration-500 drop-shadow-[0_10px_10px_rgba(255,255,255,0.1)]" alt="Victor">
                        </div>
                        <div class="flex-grow pb-2 z-10">
                            <h5 class="font-bold text-white group-hover:text-neon transition">Victor Thruster</h5>
                            <p class="text-xs text-gray-500 mt-1">Power Smash</p>
                            <p class="text-white font-bold mt-3 border-t border-white/10 pt-3">Rp 20.000</p>
                        </div>
                        <a href="{{ url('/booking') }}" class="mt-2 block py-3 bg-white/5 text-gray-300 rounded-full text-xs font-bold hover:bg-neon hover:text-black transition relative z-10">Pilih Raket</a>
                    </div>

                    {{-- Raket 4 (Unggulan) --}}
                    <div class="group bg-gradient-to-b from-white/10 to-darkCard border border-neon/30 rounded-[2rem] p-3 hover:border-neon transition-all text-center flex flex-col relative">
                        <div class="absolute top-2 right-2 bg-neon w-2 h-2 rounded-full animate-ping z-20"></div>
                        <div class="absolute top-2 right-2 bg-neon w-2 h-2 rounded-full z-20"></div>
                        
                        <div class="aspect-square overflow-hidden rounded-3xl mb-4 bg-[#0a0a0a] flex items-center justify-center p-6 border border-white/5">
                            <img src="{{ asset('images/raket4.jpeg') }}" class="max-h-full group-hover:-rotate-12 group-hover:scale-110 transition duration-500 drop-shadow-[0_10px_20px_rgba(204,255,0,0.2)]" alt="Yonex">
                        </div>
                        <div class="flex-grow pb-2 z-10">
                            <h5 class="font-bold text-white group-hover:text-neon transition">Yonex Astrox 88D</h5>
                            <p class="text-xs text-neon mt-1 font-bold">Pro Edition</p>
                            <p class="text-white font-bold mt-3 border-t border-white/10 pt-3">Rp 25.000</p>
                        </div>
                        <a href="{{ url('/booking') }}" class="mt-2 block py-3 bg-neon text-black rounded-full text-xs font-bold hover:scale-105 transition transform shadow-[0_0_15px_rgba(204,255,0,0.3)] relative z-10">Pilih Raket</a>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection