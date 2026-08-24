<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajaran;
use App\Models\Student;
use App\Models\PengajaranMahasiswa;

class PengajaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lecturer_id' => [
                'required',
                'exists:lecturer,id',
            ],

            'kode_mk' => [
                'required',
                'exists:matakuliah,kode_mk',
            ],
        ]);


        // Cek apakah dosen sudah mengajar MK tersebut
        $sudahAda = Pengajaran::where(
            'lecturer_id',
            $request->lecturer_id
        )
            ->where(
                'kode_mk',
                $request->kode_mk
            )
            ->exists();


        if ($sudahAda) {

            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tersebut sudah ditambahkan ke dosen ini.',
            ], 422);
        }


        Pengajaran::create([
            'lecturer_id' => $request->lecturer_id,
            'kode_mk' => $request->kode_mk,
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil ditambahkan.',
        ]);
    }

    public function matakuliah($lecturer)
    {
        $pengajaran = Pengajaran::with('matakuliah')
            ->where('lecturer_id', $lecturer)
            ->get();

        $data = $pengajaran->map(function ($item) {
            return [
                'kode_mk' => $item->matakuliah->kode_mk,
                'nama_mk' => $item->matakuliah->nama_mk,
                'sks' => $item->matakuliah->sks,
            ];
        });

        return response()->json($data);
    }
    public function show_mk()
    {
        $pengajaran = Pengajaran::with([
            //di pengajaran ada: id(pkey), lecturer_id, kode_mk
            //di Lecturer ada: id(pkey), user_id, nidn, prodi_id
            //di matakuliah ada: kode_mk, nama_mk, prodi_id
            'lecturer.user',
            //artinya: di tb pengajaran ada id->lecturer_id. berelasi dengan id yg ada di tb Lecturer
            //pengajaran.lecturer_id = lecturer.id
            //lecturer.user adalah nama method user() di Model Lecturer
            'lecturer.prodi',
            'matakuliah',
        ])
            ->latest()
            ->get();

        return view(
            'admin.peserta-mk',
            compact('pengajaran')
        );
    }

    public function searchStudents(
        Request $request,
        Pengajaran $pengajaran
    ) {
        $search = $request->get('search');

        $students = Student::with([
            'user',
            'prodi'
        ])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('nim', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($user) use ($search) {

                            $user->where(
                                'name',
                                'like',
                                "%{$search}%"
                            );
                        });
                });
            })
            ->limit(20)
            ->get();

        return response()->json($students);
    }

    public function tambahPeserta(
        Request $request,
        Pengajaran $pengajaran
    ) {
        $request->validate([
            'student_ids' => [
                'required',
                'array',
            ],

            'student_ids.*' => [
                'integer',
                'exists:students,id',
            ],
        ]);

        $data = collect($request->student_ids)
            ->unique()
            ->map(function ($studentId) use ($pengajaran) {

                return [
                    'pengajaran_id' => $pengajaran->id,
                    'mahasiswa_id' => $studentId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })
            ->toArray();

        PengajaranMahasiswa::insertOrIgnore($data);

        return response()->json([
            'success' => true,
            'message' => count($data)
                . ' mahasiswa berhasil ditambahkan.',
        ]);
    }
    
    public function mk_saya(
    ){
        $pengajaran = Pengajaran::with([
            'lecturer',
            'matakuliah'
        ])->get();

        return view('lecturer.matakuliah-saya', compact('pengajaran'));
    }

    public function show($id)
    {
        $pengajaran = Pengajaran::with([
            'lecturer',
            'matakuliah'
        ])->findOrFail($id);

        return view('lecturer.show', compact('pengajaran'));
    }
}
