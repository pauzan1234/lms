@extends('admin.app-admin')

@section('ketjudul')
DAFTAR
@endsection

@section('judul')
Peserta Matakuliah
@endsection

@section('content')

<div class="mb-4 flex items-center justify-between gap-3">

    <div class="flex items-center gap-2">

        <input
            type="text"
            id="searchPengajaran"
            placeholder="Cari MK atau dosen..."
            class="w-64 h-9 px-3 border border-gray-300 rounded-md
                   text-sm focus:outline-none focus:ring-2
                   focus:ring-blue-500 focus:border-blue-500">

        <button
            type="button"
            onclick="cariPengajaran()"
            class="h-9 px-4 inline-flex items-center justify-center
                   rounded-md bg-blue-600 text-white text-sm
                   font-medium hover:bg-blue-700 transition">

            Cari

        </button>

        <button
            type="button"
            onclick="resetPengajaran()"
            class="h-9 px-4 inline-flex items-center justify-center
                   rounded-md bg-gray-200 text-gray-700 text-sm
                   font-medium hover:bg-gray-300 transition">

            Reset

        </button>

    </div>

</div>


<table class="w-full text-sm text-left">

    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Nama MK</th>
            <th class="px-4 py-3">Prodi</th>
            <th class="px-4 py-3">Dosen Pengampu</th>
            <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody id="tabelPengajaran">

        @forelse ($pengajaran as $item)

        <tr class="border-b">

            <td class="px-4 py-3">
                {{ $loop->iteration }}
            </td>

            <td class="px-4 py-3">
                <div class="font-medium">
                    {{ $item->matakuliah->nama_mk }}
                </div>

                <div class="text-xs text-gray-500">
                    {{ $item->kode_mk }}
                </div>
            </td>

            <td class="px-4 py-3">
                {{ $item->lecturer->prodi->nama_prodi ?? '-' }}
            </td>

            <td class="px-4 py-3">
                {{ $item->lecturer->user->name ?? '-' }}
            </td>

            <td class="px-4 py-3 text-center">

                <button
                    type="button"
                    onclick="openPesertaModal(
                            {{ $item->id }},
                            '{{ addslashes($item->matakuliah->nama_mk) }}'
                        )"
                    class="h-9 px-3 inline-flex items-center justify-center
                               rounded-md bg-blue-600 text-white text-xs
                               font-medium leading-none
                               hover:bg-blue-700 transition">

                    Peserta

                </button>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="5"
                class="px-4 py-6 text-center text-gray-500">

                Belum ada data pengajaran.

            </td>
        </tr>

        @endforelse

    </tbody>

</table>

<div
    <div
    id="pesertaModal"
    class="hidden fixed inset-0 z-50
           bg-black/50 flex items-center justify-center">

    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">

        {{-- Header Modal --}}
        <div class="flex items-center justify-between
                    px-6 py-4 border-b">

            <div>
                <h2 class="text-lg font-semibold">
                    Tambah Peserta
                </h2>

                <p
                    id="namaMatakuliah"
                    class="text-sm text-gray-500">
                </p>
            </div>

            <button
                type="button"
                onclick="closePesertaModal()"
                class="text-gray-500 hover:text-gray-700">

                ✕

            </button>

        </div>


        {{-- Isi Modal --}}
        <div class="p-6">

            <input
                type="text"
                id="searchStudent"
                placeholder="Cari NIM atau nama mahasiswa..."
                class="w-full border rounded-md px-3 py-2
                       focus:ring-2 focus:ring-blue-500">

            {{-- Hasil pencarian --}}
            <div
                id="hasilStudent"
                class="mt-4 max-h-80 overflow-y-auto">

                <div class="text-center text-gray-400 py-6">
                    Ketik untuk mencari mahasiswa...
                </div>

            </div>

        </div>


        {{-- Footer Modal --}}
        <div class="flex items-center justify-between
                    px-6 py-4 border-t">

            <span
                id="jumlahTerpilih"
                class="text-sm text-gray-500">

                0 mahasiswa dipilih

            </span>

            <button
                type="button"
                onclick="tambahPesertaTerpilih()"
                class="h-9 px-4 inline-flex items-center
                       justify-center rounded-md bg-blue-600
                       text-white text-sm font-medium
                       hover:bg-blue-700 transition">

                Tambahkan Terpilih

            </button>

        </div>

    </div>

</div>

</div>

<script>
    // Menyimpan ID mahasiswa yang dipilih
    let selectedStudents = new Set();

    let pengajaranId = null;

    function openPesertaModal(id, namaMk) {
        pengajaranId = id;

        // Reset pilihan ketika membuka pengajaran baru
        selectedStudents.clear();

        document.getElementById('namaMatakuliah').innerText =
            namaMk;

        document.getElementById('pesertaModal')
            .classList.remove('hidden');

        document.getElementById('searchStudent').value = '';

        document.getElementById('hasilStudent').innerHTML = `
        <div class="text-center text-gray-400 py-6">
            Ketik untuk mencari mahasiswa...
        </div>
    `;

        updateJumlahTerpilih();

        document.getElementById('searchStudent').focus();
    }

    function closePesertaModal() {
        document.getElementById('pesertaModal')
            .classList.add('hidden');

        pengajaranId = null;
    }

    document.getElementById('searchStudent')
        .addEventListener('input', function() {

            const search = this.value.trim();

            if (search.length < 2) {

                document.getElementById('hasilStudent').innerHTML = `
                <div class="text-center text-gray-400 py-6">
                    Ketik minimal 2 karakter...
                </div>
            `;

                return;
            }

            fetch(
                    `/admin/pengajaran/${pengajaranId}/students?search=${encodeURIComponent(search)}`
                )
                .then(response => response.json())
                .then(students => {

                    let html = '';

                    if (students.length === 0) {

                        html = `
                    <div class="text-center text-gray-400 py-6">
                        Mahasiswa tidak ditemukan.
                    </div>
                `;

                    } else {

                        students.forEach(student => {

                            const checked = selectedStudents.has(
                                String(student.id)
                            );

                            html += `
        <div class="flex items-center justify-between
                    p-3 border-b hover:bg-gray-50">

            <div class="flex items-center gap-3">

                <input
                    type="checkbox"
                    class="student-checkbox w-4 h-4"
                    value="${student.id}"
                    ${checked ? 'checked' : ''}>

                <div>

                    <div class="font-medium">
                        ${student.user?.name ?? '-'}
                    </div>

                    <div class="text-xs text-gray-500">
                        ${student.nim}
                        ·
                        ${student.prodi?.nama_prodi ?? '-'}
                    </div>

                </div>

            </div>

        </div>
    `;
                        });

                    }

                    document.getElementById('hasilStudent').innerHTML =
                        html;

                });

        });

    function cariPengajaran() {
        const keyword = document
            .getElementById('searchPengajaran')
            .value
            .toLowerCase()
            .trim();

        const rows = document.querySelectorAll(
            '#tabelPengajaran tr'
        );

        rows.forEach(row => {

            const text = row
                .innerText
                .toLowerCase();

            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });
    }


    function resetPengajaran() {
        document.getElementById('searchPengajaran').value = '';

        const rows = document.querySelectorAll(
            '#tabelPengajaran tr'
        );

        rows.forEach(row => {
            row.style.display = '';
        });
    }

    function tambahPesertaTerpilih() {
        const studentIds = Array.from(selectedStudents);

        if (studentIds.length === 0) {

            alert('Pilih minimal satu mahasiswa.');

            return;
        }

        fetch(`/admin/pengajaran/${pengajaranId}/peserta`, {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',

                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                },

                body: JSON.stringify({
                    student_ids: studentIds
                })

            })
            .then(response => response.json())

            .then(data => {

                if (data.success) {

                    alert(data.message);

                    closePesertaModal();

                } else {

                    alert(
                        data.message ??
                        'Gagal menambahkan mahasiswa.'
                    );
                }

            })
            .catch(error => {

                console.error(error);

                alert(
                    'Terjadi kesalahan saat menambahkan mahasiswa.'
                );

            });
    }

    document.addEventListener('change', function(e) {

        if (!e.target.classList.contains('student-checkbox')) {
            return;
        }

        const studentId = String(e.target.value);

        if (e.target.checked) {

            selectedStudents.add(studentId);

        } else {

            selectedStudents.delete(studentId);

        }

        updateJumlahTerpilih();
    });

    function updateJumlahTerpilih() {
        document.getElementById('jumlahTerpilih').innerText =
            `${selectedStudents.size} mahasiswa dipilih`;
    }
</script>
@endsection