<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
    //======================================
    // halaman matkull
    //======================================
    public function index(Request $request)
    {
        $query = Matakuliah::with('prodi');

        // Pencarian kode atau nama matakuliah
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kode_mk', 'LIKE', "%{$search}%")
                    ->orWhere('nama_mk', 'LIKE', "%{$search}%");
            });
        }

        // Filter program studi
        if ($request->filled('prodi_id')) {

            $query->where(
                'prodi_id',
                $request->prodi_id
            );
        }

        // Pagination
        $matakuliahs = $query
            ->orderBy('kode_mk')
            ->paginate(10)
            ->withQueryString();

        // Data prodi
        $prodis = Prodi::orderBy('nama_prodi')->get();

        return view(
            'admin.matakuliah-index',
            compact(
                'matakuliahs',
                'prodis'
            )
        );
    }

    //======================================
    // proses tambah matkul
    //======================================
    public function storeMatkul(Request $request)
    {
        $validated = $request->validate([
            'kode_mk' => [
                'required',
                'string',
                'max:20',
                'unique:matakuliah,kode_mk',
            ],

            'nama_mk' => [
                'required',
                'string',
                'max:255',
            ],

            'prodi_id' => [
                'required',
                'integer',
                'exists:prodi,id',
            ],

            'sks' => [
                'required',
                'integer',
                'min:1',
                'max:6',
            ],
        ], [
            'kode_mk.required' =>
            'Kode matakuliah wajib diisi.',

            'kode_mk.string' =>
            'Kode matakuliah harus berupa teks.',

            'kode_mk.max' =>
            'Kode matakuliah maksimal 20 karakter.',

            'kode_mk.unique' =>
            'Kode matakuliah sudah digunakan.',

            'nama_mk.required' =>
            'Nama matakuliah wajib diisi.',

            'nama_mk.string' =>
            'Nama matakuliah harus berupa teks.',

            'nama_mk.max' =>
            'Nama matakuliah maksimal 255 karakter.',

            'prodi_id.required' =>
            'Program studi wajib dipilih.',

            'prodi_id.exists' =>
            'Program studi yang dipilih tidak ditemukan.',

            'sks.required' =>
            'SKS wajib diisi.',

            'sks.integer' =>
            'SKS harus berupa angka.',

            'sks.min' =>
            'SKS minimal 1.',

            'sks.max' =>
            'SKS maksimal 6.',
        ]);

        try {

            Matakuliah::create($validated);

            return redirect()
                ->route('matakuliah.index')
                ->with(
                    'success',
                    'Data matakuliah berhasil ditambahkan.'
                );
        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('matakuliah.index')
                ->withInput()
                ->with(
                    'error',
                    'Data matakuliah gagal ditambahkan.'
                );
        }
    }

    public function dosen_dan_mhs()
    {
        $prodiList = Prodi::all();

        return view('admin.dosen-pengampu', compact('prodiList'));
    }
}
