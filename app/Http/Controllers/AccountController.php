<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Lecturer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Imports\LecturerImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class AccountController extends Controller
{
    // modal tambah akun dosen by admin 
    public function index()
    {
        $akundosen = Lecturer::with('user')
            ->latest()
            ->get();
        // dd($akundosen);

        return view('admin.index-akun_dosen', compact('akundosen'));
    }

    // page import dosen by admin
    public function import_dosen()
    {
        return view('admin.import-dosen');
    }

    // process tambah akun admin
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

    // process import akun dosen by admin
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
    public function index_mahasiswa(){
        return view('admin.index-akun-mahasiswa');
    }

    public function import_mahasiswa(){
        return view('admin.import-mahasiswa');
    }
}
