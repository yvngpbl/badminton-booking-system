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
    <div class="absolute top-[10%] left-[10%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        
        {{-- HEADER --}}
        <div class="text-center mb-16 relative">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight uppercase">
                Kelola Ketersediaan <span class="text-neon">Lapangan</span>
            </h2>
            <div class="h-1 w-16 bg-neon mx-auto mt-6 rounded-full shadow-[0_0_15px_rgba(204,255,0,0.5)]"></div>
            <p class="text-gray-400 mt-4 text-sm md:text-base max-w-2xl mx-auto tracking-widest uppercase font-semibold">
                Update status lapangan secara real-time untuk User.
            </p>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="bg-neon/10 border border-neon/30 text-neon px-6 py-4 rounded-2xl mb-12 text-center font-bold backdrop-blur-sm shadow-[0_0_15px_rgba(204,255,0,0.1)] max-w-2xl mx-auto flex items-center justify-center">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- GRID LAPANGAN --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            @foreach($lapangan as $l)
            @php
                $hargaLap = $l->harga ?? $l->id; 
            @endphp
            
            <div class="group flex flex-col bg-darkCard rounded-[2.5rem] p-4 transition-all duration-500 relative overflow-hidden {{ $hargaLap == 50000 ? 'border border-neon/40 shadow-[0_0_20px_rgba(204,255,0,0.05)] md:-translate-y-2 hover:border-neon' : ($hargaLap == 70000 ? 'border border-white/20 hover:border-white/50' : 'border border-white/10 hover:border-white/30') }}">
                
                @if($hargaLap == 50000)
                    <div class="absolute top-0 left-0 w-full h-1 bg-neon z-20"></div>
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-neon text-black px-4 py-1.5 rounded-full text-[10px] font-black z-30 shadow-[0_0_15px_rgba(204,255,0,0.5)] tracking-widest uppercase">POPULER</div>
                @endif

                <div class="relative overflow-hidden rounded-[2rem] h-52 mb-6">
                    <img src="{{ asset('images/lapangan 1.jpg') }}" alt="{{ $l->nama }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition duration-500">
                    <img src="{{ asset('images/lapangan2.png') }}" alt="{{ $l->nama }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent pointer-events-none"></div>
                    
                    <div class="absolute top-4 left-4 z-20">
                        @if($l->status == 'tersedia')
                            <span class="bg-neon/10 text-neon px-3 py-1.5 rounded-lg text-[10px] font-black tracking-widest uppercase backdrop-blur-md border border-neon/30 shadow-[0_0_10px_rgba(204,255,0,0.2)]">Tersedia</span>
                        @else
                            <span class="bg-red-500/10 text-red-500 px-3 py-1.5 rounded-lg text-[10px] font-black tracking-widest uppercase backdrop-blur-md border border-red-500/30 shadow-[0_0_10px_rgba(239,68,68,0.2)]">Tutup / Teknis</span>
                        @endif
                    </div>

                    <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white border border-white/10 px-3 py-1.5 rounded-lg text-sm font-bold shadow-sm z-20">
                        Rp {{ number_format($hargaLap, 0, ',', '.') }} <span class="text-xs text-gray-400 font-normal">/ Jam</span>
                    </div>
                </div>

                <div class="flex-grow px-2">
                    <h4 class="text-xl font-bold text-white mb-2">{{ $l->nama }}</h4>
                    <p class="text-gray-500 text-xs tracking-wide uppercase font-semibold">Update ketersediaan:</p>
                </div>

                {{-- FORM UPDATE STATUS --}}
                <form action="{{ url('/admin/lapangan/'.$l->id.'/update') }}" method="POST" class="mt-5 flex flex-col gap-3 relative z-20 px-2">
                    @csrf
                    <select name="status" class="w-full p-3 bg-[#0a0a0a] text-white border border-white/10 rounded-xl text-sm font-bold outline-none focus:border-neon focus:ring-1 focus:ring-neon appearance-none cursor-pointer transition-all">
                        <option value="tersedia" {{ $l->status == 'tersedia' ? 'selected' : '' }}>🟢 Buka (Tersedia)</option>
                        <option value="teknis" {{ $l->status == 'teknis' ? 'selected' : '' }}>🔴 Tutup (Alasan Teknis)</option>
                    </select>
                    <button type="submit" class="w-full bg-white/5 border border-white/10 text-white hover:bg-neon hover:text-black hover:border-neon font-bold py-3 rounded-xl transition-all duration-300 shadow-sm hover:shadow-[0_0_20px_rgba(204,255,0,0.3)] text-xs uppercase tracking-widest">
                        Simpan
                    </button>
                </form>
                
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection