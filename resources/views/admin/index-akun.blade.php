@extends('admin.app-admin')
@section('ketjudul')
Dashboard
@endsection

@section('judul')
Ringkasan E-Learning UNWIR
@endsection

@section('content')
@php
  $mataKuliah = [
    ['kode' => 'IF301', 'nama' => 'Pemrograman Web Lanjut', 'dosen' => 'Dr. Andi Saputra, M.Kom', 'sks' => 3, 'status' => 'Aktif'],
    ['kode' => 'IF302', 'nama' => 'Basis Data Terdistribusi', 'dosen' => 'Rina Wulandari, M.T', 'sks' => 3, 'status' => 'Aktif'],
    ['kode' => 'IF303', 'nama' => 'Kecerdasan Buatan', 'dosen' => 'Prof. Bambang Hartono', 'sks' => 4, 'status' => 'Aktif'],
    ['kode' => 'IF304', 'nama' => 'Jaringan Komputer', 'dosen' => 'Fajar Nugroho, M.Kom', 'sks' => 2, 'status' => 'Nonaktif'],
    ['kode' => 'IF305', 'nama' => 'Rekayasa Perangkat Lunak', 'dosen' => 'Dewi Lestari, M.T', 'sks' => 3, 'status' => 'Aktif'],
  ];
@endphp



  <!-- Header Card -->
  <div class="flex items-center justify-between mb-5">
    <div>
      <h2 class="font-display text-lg font-semibold">Mata Kuliah Terbaru</h2>
      <p class="text-sm text-ink/50 mt-0.5">Daftar mata kuliah yang baru ditambahkan</p>
    </div>
    <a href="#" class="text-sm font-medium text-teal hover:underline">Lihat Semua</a>
  </div>

  <!-- Tabel -->
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead>
        <tr class="border-b border-line text-left">
          <th class="py-3 pr-4 font-medium text-ink/50 font-mono text-xs uppercase tracking-wide">Kode</th>
          <th class="py-3 pr-4 font-medium text-ink/50 font-mono text-xs uppercase tracking-wide">Mata Kuliah</th>
          <th class="py-3 pr-4 font-medium text-ink/50 font-mono text-xs uppercase tracking-wide">Dosen</th>
          <th class="py-3 pr-4 font-medium text-ink/50 font-mono text-xs uppercase tracking-wide">SKS</th>
          <th class="py-3 pr-4 font-medium text-ink/50 font-mono text-xs uppercase tracking-wide">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($mataKuliah as $mk)
        <tr class="border-b border-line last:border-0 hover:bg-paper/60 transition-colors">
          <td class="py-3 pr-4 font-mono text-xs text-ink/60">{{ $mk['kode'] }}</td>
          <td class="py-3 pr-4 font-medium">{{ $mk['nama'] }}</td>
          <td class="py-3 pr-4 text-ink/70">{{ $mk['dosen'] }}</td>
          <td class="py-3 pr-4 text-ink/70">{{ $mk['sks'] }}</td>
          <td class="py-3 pr-4">
            @if ($mk['status'] === 'Aktif')
              <span class="text-xs font-mono px-2 py-1 rounded-full bg-teal/10 text-teal">Aktif</span>
            @else
              <span class="text-xs font-mono px-2 py-1 rounded-full bg-ink/10 text-ink/50">Nonaktif</span>
            @endif
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="py-6 text-center text-ink/40 text-sm">Belum ada data mata kuliah.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>


@endsection