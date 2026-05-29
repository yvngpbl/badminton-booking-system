@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>
    <a href="#" class="text-indigo-600 hover:underline mb-8 inline-block">Lihat Data Booking</a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 border-l-4 border-l-blue-500">
            <h3 class="text-gray-500 text-sm font-semibold uppercase tracking-wider mb-2">Pemasukan Hari Ini</h3>
            <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($hariIni, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 border-l-4 border-l-green-500">
            <h3 class="text-gray-500 text-sm font-semibold uppercase tracking-wider mb-2">Pemasukan Minggu Ini</h3>
            <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($mingguIni, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 border-l-4 border-l-purple-500">
            <h3 class="text-gray-500 text-sm font-semibold uppercase tracking-wider mb-2">Pemasukan Bulan Ini</h3>
            <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($bulanIni, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
@endsection