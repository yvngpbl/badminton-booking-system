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

<div class="min-h-screen bg-darkBg flex flex-col justify-center py-12 sm:px-6 lg:px-8 selection:bg-neon selection:text-black relative overflow-hidden">
    
    {{-- Cahaya Glowing di Background --}}
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-indigo-600/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        {{-- Logo atau Ikon dengan Efek Glowing --}}
        <div class="mx-auto w-20 h-20 bg-neon/10 border border-neon/30 rounded-3xl flex items-center justify-center shadow-[0_0_20px_rgba(204,255,0,0.15)] mb-8 relative">
            <div class="absolute inset-0 bg-neon/20 blur-xl rounded-3xl"></div>
            <svg class="w-10 h-10 text-neon relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <h2 class="text-center text-3xl md:text-4xl font-extrabold text-white tracking-tight uppercase">
            Selamat Datang <span class="text-neon">Kembali</span>
        </h2>
        <p class="mt-3 text-center text-sm text-gray-400">
            Silakan login untuk mengelola pesanan Anda
        </p>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <div class="bg-darkCard/80 backdrop-blur-xl py-10 px-6 shadow-2xl border border-white/10 sm:rounded-[2.5rem] sm:px-10 relative overflow-hidden">
            
            {{-- Aksen Sudut Kaca --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-[40px] pointer-events-none"></div>

            {{-- NOTIFIKASI ERROR --}}
            @if($errors->any())
            <div class="mb-8 p-4 bg-red-500/10 border border-red-500/30 rounded-2xl animate-pulse backdrop-blur-sm shadow-[0_0_15px_rgba(239,68,68,0.1)]">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-red-500 font-bold uppercase tracking-wider">Gagal Masuk!</p>
                        <p class="text-xs text-red-400 italic mt-0.5">{{ $errors->first() }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- NOTIFIKASI BERHASIL --}}
            @if(session('success'))
            <div class="mb-8 p-4 bg-neon/10 border border-neon/30 rounded-2xl backdrop-blur-sm shadow-[0_0_15px_rgba(204,255,0,0.1)]">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-neon mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-neon font-bold">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            {{-- FORM LOGIN --}}
            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                            class="appearance-none block w-full px-5 py-4 bg-[#0a0a0a] text-white border @error('email') border-red-500 ring-1 ring-red-500/50 @else border-white/10 @enderror rounded-2xl shadow-sm placeholder-gray-600 focus:outline-none focus:border-neon focus:ring-1 focus:ring-neon sm:text-sm transition-all"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required 
                            class="appearance-none block w-full px-5 py-4 bg-[#0a0a0a] text-white border @error('password') border-red-500 ring-1 ring-red-500/50 @else border-white/10 @enderror rounded-2xl shadow-sm placeholder-gray-600 focus:outline-none focus:border-neon focus:ring-1 focus:ring-neon sm:text-sm transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center group cursor-pointer">
                        <input id="remember_me" name="remember" type="checkbox" class="h-5 w-5 bg-[#0a0a0a] border-white/20 text-neon rounded focus:ring-neon focus:ring-offset-darkBg transition-colors cursor-pointer">
                        <label for="remember_me" class="ml-3 block text-sm text-gray-400 group-hover:text-white transition-colors cursor-pointer">Ingat saya</label>
                    </div>
                    <a href="#" class="text-xs text-neon hover:text-white transition-colors font-semibold tracking-wide">Lupa Password?</a>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center py-4 px-4 rounded-2xl shadow-[0_0_20px_rgba(204,255,0,0.2)] text-sm font-black text-black bg-neon hover:bg-lime-400 hover:shadow-[0_0_30px_rgba(204,255,0,0.4)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-darkBg focus:ring-neon transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-10">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/10"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-[#111111] text-gray-500 text-xs tracking-widest uppercase font-semibold">Belum punya akun?</span>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ url('/register') }}" 
                        class="w-full inline-flex justify-center py-4 px-4 border border-white/10 rounded-2xl shadow-sm bg-white/5 text-sm font-bold text-gray-300 hover:bg-neon hover:text-black hover:border-neon transition-all uppercase tracking-widest">
                        Daftar Akun Baru
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection