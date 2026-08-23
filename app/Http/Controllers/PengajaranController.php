<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajaran;
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

}
