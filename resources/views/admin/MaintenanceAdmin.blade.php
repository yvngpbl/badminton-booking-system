@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-50 py-12 px-4">
    <div class="max-w-3xl mx-auto">
        
        <div class="mb-8">
            <a href="{{ url('/admin/bookings') }}" class="text-indigo-600 hover:underline font-semibold flex items-center">
                ← Kembali ke Data Booking
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm font-bold">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-800 text-white p-6">
                <h2 class="text-2xl font-bold flex items-center">
                    <svg class="w-6 h-6 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Blokir Jadwal (Maintenance)
                </h2>
                <p class="text-gray-300 text-sm mt-1">Form ini digunakan untuk menutup jadwal agar tidak bisa di-booking oleh User.</p>
            </div>

            <form action="{{ url('/admin/maintenance') }}" method="POST" class="p-8 space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pemesan (Otomatis)</label>
                    <input type="text" value="MAINTENANCE / DIBLOKIR ADMIN" disabled class="w-full p-3 bg-gray-200 text-gray-500 border border-gray-200 rounded-xl font-bold cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Lapangan yang Ingin Ditutup</label>
                    <select name="lapangan_id" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-800">
                        @foreach($lapangan as $l)
                            @php $hargaLap = $l->harga ?? $l->id; @endphp
                            <option value="{{ $hargaLap }}">{{ $l->nama_lapangan ?? $l->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Diblokir</label>
                        <input type="date" name="tanggal" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-800">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Diblokir</label>
                        <select name="jam" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-800">
                            @for ($i = 8; $i <= 22; $i++)
                                <option value="{{ sprintf('%02d', $i) }}:00">{{ sprintf('%02d', $i) }}:00 WIB</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan / Alasan (Opsional)</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Perbaikan net lapangan" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-800">
                </div>

                <button type="submit" class="w-full bg-gray-800 hover:bg-black text-white font-bold py-4 rounded-xl mt-4 transition shadow-md">
                    Kunci Jadwal Ini
                </button>
            </form>
        </div>
    </div>
</div>
@endsection