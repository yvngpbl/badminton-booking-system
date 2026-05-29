@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Manajemen Booking</h2>

    {{-- Notifikasi Sukses --}}
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
                    <td class="p-3 border font-semibold">{{ $b->nama_pemesan }}</td>
                    <td class="p-3 border text-sm">
                        {{ $b->lapangan->nama_lapangan ?? 'Lapangan' }}<br>
                        <span class="text-gray-500">{{ $b->tanggal }}</span>
                    </td>
                    <td class="p-3 border text-center">
                        <a href="{{ asset('storage/'.$b->bukti) }}" target="_blank" class="text-blue-600 hover:underline font-bold text-sm">
                            Lihat Foto
                        </a>
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
                        @if($b->status == 'selesai')
                        <form action="{{ url('/admin/bookings/'.$b->id.'/delete') }}" method="POST" class="mt-2 text-center" onsubmit="return confirm('Arsipkan data ini dari tabel? (Pemasukan tetap dihitung)');">
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