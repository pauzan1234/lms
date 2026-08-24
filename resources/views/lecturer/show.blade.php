@extends('lecturer.app-lecturer')

@section('content')

<div class="min-h-screen bg-slate-50">

    {{-- Header --}}
    <div class="border-b border-slate-200 bg-white">

        <div class="mx-auto max-w-7xl px-6 py-8">

            {{-- Back --}}
            <a href="#"
                class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-900">

                <svg class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>

                Kembali ke Pengajaran

            </a>


            {{-- Course Information --}}
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">

                <div>

                    <div class="mb-3 flex items-center gap-2">

                        <span class="rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
                            {{ $pengajaran->kode_mk }}
                        </span>

                        <span class="rounded-md bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                            Mata Kuliah
                        </span>

                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        {{ $pengajaran->matakuliah->nama_mk }}
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Kelola materi, tugas, kuis, dan aktivitas pembelajaran mahasiswa.
                    </p>

                </div>


                {{-- Lecturer --}}
                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-600">
                        {{ strtoupper(substr($pengajaran->lecturer->nama, 0, 1)) }}
                    </div>

                    <div>

                        <p class="text-xs text-slate-400">
                            Dosen Pengajar
                        </p>

                        <p class="text-sm font-semibold text-slate-700">
                            {{ $pengajaran->lecturer->nama }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Main Content --}}
    <div class="mx-auto max-w-7xl px-6 py-8">

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">


            {{-- LEFT CONTENT --}}
            <div class="lg:col-span-2">


                {{-- Navigation --}}
                <div class="mb-6 overflow-x-auto">

                    <div class="flex min-w-max gap-2 rounded-xl border border-slate-200 bg-white p-1">

                        <a href="#materi"
                            class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white">
                            Materi
                        </a>

                        <a href="#tugas"
                            class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100">
                            Tugas
                        </a>

                        <a href="#quiz"
                            class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100">
                            Quiz
                        </a>

                        <a href="#mahasiswa"
                            class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100">
                            Mahasiswa
                        </a>

                    </div>

                </div>


                {{-- Materi --}}
                <div id="materi"
                    class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="flex flex-col justify-between gap-4 border-b border-slate-100 p-6 sm:flex-row sm:items-center">

                        <div>

                            <h2 class="text-lg font-bold text-slate-900">
                                Materi Pembelajaran
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Kelola materi yang akan diberikan kepada mahasiswa.
                            </p>

                        </div>

                        <button
                            type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

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


                    {{-- List Materi --}}
                    <div class="divide-y divide-slate-100">

                        {{-- Materi 1 --}}
                        <div class="flex items-center gap-4 p-5 transition hover:bg-slate-50">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                                <svg class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                                </svg>

                            </div>


                            <div class="min-w-0 flex-1">

                                <h3 class="truncate text-sm font-semibold text-slate-800">
                                    Pertemuan 1 — Pengenalan HTML
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    Materi pembelajaran • PDF
                                </p>

                            </div>


                            <button
                                class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

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
                        <div class="flex items-center gap-4 p-5 transition hover:bg-slate-50">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                                <svg class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                                </svg>

                            </div>


                            <div class="min-w-0 flex-1">

                                <h3 class="truncate text-sm font-semibold text-slate-800">
                                    Pertemuan 2 — CSS Dasar
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    Materi pembelajaran • PDF
                                </p>

                            </div>


                            <button
                                class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

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


                        {{-- Empty State --}}
                        {{--

                        <div class="p-10 text-center">

                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                                📚
                            </div>

                            <h3 class="mt-4 text-sm font-semibold text-slate-800">
                                Belum ada materi
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Tambahkan materi pertama untuk mata kuliah ini.
                            </p>

                        </div>

                        --}}

                    </div>

                </div>


                {{-- Tugas --}}
                <div id="tugas"
                    class="mt-8 rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="flex items-center justify-between border-b border-slate-100 p-6">

                        <div>

                            <h2 class="text-lg font-bold text-slate-900">
                                Tugas
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Kelola tugas dan pengumpulan mahasiswa.
                            </p>

                        </div>

                        <button
                            class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">

                            + Tambah Tugas

                        </button>

                    </div>

                    <div class="p-6">

                        <div class="rounded-xl border border-dashed border-slate-300 p-8 text-center">

                            <p class="text-sm text-slate-500">
                                Belum ada tugas.
                            </p>

                        </div>

                    </div>

                </div>


            </div>


            {{-- RIGHT SIDEBAR --}}
            <div class="space-y-6">


                {{-- Quick Action --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="text-base font-bold text-slate-900">
                        Aksi Cepat
                    </h2>

                    <div class="mt-4 space-y-3">


                        <button
                            class="flex w-full items-center gap-3 rounded-xl border border-slate-200 p-3 text-left transition hover:bg-slate-50">

                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                +
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Tambah Materi
                                </p>

                                <p class="text-xs text-slate-500">
                                    Upload materi pembelajaran
                                </p>

                            </div>

                        </button>


                        <button
                            class="flex w-full items-center gap-3 rounded-xl border border-slate-200 p-3 text-left transition hover:bg-slate-50">

                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                                +
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Tambah Tugas
                                </p>

                                <p class="text-xs text-slate-500">
                                    Buat tugas baru
                                </p>

                            </div>

                        </button>


                        <button
                            class="flex w-full items-center gap-3 rounded-xl border border-slate-200 p-3 text-left transition hover:bg-slate-50">

                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                                +
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Buat Quiz
                                </p>

                                <p class="text-xs text-slate-500">
                                    Tambahkan quiz
                                </p>

                            </div>

                        </button>


                    </div>

                </div>


                {{-- Statistik --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="text-base font-bold text-slate-900">
                        Ringkasan
                    </h2>

                    <div class="mt-5 space-y-4">

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Materi
                            </span>

                            <span class="font-semibold text-slate-800">
                                2
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Tugas
                            </span>

                            <span class="font-semibold text-slate-800">
                                0
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Quiz
                            </span>

                            <span class="font-semibold text-slate-800">
                                0
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Mahasiswa
                            </span>

                            <span class="font-semibold text-slate-800">
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