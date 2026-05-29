<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Booking Arena</title>
    
    {{-- Memanggil Font Premium (Anton & Inter) agar senada dengan halaman konten --}}
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    {{-- Memanggil Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Konfigurasi Warna Tema agar seragam dengan halaman konten --}}
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              'anton': ['Anton', 'sans-serif'],
              'inter': ['Inter', 'sans-serif'],
            },
            colors: {
              brandOrange: '#FF5000', // Oranye premium
              brandDark: '#0D0F12',   // Hitam elegan
              brandGray: '#F3F4F6',
            }
          }
        }
      }
    </script>

    <style>
        /* Efek scrollbar yang lebih elegan dan modern menyesuaikan tema terang */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #FAFAFA; 
        }
        ::-webkit-scrollbar-thumb {
            background: #D1D5DB; 
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #FF5000; 
        }
    </style>
</head>
<body class="bg-[#FAFAFA] text-brandDark font-inter antialiased selection:bg-brandOrange selection:text-white min-h-screen flex flex-col">

    {{-- NAVBAR GLASSMORPHISM (Clean Premium Look) --}}
    <nav class="fixed w-full z-50 top-0 bg-white/80 backdrop-blur-xl border-b border-gray-200 shadow-sm transition-all duration-300">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                {{-- LOGO / BRAND --}}
                <div class="flex-shrink-0 flex items-center gap-3 mr-8">
                    <div class="w-8 h-8 rounded-full bg-brandOrange flex items-center justify-center text-white font-black text-xs shadow-[0_5px_15px_rgba(255,80,0,0.3)]">
                        BA
                    </div>
                    <span class="font-anton text-2xl tracking-wide uppercase text-brandDark hidden sm:block mt-1">
                        Arena<span class="text-brandOrange">.</span>
                    </span>
                </div>

                {{-- MENU LINKS --}}
                <div class="flex-1 flex space-x-1 md:space-x-2 overflow-x-auto py-2 no-scrollbar">
                    @if(Auth::check())
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ url('/admin/dashboard') }}" class="text-sm font-semibold text-gray-500 hover:text-brandOrange hover:bg-orange-50 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Dashboard Admin</a>
                            <a href="{{ url('/admin/bookings') }}" class="text-sm font-semibold text-gray-500 hover:text-brandOrange hover:bg-orange-50 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Data Booking</a>
                            <a href="{{ url('/admin/lapangan') }}" class="text-sm font-semibold text-gray-500 hover:text-brandOrange hover:bg-orange-50 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Kelola Lapangan</a>
                            <a href="{{ url('/admin/raket') }}" class="text-sm font-semibold text-gray-500 hover:text-brandOrange hover:bg-orange-50 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Kelola Raket</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-500 hover:text-brandOrange hover:bg-orange-50 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Dashboard</a>
                            <a href="{{ url('/lapangan') }}" class="text-sm font-semibold text-gray-500 hover:text-brandOrange hover:bg-orange-50 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Daftar Lapangan</a>
                            <a href="{{ url('/booking') }}" class="text-sm font-semibold text-gray-500 hover:text-brandOrange hover:bg-orange-50 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Booking Sekarang</a>
                            <a href="{{ url('/history') }}" class="text-sm font-semibold text-gray-500 hover:text-brandOrange hover:bg-orange-50 px-4 py-2 rounded-full transition-all duration-300 whitespace-nowrap">Riwayat Saya</a>
                        @endif
                    @endif
                </div>

                {{-- USER INFO & LOGOUT --}}
                <div class="flex items-center space-x-4 ml-4">
                    @if(Auth::check())
                        <span class="text-sm text-gray-500 hidden md:block font-medium">
                            Halo, <b class="text-brandDark font-bold">{{ Auth::user()->name }}</b>
                        </span>
                        <a href="{{ url('/logout') }}" class="bg-red-50 text-red-500 border border-red-200 hover:bg-red-500 hover:text-white px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 shadow-sm hover:shadow-md">
                            Logout
                        </a>
                    @else
                        <a href="{{ url('/login') }}" class="bg-brandDark text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-brandOrange hover:shadow-[0_10px_20px_rgba(255,80,0,0.3)] transition-all duration-300 hover:-translate-y-0.5">
                            Login
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    {{-- pt-28 untuk memberi ruang agar konten tidak tertutup navbar yang fixed --}}
    <main class="flex-grow pt-28 pb-12 w-full">
        {{-- Disesuaikan max-width nya menjadi 1400px agar klop dengan lebar section hero di halaman konten --}}
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
            @yield('content')
        </div>
    </main>

</body>
</html>