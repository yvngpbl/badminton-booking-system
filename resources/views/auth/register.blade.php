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
    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-indigo-600/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        {{-- Ikon Registrasi dengan Efek Glowing --}}
        <div class="mx-auto w-20 h-20 bg-neon/10 border border-neon/30 rounded-3xl flex items-center justify-center shadow-[0_0_20px_rgba(204,255,0,0.15)] mb-8 relative">
            <div class="absolute inset-0 bg-neon/20 blur-xl rounded-3xl"></div>
            <svg class="w-10 h-10 text-neon relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="text-center text-3xl md:text-4xl font-extrabold text-white tracking-tight uppercase">
            Buat <span class="text-neon">Akun Baru</span>
        </h2>
        <p class="mt-3 text-center text-sm text-gray-400">
            Bergabunglah untuk mulai memesan lapangan favorit Anda.
        </p>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <div class="bg-darkCard/80 backdrop-blur-xl py-10 px-6 shadow-2xl border border-white/10 sm:rounded-[2.5rem] sm:px-10 relative overflow-hidden">
            
            {{-- Aksen Sudut Kaca --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-[40px] pointer-events-none"></div>

            {{-- NOTIFIKASI ERROR (Jika validasi gagal) --}}
            @if($errors->any())
            <div class="mb-8 p-5 bg-red-500/10 border border-red-500/30 rounded-2xl backdrop-blur-sm shadow-[0_0_15px_rgba(239,68,68,0.1)]">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-red-500 font-bold uppercase tracking-wider mb-1">Pendaftaran Gagal!</p>
                        <ul class="list-disc list-inside text-xs text-red-400 italic space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            {{-- FORM REGISTER --}}
            <form action="{{ url('/register') }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                
                {{-- Input Nama --}}
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required 
                            class="appearance-none block w-full px-5 py-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl shadow-sm placeholder-gray-600 focus:outline-none focus:border-neon focus:ring-1 focus:ring-neon sm:text-sm transition-all"
                            placeholder="Ahmad Zaky">
                    </div>
                </div>

                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                            class="appearance-none block w-full px-5 py-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl shadow-sm placeholder-gray-600 focus:outline-none focus:border-neon focus:ring-1 focus:ring-neon sm:text-sm transition-all"
                            placeholder="zaky@example.com">
                    </div>
                </div>

                {{-- Input Password --}}
                <div>
                    <label for="password" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required 
                            class="appearance-none block w-full px-5 py-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl shadow-sm placeholder-gray-600 focus:outline-none focus:border-neon focus:ring-1 focus:ring-neon sm:text-sm transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center py-4 px-4 rounded-2xl shadow-[0_0_20px_rgba(204,255,0,0.2)] text-sm font-black text-black bg-neon hover:bg-lime-400 hover:shadow-[0_0_30px_rgba(204,255,0,0.4)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-darkBg focus:ring-neon transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center relative z-10 border-t border-white/10 pt-6">
                <p class="text-sm text-gray-400">
                    Sudah punya akun? 
                    <a href="{{ url('/login') }}" class="font-bold text-neon hover:text-white transition uppercase tracking-wide ml-1">
                        Masuk di sini
                    </a>
                </p>
            </div>
            
        </div>
    </div>
</div>
@endsection