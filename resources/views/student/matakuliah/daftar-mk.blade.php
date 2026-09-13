@extends('student.app-student')
@section('ketjudul')
Dashboard
@endsection

@section('judul')
Daftar Mata Kuliah
@endsection

@section('content')

<div class="lg:col-span-3">
    @if (session('success'))
    <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    @if (session('info'))
    <div class="mb-4 rounded-lg bg-blue-50 px-4 py-3 text-sm text-blue-700">
        {{ session('info') }}
    </div>
    @endif
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

        @forelse ($mataKuliahs as $mk)
        <div class="flex flex-col rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md hover:border-slate-300">

            {{-- Header --}}
            <div class="flex items-start justify-between gap-3 border-b border-slate-100 px-5 py-4">
                <div>
                    <p class="text-xs font-medium text-slate-400">{{ $mk->kode_mk }}</p>
                    <h3 class="mt-0.5 text-base font-semibold text-slate-900">{{ $mk->nama_mk }}</h3>
                </div>
                <span class="shrink-0 rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-600">
                    {{ $mk->sks }} SKS
                </span>
            </div>

            {{-- Daftar kelas --}}
            <div class="flex-1 divide-y divide-slate-100 px-5">
                @forelse ($mk->kelas as $kelas)
                <div class="flex items-center justify-between gap-3 py-3">
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-slate-700">Kelas {{ $kelas->kode_kelas }}</p>

                        <div class="mt-1 flex items-center gap-1.5 text-xs text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" />
                                <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="truncate">
                                @forelse ($kelas->dosen as $dosen)
                                {{ $dosen->user->name ?? '-'  }}{{ !$loop->last ? ', ' : '' }}
                                @empty
                                Dosen belum ditentukan
                                @endforelse
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('student.matakuliah.ambil', $kelas->id) }}" method="POST" class="shrink-0">
                        @csrf
                        <button
                            type="submit"
                            class="rounded-lg bg-indigo-600 px-3.5 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700 active:bg-indigo-800">
                            Ambil MK ini
                        </button>
                    </form>
                </div>
                @empty
                <p class="py-4 text-sm text-slate-400">Belum ada kelas untuk mata kuliah ini.</p>
                @endforelse
            </div>
        </div>
        @empty
        <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 py-12 text-center">
            <p class="text-sm text-slate-500">Belum ada mata kuliah dengan dosen.</p>
        </div>
        @endforelse


    </div>

</div>

@endsection