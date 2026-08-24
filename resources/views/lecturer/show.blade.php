@extends('lecturer.app-lecturer')

@section('ketjudul')
Mata Kuliah
@endsection

@section('judul')
Kelola materi, tugas, kuis, dan aktivitas pembelajaran mahasiswa.
@endsection

@section('content')

<div class="bg-paper">

    {{-- =========================================================
        HEADER MATA KULIAH
    ========================================================== --}}
    <div class="border-b border-line bg-white">

        <div class="mx-auto max-w-7xl px-6 py-8">

            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">

                <div>

                    {{-- Label --}}
                    <div class="mb-3">
                        <span
                            class="font-mono text-[11px] font-medium uppercase tracking-[0.15em] text-ink/45">
                            Mata Kuliah
                        </span>
                    </div>

                    {{-- Nama Mata Kuliah --}}
                    <h1 class="font-display text-3xl font-semibold tracking-tight text-ink">
                        {{ $pengajaran->matakuliah->nama_mk }}
                    </h1>

  

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="mx-auto max-w-7xl px-6 py-8">

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">


            {{-- =================================================
                LEFT CONTENT
            ================================================== --}}
            <div class="lg:col-span-2">


                {{-- =================================================
                    NAVIGATION
                ================================================== --}}
                <div class="mb-6 overflow-x-auto">

                    <div class="flex min-w-max gap-1 rounded-xl border border-line bg-white p-1">

                        {{-- Materi --}}
                        <a href="#materi"
                            class="rounded-lg bg-ink px-4 py-2.5 text-sm font-semibold text-white">
                            Materi
                        </a>

                        {{-- Tugas --}}
                        <a href="#tugas"
                            class="rounded-lg px-4 py-2.5 text-sm font-medium text-ink/60
                                   transition hover:bg-paper hover:text-ink">
                            Tugas
                        </a>

                        {{-- Quiz --}}
                        <a href="#quiz"
                            class="rounded-lg px-4 py-2.5 text-sm font-medium text-ink/60
                                   transition hover:bg-paper hover:text-ink">
                            Quiz
                        </a>

                        {{-- Mahasiswa --}}
                        <a href="#mahasiswa"
                            class="rounded-lg px-4 py-2.5 text-sm font-medium text-ink/60
                                   transition hover:bg-paper hover:text-ink">
                            Mahasiswa
                        </a>

                    </div>

                </div>


                {{-- =================================================
                    MATERI
                ================================================== --}}
                <div id="materi"
                    class="overflow-hidden rounded-2xl border border-line bg-white shadow-sm">

                    {{-- Header Materi --}}
                    <div
                        class="flex flex-col justify-between gap-4 border-b border-line p-6
                               sm:flex-row sm:items-center">

                        <div>

                            <h2 class="font-display text-lg font-semibold text-ink">
                                Materi Pembelajaran
                            </h2>

                            <p class="mt-1 text-sm text-ink/50">
                                Kelola materi yang akan diberikan kepada mahasiswa.
                            </p>

                        </div>


                        {{-- Tambah Materi --}}
                        <button
                            type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-lg
                                   bg-ink px-4 py-2.5 text-sm font-semibold text-white
                                   transition hover:bg-primaryDark">

                            <svg class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4" />

                            </svg>

                            Tambah Materi

                        </button>

                    </div>


                    {{-- =================================================
                        LIST MATERI
                    ================================================== --}}
                    <div class="divide-y divide-line">


                        {{-- Materi 1 --}}
                        <div class="flex items-center gap-4 p-5">

                            {{-- Icon --}}
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center
                                       rounded-xl bg-paper text-ink">

                                <svg class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5
                                           S4.168 5.477 3 6.253v13
                                           C4.168 18.477 5.754 18 7.5 18
                                           s3.332.477 4.5 1.253
                                           m0-13C13.168 5.477 14.754 5
                                           16.5 5c1.746 0 3.332.477 4.5 1.253v13
                                           C19.832 18.477 18.246 18 16.5 18
                                           c-1.746 0-3.332.477-4.5 1.253" />

                                </svg>

                            </div>


                            {{-- Informasi --}}
                            <div class="min-w-0 flex-1">

                                <h3 class="truncate text-sm font-semibold text-ink">
                                    Pertemuan 1 — Pengenalan HTML
                                </h3>

                                <p class="mt-1 text-xs text-ink/50">
                                    Materi pembelajaran • PDF
                                </p>

                            </div>


                            {{-- Menu --}}
                            <button
                                class="rounded-lg p-2 text-ink/35
                                       transition hover:bg-paper hover:text-ink">

                                <svg class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01" />

                                </svg>

                            </button>

                        </div>


                        {{-- Materi 2 --}}
                        <div class="flex items-center gap-4 p-5">

                            {{-- Icon --}}
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center
                                       rounded-xl bg-paper text-ink">

                                <svg class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5
                                           S4.168 5.477 3 6.253v13
                                           C4.168 18.477 5.754 18 7.5 18
                                           s3.332.477 4.5 1.253
                                           m0-13C13.168 5.477 14.754 5
                                           16.5 5c1.746 0 3.332.477 4.5 1.253v13
                                           C19.832 18.477 18.246 18 16.5 18
                                           c-1.746 0-3.332.477-4.5 1.253" />

                                </svg>

                            </div>


                            {{-- Informasi --}}
                            <div class="min-w-0 flex-1">

                                <h3 class="truncate text-sm font-semibold text-ink">
                                    Pertemuan 2 — CSS Dasar
                                </h3>

                                <p class="mt-1 text-xs text-ink/50">
                                    Materi pembelajaran • PDF
                                </p>

                            </div>


                            {{-- Menu --}}
                            <button
                                class="rounded-lg p-2 text-ink/35
                                       transition hover:bg-paper hover:text-ink">

                                <svg class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01" />

                                </svg>

                            </button>

                        </div>


                    </div>

                </div>


                {{-- =================================================
                    TUGAS
                ================================================== --}}
                <div id="tugas"
                    class="mt-8 overflow-hidden rounded-2xl border border-line bg-white shadow-sm">

                    {{-- Header --}}
                    <div
                        class="flex flex-col justify-between gap-4 border-b border-line p-6
                               sm:flex-row sm:items-center">

                        <div>

                            <h2 class="font-display text-lg font-semibold text-ink">
                                Tugas
                            </h2>

                            <p class="mt-1 text-sm text-ink/50">
                                Kelola tugas dan pengumpulan mahasiswa.
                            </p>

                        </div>


                        <button
                            class="rounded-lg bg-ink px-4 py-2.5 text-sm font-semibold text-white
                                   transition hover:bg-primaryDark">

                            + Tambah Tugas

                        </button>

                    </div>


                    {{-- Empty State --}}
                    <div class="p-6">

                        <div
                            class="rounded-xl border border-dashed border-line
                                   bg-paper p-8 text-center">

                            <p class="text-sm text-ink/50">
                                Belum ada tugas.
                            </p>

                        </div>

                    </div>

                </div>


            </div>


            {{-- =================================================
                RIGHT SIDEBAR
            ================================================== --}}
            <div class="space-y-6">


                {{-- =================================================
                    AKSI CEPAT
                ================================================== --}}
                <div class="rounded-2xl border border-line bg-white p-6 shadow-sm">

                    <h2 class="font-display text-base font-semibold text-ink">
                        Aksi Cepat
                    </h2>


                    <div class="mt-4 space-y-3">


                        {{-- Tambah Materi --}}
                        <button
                            class="flex w-full items-center gap-3 rounded-xl border border-line
                                   p-3 text-left transition hover:bg-paper">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-lg
                                       bg-paper text-ink">

                                +

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-ink">
                                    Tambah Materi
                                </p>

                                <p class="text-xs text-ink/50">
                                    Upload materi pembelajaran
                                </p>

                            </div>

                        </button>


                        {{-- Tambah Tugas --}}
                        <button
                            class="flex w-full items-center gap-3 rounded-xl border border-line
                                   p-3 text-left transition hover:bg-paper">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-lg
                                       bg-paper text-ink">

                                +

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-ink">
                                    Tambah Tugas
                                </p>

                                <p class="text-xs text-ink/50">
                                    Buat tugas baru
                                </p>

                            </div>

                        </button>


                        {{-- Buat Quiz --}}
                        <button
                            class="flex w-full items-center gap-3 rounded-xl border border-line
                                   p-3 text-left transition hover:bg-paper">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-lg
                                       bg-paper text-ink">

                                +

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-ink">
                                    Buat Quiz
                                </p>

                                <p class="text-xs text-ink/50">
                                    Tambahkan quiz
                                </p>

                            </div>

                        </button>


                    </div>

                </div>


                {{-- =================================================
                    RINGKASAN
                ================================================== --}}
                <div class="rounded-2xl border border-line bg-white p-6 shadow-sm">

                    <h2 class="font-display text-base font-semibold text-ink">
                        Ringkasan
                    </h2>


                    <div class="mt-5 space-y-4">


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-ink/50">
                                Materi
                            </span>

                            <span class="font-semibold text-ink">
                                2
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-ink/50">
                                Tugas
                            </span>

                            <span class="font-semibold text-ink">
                                0
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-ink/50">
                                Quiz
                            </span>

                            <span class="font-semibold text-ink">
                                0
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-ink/50">
                                Mahasiswa
                            </span>

                            <span class="font-semibold text-ink">
                                0
                            </span>

                        </div>


                    </div>

                </div>


            </div>

        </div>

    </div>

</div>

@endsection