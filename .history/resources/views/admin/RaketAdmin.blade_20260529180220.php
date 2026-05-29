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
    <div class="absolute top-[15%] right-[5%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        
        {{-- HEADER --}}
        <div class="text-center mb-16 relative">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight uppercase">
                Kelola Sewa <span class="text-neon">Raket</span>
            </h2>
            <div class="h-1 w-16 bg-neon mx-auto mt-6 rounded-full shadow-[0_0_15px_rgba(204,255,0,0.5)]"></div>
            <p class="text-gray-400 mt-4 text-sm md:text-base max-w-2xl mx-auto tracking-widest uppercase font-semibold">
                Update status stok raket secara real-time.
            </p>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="bg-neon/10 border border-neon/30 text-neon px-6 py-4 rounded-2xl mb-12 text-center font-bold backdrop-blur-sm shadow-[0_0_15px_rgba(204,255,0,0.1)] max-w-2xl mx-auto flex items-center justify-center">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- GRID RAKET --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($raket as $r)
            @php
                $hargaRaket = $r->harga ?? $r->id;
            @endphp
            
            <div class="group bg-darkCard rounded-[2rem] p-4 transition-all duration-500 flex flex-col relative overflow-hidden {{ $hargaRaket >= 25000 ? 'border border-neon/40 shadow-[0_0_20px_rgba(204,255,0,0.05)] md:-translate-y-2 hover:border-neon' : 'border border-white/10 hover:border-white/30' }}">
                
                {{-- Efek Premium --}}
                @if($hargaRaket >= 25000)
                    <div class="absolute top-0 left-0 w-full h-1 bg-neon z-20"></div>
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-neon/20 rounded-full blur-[20px] z-0"></div>
                @endif

                {{-- Status Label --}}
                <div class="absolute top-6 right-6 z-20">
                    @if($r->status == 'tersedia')
                        <span class="bg-neon/10 text-neon px-3 py-1.5 rounded-lg text-[10px] font-black tracking-widest uppercase backdrop-blur-md border border-neon/30 shadow-[0_0_10px_rgba(204,255,0,0.2)]">Ready</span>
                    @else
                        <span class="bg-red-500/10 text-red-500 px-3 py-1.5 rounded-lg text-[10px] font-black tracking-widest uppercase backdrop-blur-md border border-red-500/30 shadow-[0_0_10px_rgba(239,68,68,0.2)]">Dipinjam</span>
                    @endif
                </div>

                {{-- Gambar Raket --}}
<div class="aspect-square overflow-hidden rounded-2xl mb-5 bg-[#0a0a0a] flex items-center justify-center p-4 relative border border-white/5 z-10">
    <img src="{{ asset('images/raket' . $loop->iteration . '.jpg') }}" class="max-h-full group-hover:rotate-12 group-hover:scale-110 transition duration-500 grayscale group-hover:grayscale-0 drop-shadow-[0_10px_15px_rgba(255,255,255,0.05)]" alt="{{ $r->nama }}">
</div>
                
                {{-- Info Raket --}}
                <div class="flex-grow px-1 z-10">
                    <h5 class="font-bold text-white text-sm md:text-base mb-1">{{ $r->nama }}</h5>
                    <p class="{{ $hargaRaket >= 25000 ? 'text-neon font-bold' : 'text-gray-400 font-semibold' }} text-sm mt-1">
                        Rp {{ number_format($hargaRaket, 0, ',', '.') }} <span class="text-xs font-normal text-gray-600">/ Sesi</span>
                    </p>
                </div>

                {{-- Form Update Status --}}
                <form action="{{ url('/admin/raket/'.$r->id.'/update') }}" method="POST" class="mt-5 pt-4 border-t border-white/10 flex flex-col gap-3 z-10 px-1">
                    @csrf
                    <select name="status" class="w-full p-3 bg-[#0a0a0a] text-white border border-white/10 rounded-xl text-xs font-bold outline-none focus:border-neon focus:ring-1 focus:ring-neon appearance-none cursor-pointer transition-all">
                        <option value="tersedia" {{ $r->status == 'tersedia' ? 'selected' : '' }}>🟢 Tersedia</option>
                        <option value="disewa" {{ $r->status == 'disewa' ? 'selected' : '' }}>🔴 Dipinjam</option>
                    </select>
                    <button type="submit" class="w-full bg-white/5 border border-white/10 text-white hover:bg-neon hover:text-black hover:border-neon font-bold py-3 rounded-xl transition-all duration-300 shadow-sm hover:shadow-[0_0_20px_rgba(204,255,0,0.3)] text-xs uppercase tracking-widest mt-1">
                        Update
                    </button>
                </form>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection