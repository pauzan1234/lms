@extends('lecturer.app-lecturer')
@section('ketjudul')
Dashboard
@endsection

@section('judul')
Daftar Mata Kuliah
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 px-6 py-8">

    <div class="mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">
                Pengajaran
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Daftar mata kuliah dan dosen pengajar.
            </p>
        </div>


        {{-- Card Mata Kuliah --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($pengajaran as $item)

            <a href="{{ route('pengajaran.show', $item->id) }}"
                class="block rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">

                {{-- Nama Mata Kuliah --}}
                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $item->matakuliah->nama_mk }}
                </h2>

                {{-- Kode Mata Kuliah --}}
                <p class="mt-1 text-sm text-gray-500">
                    {{ $item->kode_mk }}
                </p>

                <div class="my-4 border-t border-gray-100"></div>

                {{-- Dosen --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                        Dosen Pengajar
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-700">
                        {{ $item->lecturer->nama }}
                    </p>
                </div>

            </a>

            @empty

            <div class="col-span-full rounded-xl border border-dashed border-gray-300 bg-white p-10 text-center">

                <p class="text-gray-500">
                    Belum ada data pengajaran.
                </p>

            </div>

            @endforelse

        </div>

    </div>

</div>

@endsection