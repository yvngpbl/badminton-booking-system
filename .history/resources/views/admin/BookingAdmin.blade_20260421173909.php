@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="p-6">
    
    {{-- HEADER DENGAN TOMBOL BLOKIR JADWAL --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Booking</h2>
        
        <a href="{{ url('/admin/maintenance') }}" class="bg-gray-800 hover:bg-black text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            Blokir Jadwal (Maintenance)
        </a>
    </div>

    {{-- Notifikasi Sukses / Error --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow-sm rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">Pemesan</th>
                    <th class="p-3 border">Detail</th>
                    <th class="p-3 border text-center">Bukti</th>
                    <th class="p-3 border">Status & Catatan</th>
                    <th class="p-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $b)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border font-semibold">
                        {{ $b->nama_pemesan }}
                        {{-- Memberikan label khusus jika ini adalah data Maintenance --}}
                        @if($b->nama_pemesan == 'MAINTENANCE / DIBLOKIR ADMIN')
                            <br><span class="bg-red-100 text-red-600 text-[10px] font-bold px-2 py-0.5 rounded-full">SYSTEM</span>
                        @endif
                    </td>
                    <td class="p-3 border text-sm">
                        <span class="font-bold text-gray-800">{{ $b->lapangan->nama_lapangan ?? 'Lapangan' }}</span><br>
                        <span class="text-gray-500">{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }} | {{ $b->jam }} WIB</span><br>
                        
                        {{-- Jika ini maintenance, jangan tampilkan harga --}}
                        @if($b->nama_pemesan != 'MAINTENANCE / DIBLOKIR ADMIN')
                            <span class="text-indigo-600 font-bold mt-1 inline-block">
                                Rp {{ number_format($b->lapangan_id + $b->raket_id, 0, ',', '.') }}
                            </span>
                        @endif
                    </td>
                    <td class="p-3 border text-center">
                        @if($b->nama_pemesan != 'MAINTENANCE / DIBLOKIR ADMIN')
                            <a href="{{ asset('storage/'.$b->bukti) }}" target="_blank" class="text-blue-600 hover:underline font-bold text-sm">
                                Lihat Foto
                            </a>
                        @else
                            <span class="text-gray-400 italic text-xs">-</span>
                        @endif
                    </td>
                    
                    {{-- DEKLARASI FORM UPDATE (Disembunyikan agar tidak merusak tabel) --}}
                    <form action="{{ url('/admin/bookings/'.$b->id.'/update') }}" method="POST" id="update-form-{{ $b->id }}">
                        @csrf
                    </form>

                    <td class="p-3 border">
                        {{-- Atribut form="..." menghubungkan input ini ke form update di atas --}}
                        <select form="update-form-{{ $b->id }}" name="status" class="w-full p-1 border rounded mb-2 text-sm">
                            <option value="pending" {{ $b->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $b->status == 'approved' ? 'selected' : '' }}>Approved (Terima)</option>
                            <option value="cancel" {{ $b->status == 'cancel' ? 'selected' : '' }}>Cancel (Tolak)</option>
                            <option value="selesai" {{ $b->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <input form="update-form-{{ $b->id }}" type="text" name="notes" value="{{ $b->notes }}" 
                               placeholder="Catatan untuk user..." 
                               class="w-full p-1 border rounded text-xs">
                    </td>
                    
                    <td class="p-3 border text-center align-top">
                        {{-- Tombol Simpan dihubungkan ke form update --}}
                        <button form="update-form-{{ $b->id }}" type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm transition w-full mb-2">
                            Simpan
                        </button>

                        {{-- FORM HAPUS (Terpisah dan aman dari nested form) --}}
                        @if($b->status == 'selesai' || $b->nama_pemesan == 'MAINTENANCE / DIBLOKIR ADMIN')
                        <form action="{{ url('/admin/bookings/'.$b->id.'/delete') }}" method="POST" class="mt-2 text-center" onsubmit="return confirm('Arsipkan data ini dari tabel?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded text-sm transition w-full">
                                Hapus / Arsipkan
                            </button>
                        </form>
                        @endif
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection