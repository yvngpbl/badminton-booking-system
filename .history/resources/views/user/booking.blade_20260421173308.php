@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-50 py-12 px-4">
    <div class="max-w-5xl mx-auto">
        
        {{-- BLOK NOTIFIKASI ERROR (Jika Booking Gagal / Bentrok) --}}
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-sm">
                <p class="font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Gagal Booking!
                </p>
                <p class="mt-1">{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ url('/booking') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <span class="bg-indigo-600 w-2 h-6 rounded-full mr-3"></span>
                            Informasi Reservasi
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- INPUT NAMA PEMESAN --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Pemesan</label>
                                <input type="text" name="nama_pemesan" required placeholder="Masukkan nama lengkap" 
                                    class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500"
                                    value="{{ old('nama_pemesan') }}">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Pilih Lapangan</label>
                                <select id="select-lapangan" name="lapangan_id" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="35000" data-name="Lapangan Semen Flat" {{ old('lapangan_id') == '35000' ? 'selected' : '' }}>Standar - Rp 35.000/Jam</option>
                                    <option value="50000" data-name="Vinyl Interlock Pro" {{ old('lapangan_id') == '50000' || !old('lapangan_id') ? 'selected' : '' }}>Pro - Rp 50.000/Jam</option>
                                    <option value="70000" data-name="BWF Premium Arena" {{ old('lapangan_id') == '70000' ? 'selected' : '' }}>Premium - Rp 70.000/Jam</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Tanggal Main</label>
                                <input type="date" name="tanggal" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500"
                                    value="{{ old('tanggal') }}">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Jam Mulai</label>
                                <select id="select-jam" name="jam" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                                    @for ($i = 8; $i <= 22; $i++)
                                        @php $timeValue = sprintf('%02d', $i) . ':00'; @endphp
                                        <option value="{{ $timeValue }}" {{ old('jam') == $timeValue ? 'selected' : '' }}>{{ $timeValue }} WIB</option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Durasi (Jam)</label>
                                <input type="number" id="input-durasi" name="durasi" value="{{ old('durasi', 1) }}" min="1" max="5" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-2">Sewa Raket</label>
                                <select id="select-raket" name="raket_id" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="0" data-name="Tanpa Raket" {{ old('raket_id') == '0' ? 'selected' : '' }}>Tidak Sewa</option>
                                    <option value="10000" data-name="Raket Carbon" {{ old('raket_id') == '10000' ? 'selected' : '' }}>Carbon - Rp 10rb</option>
                                    <option value="15000" data-name="Li-Ning" {{ old('raket_id') == '15000' ? 'selected' : '' }}>Li-Ning - Rp 15rb</option>
                                    <option value="20000" data-name="Victor" {{ old('raket_id') == '20000' ? 'selected' : '' }}>Victor - Rp 20rb</option>
                                    <option value="25000" data-name="Yonex Pro" {{ old('raket_id') == '25000' ? 'selected' : '' }}>Yonex Pro - Rp 25rb</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <span class="bg-green-500 w-2 h-6 rounded-full mr-3"></span>
                            Bukti Pembayaran
                        </h2>
                        
                        <div class="space-y-4">
                            <div id="preview-container" class="hidden w-full h-64 border-2 border-gray-100 rounded-2xl overflow-hidden bg-gray-50">
                                <img id="image-preview" src="#" alt="Preview Bukti" class="w-full h-full object-contain">
                            </div>

                            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center hover:border-indigo-500 transition cursor-pointer relative bg-gray-50">
                                <input type="file" id="input-bukti" name="bukti" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer">
                                <div id="upload-instruction">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-gray-500 font-medium">Klik untuk upload bukti transfer</p>
                                    <p id="file-name" class="text-indigo-600 text-sm mt-2 font-bold"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-indigo-900 rounded-3xl p-8 text-white shadow-xl sticky top-8">
                        <h3 class="text-xl font-bold mb-6 border-b border-indigo-800 pb-4">Ringkasan Sewa</h3>
                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between items-start">
                                <span class="text-indigo-300">Lapangan:</span>
                                <span id="summary-lapangan" class="font-medium text-right ml-4 italic">-</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-indigo-300">Jadwal:</span>
                                <span id="summary-jadwal" class="font-medium text-right italic">-</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-indigo-300">Durasi:</span>
                                <span id="summary-durasi" class="font-medium">-</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-indigo-300">Alat:</span>
                                <span id="summary-raket" class="font-medium italic">-</span>
                            </div>
                            <hr class="border-indigo-800 my-4">
                            <div class="flex justify-between items-end">
                                <span class="text-indigo-300 font-bold">Total Bayar:</span>
                                <span id="total-harga" class="text-3xl font-black text-yellow-400">Rp 0</span>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-indigo-900 font-black py-4 rounded-2xl mt-8 transition-all shadow-lg transform hover:scale-105">
                            Konfirmasi Booking
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
        document.getElementById('summary-jadwal').innerText = selJam.value;
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

    updateSummary();
</script>
@endsection