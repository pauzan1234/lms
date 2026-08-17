@extends('admin.app-admin')

@section('ketjudul')
    Daftar
@endsection

@section('judul')
    Dosen Prodi {{ $prodi->nama_prodi }}
@endsection

@section('content')

<div class="p-6">

    {{-- Nama Prodi --}}
    <div class="mb-6">
        <h2 class="font-display text-lg font-semibold">
            {{ $prodi->nama_prodi }}
        </h2>

        <p class="py-3 pr-4 text-ink/70">
            Daftar dosen Program Studi {{ $prodi->nama_prodi }}
        </p>
    </div>

    {{-- Daftar Dosen --}}
    <div class="bg-white rounded-lg shadow">

        <div class="p-4 border-b">
            <h3 class="font-semibold">
                Daftar Dosen
            </h3>
        </div>

        <div class="p-4">

            @forelse ($lecturers as $lecturer)

                <div class="py-3 border-b last:border-b-0">

                    <p class="font-semibold">
                        {{ $lecturer->user->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $lecturer->user->email }}
                    </p>

                </div>

            @empty

                <p class="text-gray-500">
                    Belum ada dosen pada program studi ini.
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection