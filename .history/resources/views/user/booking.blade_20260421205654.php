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

<style>
  /* Kustomisasi kalender/date picker agar icon-nya terlihat di dark mode */
  ::-webkit-calendar-picker-indicator {
      filter: invert(1);
      cursor: pointer;
  }
</style>

<div class="min-h-screen bg-darkBg py-12 px-4 selection:bg-neon selection:text-black relative overflow-hidden pt-10 pb-24">
    
    {{-- Cahaya Glowing di Background --}}
    <div class="absolute top-[10%] left-[-10%] w-96 h-96 bg-neon/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative z-10">
        
        {{-- Header Form --}}
        <div class="mb-12">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight uppercase">
                Reservasi <span class="text-neon">Arena</span>
            </h2>
            <div class="h-1 w-16 bg-neon mt-4 rounded-full shadow-[0_0_15px_rgba(204,255,0,0.5)]"></div>
        </div>

        {{-- BLOK NOTIFIKASI ERROR (Diselaraskan dengan Dark Mode) --}}
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-4 mb-8 rounded-2xl shadow-[0_0_20px_rgba(239,68,68,0.1)] backdrop-blur-md">
                <p class="font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Gagal Booking!
                </p>
                <p class="mt-1 text-sm">{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ url('/booking') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                {{-- KIRI: FORM INPUT --}}
                <div class="lg:col-span-8 space-y-8">
                    
                    {{-- Blok 1: Informasi Reservasi --}}
                    <div class="bg-darkCard rounded-[2.5rem] shadow-2xl p-8 border border-white/10 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-[40px] pointer-events-none"></div>
                        
                        <h2 class="text-2xl font-bold text-white mb-8 flex items-center">
                            <span class="bg-neon w-2 h-6 rounded-full mr-3 shadow-[0_0_10px_rgba(204,255,0,0.5)]"></span>
                            Informasi Reservasi
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- INPUT NAMA PEMESAN --}}
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Pemesan</label>
                                <input type="text" name="nama_pemesan" required placeholder="Masukkan nama lengkap" 
                                    class="w-full p-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl outline-none focus:border-neon focus:ring-1 focus:ring-neon transition-all"
                                    value="{{ old('nama_pemesan') }}">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pilih Lapangan</label>
                                <select id="select-lapangan" name="lapangan_id" class="w-full p-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl outline-none focus:border-neon focus:ring-1 focus:ring-neon transition-all appearance-none cursor-pointer">
                                    <option value="35000" data-name="Lapangan Semen Flat" {{ old('lapangan_id') == '35000' ? 'selected' : '' }}>Standar - Rp 35.000/Jam</option>
                                    <option value="50000" data-name="Vinyl Interlock Pro" {{ old('lapangan_id') == '50000' || !old('lapangan_id') ? 'selected' : '' }}>Pro - Rp 50.000/Jam</option>
                                    <option value="70000" data-name="BWF Premium Arena" {{ old('lapangan_id') == '70000' ? 'selected' : '' }}>Premium - Rp 70.000/Jam</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tanggal Main</label>
                                <input type="date" name="tanggal" required class="w-full p-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl outline-none focus:border-neon focus:ring-1 focus:ring-neon transition-all color-scheme-dark"
                                    value="{{ old('tanggal') }}">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jam Mulai</label>
                                <select id="select-jam" name="jam" class="w-full p-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl outline-none focus:border-neon focus:ring-1 focus:ring-neon transition-all appearance-none cursor-pointer">
                                    @for ($i = 8; $i <= 22; $i++)
                                        @php $timeValue = sprintf('%02d', $i) . ':00'; @endphp
                                        <option value="{{ $timeValue }}" {{ old('jam') == $timeValue ? 'selected' : '' }}>{{ $timeValue }} WIB</option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Durasi (Jam)</label>
                                <input type="number" id="input-durasi" name="durasi" value="{{ old('durasi', 1) }}" min="1" max="5" class="w-full p-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl outline-none focus:border-neon focus:ring-1 focus:ring-neon transition-all">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Sewa Raket</label>
                                <select id="select-raket" name="raket_id" class="w-full p-4 bg-[#0a0a0a] text-white border border-white/10 rounded-2xl outline-none focus:border-neon focus:ring-1 focus:ring-neon transition-all appearance-none cursor-pointer">
                                    <option value="0" data-name="Tanpa Raket" {{ old('raket_id') == '0' ? 'selected' : '' }}>Tidak Sewa</option>
                                    <option value="10000" data-name="Raket Carbon" {{ old('raket_id') == '10000' ? 'selected' : '' }}>Carbon - Rp 10.000</option>
                                    <option value="15000" data-name="Li-Ning" {{ old('raket_id') == '15000' ? 'selected' : '' }}>Li-Ning - Rp 15.000</option>
                                    <option value="20000" data-name="Victor" {{ old('raket_id') == '20000' ? 'selected' : '' }}>Victor - Rp 20.000</option>
                                    <option value="25000" data-name="Yonex Pro" {{ old('raket_id') == '25000' ? 'selected' : '' }}>Yonex Pro - Rp 25.000</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Blok 2: Bukti Pembayaran --}}
                    <div class="bg-darkCard rounded-[2.5rem] shadow-2xl p-8 border border-white/10 relative">
                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <span class="bg-white w-2 h-6 rounded-full mr-3"></span>
                            Bukti Pembayaran
                        </h2>
                        
                        <div class="space-y-4">
                            <div id="preview-container" class="hidden w-full h-64 border border-white/10 rounded-2xl overflow-hidden bg-[#0a0a0a]">
                                <img id="image-preview" src="#" alt="Preview Bukti" class="w-full h-full object-contain">
                            </div>

                            <div class="border-2 border-dashed border-white/20 rounded-2xl p-8 text-center hover:border-neon hover:bg-neon/5 transition-all cursor-pointer relative bg-[#0a0a0a] group">
                                <input type="file" id="input-bukti" name="bukti" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                <div id="upload-instruction">
                                    <svg class="w-12 h-12 text-gray-600 group-hover:text-neon mx-auto mb-4 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-gray-400 font-medium group-hover:text-white transition-colors">Klik atau Drop foto bukti transfer di sini</p>
                                    <p id="file-name" class="text-neon text-sm mt-2 font-bold"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KANAN: RINGKASAN SEWA --}}
                <div class="lg:col-span-4">
                    <div class="bg-gradient-to-b from-white/10 to-darkCard border border-neon/30 rounded-[2.5rem] p-8 text-white shadow-[0_0_30px_rgba(204,255,0,0.05)] sticky top-32 backdrop-blur-xl">
                        <div class="absolute top-0 left-0 w-full h-1 bg-neon"></div>
                        
                        <h3 class="text-2xl font-bold mb-6 border-b border-white/10 pb-4 tracking-wide">Ringkasan Sewa</h3>
                        
                        <div class="space-y-5 text-sm">
                            <div class="flex justify-between items-start">
                                <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Lapangan</span>
                                <span id="summary-lapangan" class="font-bold text-right ml-4 text-neon">...</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Jadwal</span>
                                <span id="summary-jadwal" class="font-bold text-right text-white">...</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Durasi</span>
                                <span id="summary-durasi" class="font-bold text-white">...</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-gray-400 font-semibold uppercase tracking-wider text-xs">Alat</span>
                                <span id="summary-raket" class="font-bold text-white text-right">...</span>
                            </div>
                            
                            <hr class="border-white/10 my-6">
                            
                            <div class="flex justify-between items-end">
                                <span class="text-gray-400 font-bold uppercase tracking-wider text-xs mb-1">Total Bayar</span>
                                <span id="total-harga" class="text-4xl font-black text-neon">Rp 0</span>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-neon text-black hover:bg-lime-400 font-black py-4 rounded-2xl mt-10 transition-all shadow-[0_0_20px_rgba(204,255,0,0.3)] hover:shadow-[0_0_30px_rgba(204,255,0,0.5)] hover:-translate-y-1 text-lg uppercase tracking-widest">
                            Konfirmasi
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const selLapangan = document.getElementById('select-lapangan');
    const selJam = document.getElementById('select-jam');
    const inpDurasi = document.getElementById('input-durasi');
    const selRaket = document.getElementById('select-raket');
    
    const inputBukti = document.getElementById('input-bukti');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const fileNameDisplay = document.getElementById('file-name');

    function updateSummary() {
        let hargaLapangan = parseInt(selLapangan.value);
        let hargaRaket = parseInt(selRaket.value);
        let durasi = parseInt(inpDurasi.value) || 1;
        
        let namaLapangan = selLapangan.options[selLapangan.selectedIndex].getAttribute('data-name');
        let namaRaket = selRaket.options[selRaket.selectedIndex].getAttribute('data-name');

        document.getElementById('summary-lapangan').innerText = namaLapangan;
        document.getElementById('summary-jadwal').innerText = selJam.value + " WIB";
        document.getElementById('summary-durasi').innerText = durasi + " Jam";
        document.getElementById('summary-raket').innerText = namaRaket;

        let total = (hargaLapangan * durasi) + hargaRaket;
        document.getElementById('total-harga').innerText = "Rp " + total.toLocaleString('id-ID');
    }

    inputBukti.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            fileNameDisplay.innerText = "File terpilih: " + file.name;
            reader.addEventListener('load', function() {
                previewContainer.classList.remove('hidden');
                imagePreview.setAttribute('src', this.result);
            });
            reader.readAsDataURL(file);
        }
    });

    [selLapangan, selJam, inpDurasi, selRaket].forEach(el => {
        el.addEventListener('change', updateSummary);
        el.addEventListener('input', updateSummary);
    });

    // Panggil saat pertama kali load
    updateSummary();
</script>
@endsection