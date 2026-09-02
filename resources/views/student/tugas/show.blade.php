@extends('student.app-student')

@section('ketjudul')
    Detail Tugas
@endsection

@section('judul')
    {{ $tugas->judul }}
@endsection

@section('content')
    <div class="bg-paper">
        <div class="mx-auto max-w-4xl px-6 py-8">

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-inside list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Header Tugas --}}
            <div class="rounded-2xl border border-line bg-white p-6 shadow-sm">
                <h1 class="font-display text-lg font-semibold text-ink">{{ $tugas->judul }}</h1>

                @if ($tugas->deskripsi)
                    <p class="mt-2 text-sm text-ink/70">{{ $tugas->deskripsi }}</p>
                @endif

                <div class="mt-3 flex flex-wrap gap-4 text-xs text-ink/50">
                    @if ($tugas->deadline)
                        <span>
                            Deadline: {{ $tugas->deadline->translatedFormat('d M Y, H:i') }}
                            @if (now()->greaterThan($tugas->deadline))
                                <span class="font-semibold text-red-600">(Sudah lewat)</span>
                            @endif
                        </span>
                    @endif
                    @if ($tugas->bobot_nilai)
                        <span>Bobot: {{ $tugas->bobot_nilai }}%</span>
                    @endif
                </div>
            </div>

            {{-- File Soal dari Dosen --}}
            @if ($tugas->files->count())
                <div class="mt-6 rounded-2xl border border-line bg-white p-6 shadow-sm">
                    <h2 class="font-display text-base font-semibold text-ink">File Tugas</h2>
                    <ul class="mt-3 space-y-2">
                        @foreach ($tugas->files as $file)
                            <li>
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                    class="text-sm font-medium text-primary hover:underline">
                                    📎 Lampiran {{ $file->urutan }} ({{ strtoupper($file->file_type) }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Status Jawaban Saya --}}
            <div class="mt-6 rounded-2xl border border-line bg-white p-6 shadow-sm">
                <h2 class="font-display text-base font-semibold text-ink">Jawaban Saya</h2>

                @if ($jawabanSaya)
                    <div class="mt-3 flex items-center gap-2">
                        <span class="text-sm text-ink/60">Status:</span>
                        @if ($jawabanSaya->status === 'sudah_dikoreksi')
                            <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                Sudah Dikoreksi
                            </span>
                        @else
                            <span class="rounded-full bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-700">
                                Menunggu Koreksi
                            </span>
                        @endif
                    </div>

                    <p class="mt-2 text-xs text-ink/50">
                        Dikumpulkan: {{ $jawabanSaya->waktu_submit?->translatedFormat('d M Y, H:i') }}
                    </p>

                    @if ($jawabanSaya->files->count())
                        <ul class="mt-3 space-y-2">
                            @foreach ($jawabanSaya->files as $file)
                                <li>
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                        class="text-sm font-medium text-primary hover:underline">
                                        📄 File {{ $file->urutan }} ({{ strtoupper($file->file_type) }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($jawabanSaya->status === 'sudah_dikoreksi')
                        <div class="mt-4 rounded-xl bg-paper p-4">
                            <p class="text-sm font-semibold text-ink">
                                Nilai: {{ $jawabanSaya->skor }}
                            </p>
                            @if ($jawabanSaya->catatan_koreksi)
                                <p class="mt-1 text-sm text-ink/70">
                                    Catatan: {{ $jawabanSaya->catatan_koreksi }}
                                </p>
                            @endif
                        </div>
                    @endif
                @else
                    <p class="mt-2 text-sm text-ink/50">Anda belum mengumpulkan jawaban.</p>
                @endif
            </div>

            {{-- Form Submit / Resubmit --}}
            <div class="mt-6 rounded-2xl border border-line bg-white p-6 shadow-sm">
                <h2 class="font-display text-base font-semibold text-ink">
                    {{ $jawabanSaya ? 'Kumpulkan Ulang Jawaban' : 'Kumpulkan Jawaban' }}
                </h2>
                <p class="mt-1 text-sm text-ink/50">
                    Bisa upload lebih dari satu file (PDF atau foto). Mengumpulkan ulang akan menggantikan file
                    sebelumnya.
                </p>

                <form method="POST" action="{{ route('student.tugas.submit', $tugas) }}" enctype="multipart/form-data"
                    class="mt-4 flex flex-col gap-3">
                    @csrf

                    <input type="file" name="files[]" accept=".pdf,image/*" multiple required
                        class="block w-full text-sm text-ink/70
                           file:mr-3 file:rounded-lg file:border-0 file:bg-paper
                           file:px-4 file:py-2 file:text-sm file:font-semibold file:text-ink
                           hover:file:bg-line/30">

                    <button type="submit"
                        class="self-start rounded-lg bg-ink px-4 py-2.5 text-sm font-semibold text-white
                           transition hover:bg-primaryDark">
                        {{ $jawabanSaya ? 'Kumpulkan Ulang' : 'Kumpulkan' }}
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection
