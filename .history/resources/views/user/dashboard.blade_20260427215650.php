@extends('layout')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
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
          brandOrange: '#ff5c00',
          darkBg: '#1e2025',
          lightBg: '#f8f9fa',
          cardBlue: '#d1dae0'
        }
      }
    }
  }
</script>

<div class="bg-white min-h-screen font-inter relative overflow-hidden flex flex-col pt-4">
    
    {{-- NAVBAR --}}
    <nav class="flex justify-between items-center py-4 px-8 md:px-16 z-30 relative max-w-[1400px] w-full mx-auto">
        <div class="flex items-center gap-3 text-2xl font-black tracking-tight text-black">
            <div class="w-6 h-6 bg-brandOrange rounded-sm transform rotate-45 flex-shrink-0"></div>
            Rhinalitics
        </div>
        <div class="hidden md:flex gap-10 text-sm font-semibold tracking-wide">
            <a href="#" class="text-black">Games</a>
            <a href="#" class="text-gray-500 hover:text-black transition-colors">Analytics</a>
            <a href="#" class="text-gray-500 hover:text-black transition-colors">Players</a>
        </div>
        <button class="bg-gray-200 text-black text-xs font-bold px-6 py-3 rounded-full hover:bg-gray-300 transition-colors tracking-widest">
            SIGN UP
        </button>
    </nav>

    {{-- HERO SECTION TOP --}}
    <div class="px-8 md:px-16 pt-12 pb-32 flex justify-between relative z-10 max-w-[1400px] w-full mx-auto">
        
        {{-- Kiri: Teks Besar --}}
        <div class="max-w-xl mt-12">
            <h1 class="font-anton text-[5rem] md:text-[7rem] leading-[0.85] text-[#1a1a1a] uppercase tracking-wide">
                Turn Insight<br>Into Victory
            </h1>
            <p class="mt-8 text-gray-500 text-sm md:text-base max-w-sm leading-relaxed font-medium">
                Our platform provides real-time analytics that drive results
            </p>
            
            <div class="mt-20 flex items-center gap-4 text-sm font-bold text-black">
                {{-- Logo Nike SVG (Dummy) --}}
                <svg viewBox="0 0 24 24" class="w-10 h-10 fill-current"><path d="M24 8.25c-2.43 1.34-5.32 1.46-8.08.38-2.52-.98-4.47-3.04-4.88-5.75-.06-.41.52-.58.74-.22 2.05 3.36 5.86 4.7 9.6 3.65.93-.26 2.05-.72 2.62-1.42.27-.33.82-.04.68.37-.17.51-.43.99-.68 1.49z"/></svg>
                Partner with Nike
            </div>
        </div>

        {{-- Kanan: Teks Statistik --}}
        <div class="text-right mt-24 z-20 hidden lg:block">
            <h2 class="font-black text-5xl text-gray-300 tracking-tighter">200K</h2>
            <h3 class="font-black text-2xl text-gray-400 uppercase leading-none mt-2">Athletes and<br>Coaches</h3>
            <p class="text-sm text-gray-500 mt-4 font-medium">Satisfied with the platform</p>
            <div class="mt-8 flex justify-end">
                <button class="w-10 h-10 flex items-center justify-center border-2 border-gray-200 rounded-full hover:bg-gray-100 transition">
                    <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- GAMBAR ATLET DI TENGAH (ABSOLUTE) --}}
    {{-- Karena saya tidak memiliki aset pemain football kamu, saya menggunakan placeholder. Kamu bisa menggantinya dengan "{{ asset('images/player.png') }}" --}}
    <div class="absolute left-1/2 top-10 transform -translate-x-1/2 z-20 pointer-events-none w-full max-w-[800px] flex justify-center">
        <img src="https://via.placeholder.com/800x800.png?text=Masukkan+Gambar+Pemain+Disini" alt="Athlete" class="h-[600px] md:h-[800px] object-contain object-bottom drop-shadow-2xl">
    </div>

    {{-- BOTTOM SECTION (DARK BG) --}}
    <div class="bg-darkBg flex-grow rounded-t-[3rem] mt-24 relative px-8 md:px-16 pt-16 pb-12 z-30 flex flex-col md:flex-row justify-between w-full h-[500px]">
        
        <div class="max-w-[1400px] w-full mx-auto flex justify-between relative h-full">
            {{-- Kiri: Kartu Abu-abu (Speed leaders) --}}
            <div class="bg-cardBlue w-80 rounded-[2rem] p-6 absolute -top-32 shadow-2xl">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-sm font-semibold text-gray-500">Speed leaders</span>
                    <button class="w-8 h-8 flex items-center justify-center border border-gray-400 rounded-full hover:bg-gray-300">
                        <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path></svg>
                    </button>
                </div>
                <div class="text-[3rem] font-black tracking-tighter text-black mb-8 leading-none">6.2 MPH</div>
                <div class="text-sm font-bold text-gray-600 mb-4">Recent matches</div>
                
                {{-- Foto Profil Kecil --}}
                <div class="flex gap-3">
                    <div class="w-16 h-16 bg-gray-400 rounded-lg overflow-hidden border border-gray-300">
                        <img src="https://i.pravatar.cc/100?img=11" class="w-full h-full object-cover">
                    </div>
                    <div class="w-16 h-16 bg-gray-400 rounded-lg overflow-hidden border border-gray-300">
                        <img src="https://i.pravatar.cc/100?img=12" class="w-full h-full object-cover grayscale">
                    </div>
                    <div class="w-16 h-16 bg-gray-400 rounded-lg overflow-hidden border border-gray-300">
                        <img src="https://i.pravatar.cc/100?img=13" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            {{-- Tengah: Teks Transparan --}}
            <div class="mx-auto text-center mt-20 md:pl-32 hidden md:block">
                <p class="text-gray-400 text-sm mb-2 font-medium">Driven by results</p>
                <h2 class="font-anton text-7xl text-white/10 uppercase tracking-wide leading-[0.9]">Your Advantage<br>Starts Here</h2>
            </div>

            {{-- Kanan: Kartu Oranye (Data That Decides) --}}
            <div class="bg-brandOrange w-[350px] rounded-[2rem] p-8 absolute -top-64 right-0 shadow-[0_20px_50px_rgba(255,92,0,0.4)] flex flex-col justify-between h-[550px]">
                <div class="flex justify-between items-start">
                    <h3 class="font-black text-4xl leading-[0.9] text-[#1a1a1a] max-w-[200px] tracking-tight">DATA THAT<br>DECIDES</h3>
                    <div class="w-12 h-12 bg-[#1a1a1a] rounded-xl flex items-center justify-center">
                        {{-- Icon Grafis Dummy --}}
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M21 3H3v18h18V3zM9 15H7v-4h2v4zm4 0h-2v-6h2v6zm4 0h-2V9h2v6z"/></svg>
                    </div>
                </div>
                
                <div class="mt-auto mb-6">
                    {{-- Thumbnail Video --}}
                    <div class="bg-white rounded-2xl p-2 flex gap-0 items-center mb-4">
                        <div class="w-full h-24 bg-gray-200 rounded-xl overflow-hidden relative">
                            <img src="https://via.placeholder.com/300x150.png?text=Video+Thumbnail" class="w-full h-full object-cover">
                        </div>
                        <button class="w-16 h-full flex-shrink-0 flex items-center justify-center hover:bg-gray-100 rounded-r-xl transition">
                            <svg class="w-6 h-6 text-black ml-2" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </button>
                    </div>
                    <p class="text-sm font-semibold text-[#1a1a1a] leading-snug pr-8">Performance. Every snap counts.</p>
                </div>

                <div class="flex justify-between items-center mt-4 pt-6 border-t border-black/10 cursor-pointer group">
                    <span class="font-black text-sm text-[#1a1a1a] tracking-widest group-hover:pl-2 transition-all">EXPLORE</span>
                    <svg class="w-5 h-5 text-[#1a1a1a] group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection