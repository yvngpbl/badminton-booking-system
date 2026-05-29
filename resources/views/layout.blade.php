<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Booking Arena</title>
    
    {{-- Memanggil Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Konfigurasi Warna Tema agar seragam dengan halaman depan --}}
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              darkBg: '#050505',
              darkNav: '#0a0a0a',
              neonLime: '#a3e635',
            }
          }
        }
      }
    </script>

    <style>
        /* Efek scrollbar yang lebih elegan untuk dark mode */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #050505; 
        }
        ::-webkit-scrollbar-thumb {
            background: #333; 
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a3e635; 
        }
    </style>
</head>
<body class="bg-darkBg text-white font-sans antialiased selection:bg-neonLime selection:text-black min-h-screen flex flex-col">

    {{-- NAVBAR GLASSMORPHISM --}}
    <nav class="fixed w-full z-50 top-0 bg-darkNav/70 backdrop-blur-xl border-b border-white/10 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                {{-- LOGO / BRAND (Tambahan visual murni, tanpa fungsi khusus) --}}
                <div class="flex-shrink-0 flex items-center gap-2 mr-8">
                    <div class="w-8 h-8 rounded-full bg-neonLime flex items-center justify-center text-black font-black text-xs shadow-[0_0_15px_rgba(163,230,53,0.4)]">
                        BA
                    </div>
                    <span class="font-bold text-xl tracking-tight text-white hidden sm:block">
                        Arena<span class="text-neonLime">.</span>
                    </span>
                </div>

                {{-- MENU LINKS --}}
                <div class="flex-1 flex space-x-1 md:space-x-2 overflow-x-auto py-2 no-scrollbar">
                    @if(Auth::check())
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ url('/admin/dashboard') }}" class="text-sm font-semibold text-gray-400 hover:text-neonLime hover:bg-white/5 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Dashboard Admin</a>
                            <a href="{{ url('/admin/bookings') }}" class="text-sm font-semibold text-gray-400 hover:text-neonLime hover:bg-white/5 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Data Booking</a>
                            <a href="{{ url('/admin/lapangan') }}" class="text-sm font-semibold text-gray-400 hover:text-neonLime hover:bg-white/5 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Kelola Lapangan</a>
                            <a href="{{ url('/admin/raket') }}" class="text-sm font-semibold text-gray-400 hover:text-neonLime hover:bg-white/5 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Kelola Raket</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-400 hover:text-neonLime hover:bg-white/5 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Dashboard</a>
                            <a href="{{ url('/lapangan') }}" class="text-sm font-semibold text-gray-400 hover:text-neonLime hover:bg-white/5 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Daftar Lapangan</a>
                            <a href="{{ url('/booking') }}" class="text-sm font-semibold text-gray-400 hover:text-neonLime hover:bg-white/5 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Booking Sekarang</a>
                            <a href="{{ url('/history') }}" class="text-sm font-semibold text-gray-400 hover:text-neonLime hover:bg-white/5 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Riwayat Saya</a>
                        @endif
                    @endif
                </div>

                {{-- USER INFO & LOGOUT --}}
                <div class="flex items-center space-x-4 ml-4">
                    @if(Auth::check())
                        <span class="text-sm text-gray-400 hidden md:block">
                            Halo, <b class="text-white">{{ Auth::user()->name }}</b>
                        </span>
                        <a href="{{ url('/logout') }}" class="bg-red-500/10 text-red-500 border border-red-500/30 hover:bg-red-500 hover:text-white px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 shadow-[0_0_15px_rgba(239,68,68,0)] hover:shadow-[0_0_15px_rgba(239,68,68,0.4)]">
                            Logout
                        </a>
                    @else
                        <a href="{{ url('/login') }}" class="bg-neonLime text-black px-6 py-2 rounded-full text-sm font-bold hover:bg-[#8cc627] transition-all shadow-[0_0_15px_rgba(163,230,53,0.3)]">
                            Login
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    {{-- pt-28 untuk memberi ruang agar konten tidak tertutup navbar yang fixed --}}
    <main class="flex-grow pt-28 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            @yield('content')
        </div>
    </main>

</body>
</html>