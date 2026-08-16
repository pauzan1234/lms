<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\User;
use App\Models\Lecturer;
use App\Imports\LecturerImport;

class AccountController extends Controller
{
    // ============================================================
    // MENAMPILKAN DATA AKUN DOSEN
    // ============================================================
    public function index()
    {
        $akundosen = Lecturer::with('user')
            ->latest()
            ->get();

        return view('admin.index-akun_dosen', compact('akundosen'));
    }

    // ============================================================
    // HALAMAN IMPORT DOSEN
    // ============================================================
    public function import_dosen()
    {
        return view('admin.import-dosen');
    }

    // ============================================================
    // PROSES TAMBAH AKUN DOSEN
    // ============================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => [
                'required',
                'string',
                'max:20',
                'unique:lecturer,nidn',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'study_program' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            /*
             * Password awal menggunakan NIDN.
             *
             * Contoh:
             * NIDN = 0428019701
             * Password awal = 0428019701
             */

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['nidn'],
                'role' => 'lecturer',
            ]);

            Lecturer::create([
                'user_id' => $user->id,
                'nidn' => $validated['nidn'],
                'study_program' => $validated['study_program'],
                'phone' => $validated['phone'] ?? null,
            ]);
        });

        return redirect()
            ->route('akun_dosen.index')
            ->with('success', 'Akun dosen berhasil dibuat.');
    }

    // ============================================================
    // PROSES IMPORT AKUN DOSEN DARI EXCEL
    // ============================================================
    public function import(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'file_excel' => [
                'required',
                'file',
                'mimes:xlsx,xls',
                'max:5120',
            ],
        ], [
            'file_excel.required' => 'File Excel wajib dipilih.',
            'file_excel.file' => 'File yang diupload tidak valid.',
            'file_excel.mimes' => 'File harus berformat .xlsx atau .xls.',
            'file_excel.max' => 'Ukuran file maksimal 5 MB.',
        ]);

        try {

            Excel::import(
                new LecturerImport,
                $request->file('file_excel')
            );

            return redirect()
                ->route('dosen.import')
                ->with('success', 'Data akun dosen berhasil diimport.');

        } catch (ValidationException $e) {

            $errors = [];

            foreach ($e->failures() as $failure) {

                $errors[] = [
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors(),
                    'values' => $failure->values(),
                ];
            }

            return redirect()
                ->route('dosen.import')
                ->with('error', $errors);

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('dosen.import')
                ->with(
                    'error',
                    'Import gagal. Terjadi kesalahan saat memproses file Excel.'
                );
        }
    }

    // ============================================================
    // HALAMAN AKUN MAHASISWA
    // ============================================================
    public function index_mahasiswa()
    {
        return view('admin.index-akun-mahasiswa');
    }

    // ============================================================
    // HALAMAN IMPORT MAHASISWA
    // ============================================================
    public function import_mahasiswa()
    {
        return view('admin.import-mahasiswa');
    }
}