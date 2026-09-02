@extends('student.app-student')

@section('ketjudul')
Quiz
@endsection

@section('judul')
{{ $quiz->judul }}
@endsection

@section('content')

<div class="lg:col-span-3">

    @if (session('success'))
    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    @if ($jawabanSaya)
    {{-- Sudah pernah mengerjakan --}}
    <div class="rounded-2xl border border-line bg-white p-6 shadow-sm">
        <h2 class="font-display text-lg font-semibold text-ink">
            Kamu sudah mengerjakan quiz ini
        </h2>
        <p class="mt-2 text-3xl font-bold text-ink">
            {{ $jawabanSaya->skor }}
            <span class="text-base font-normal text-ink/50">/ 100</span>
        </p>
        <p class="mt-1 text-sm text-ink/50">
            Dikerjakan pada {{ $jawabanSaya->waktu_submit->format('d M Y, H:i') }}
        </p>
    </div>
    @else
    {{-- Form pengerjaan --}}
    <form method="POST" action="{{ route('student.quiz.submit', $quiz->id) }}">
        @csrf

        <div class="mb-6 rounded-2xl border border-line bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-semibold text-ink">{{ $quiz->judul }}</h2>
            @if ($quiz->deskripsi)
            <p class="mt-1 text-sm text-ink/50">{{ $quiz->deskripsi }}</p>
            @endif
            <p class="mt-2 text-xs text-ink/40">
                {{ $quiz->questions->count() }} soal
                @if ($quiz->durasi_menit)
                • Durasi {{ $quiz->durasi_menit }} menit
                @endif
            </p>
        </div>

        <div class="space-y-4">
            @foreach ($quiz->questions as $q)
            <div class="rounded-2xl border border-line bg-white p-6 shadow-sm">

                <p class="text-sm font-semibold text-ink">
                    {{ $q->nomor }}. {{ $q->pertanyaan }}
                </p>

                @if ($q->gambar)
                <img src="{{ Storage::url($q->gambar) }}" alt="Gambar soal"
                    class="mt-3 max-h-64 rounded-xl border border-line">
                @endif

                <div class="mt-4 space-y-2">
                    @foreach ($q->pilihanTersedia() as $huruf => $teks)
                    <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-line
                                                  px-4 py-3 text-sm text-ink/80 transition hover:bg-paper
                                                  has-[:checked]:border-ink has-[:checked]:bg-paper has-[:checked]:font-semibold">
                        <input type="radio" name="jawaban[{{ $q->id }}]" value="{{ $huruf }}"
                            class="h-4 w-4" required>
                        <span>{{ $huruf }}. {{ $teks }}</span>
                    </label>
                    @endforeach
                </div>

            </div>
            @endforeach
        </div>

        <button type="submit"
            class="mt-6 w-full rounded-lg bg-ink px-4 py-3 text-sm font-semibold text-white
                           transition hover:bg-primaryDark"
            onclick="return confirm('Yakin ingin submit jawaban? Quiz tidak bisa diulang.')">
            Submit Jawaban
        </button>

    </form>
    @endif

</div>

@endsection