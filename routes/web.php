<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PengajaranController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.lamandepan');
});

use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {

    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'lecturer' => redirect()->route('lecturer.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::get('/lecturer/dashboard', function () {
    return view('lecturer.dashboard');
})->middleware(['auth', 'role:lecturer'])->name('lecturer.dashboard');

Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth', 'role:student'])->name('student.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // ============================================================
    // PROSES TAMBAH AKUN DOSEN
    // ============================================================
    Route::post('/dosen', [AccountController::class, 'store'])
        ->name('admin.dosen.buatAkun');

    Route::post('/dosen/import', [AccountController::class, 'import'])
        ->name('admin.dosen.import.process');


    // ============================================================
    // PROSES TAMBAH AKUN MAHASISWA
    // ============================================================
    Route::post('/mahasiswa', [AccountController::class, 'store_mahasiswa'])
        ->name('admin.mahasiswa.buatAkun');

    Route::post('/mahasiswa/import', [AccountController::class, 'importStudent'])
        ->name('admin.mahasiswa.import.process');


    // ============================================================
    // PROSES TAMBAH MATAKULIAH
    // ============================================================
    Route::post('/matakuliah', [MatakuliahController::class, 'storeMatkul'])
        ->name('admin.tambah.matkul');
});

Route::get('/akun_dosen', [AccountController::class, 'index'])->name('akun_dosen.index');

Route::get('/akun/dosen/import', [AccountController::class, 'import_dosen'])->name('dosen.import');

Route::get('/akun_mahasiswa', [AccountController::class, 'index_mahasiswa'])->name('akun_mahasiswa.index');

Route::get('/akun/mahasiswa/import', [AccountController::class, 'import_mahasiswa'])->name('mahasiswa.import');

Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');

Route::get('/penugasan_mk', [MatakuliahController::class, 'dosen_dan_mhs'])->name('matakuliah.pengampu');

Route::get('/dosen/{prodi}', [DosenController::class, 'show'])->name('dosen.prodi');

Route::get(
    '/matakuliah/search',
    [MatakuliahController::class, 'search']
)->name('admin.matakuliah.search');

Route::post(
    '/pengajaran',
    [PengajaranController::class, 'store']
)->name('admin.pengajaran.store');

Route::get(
    '/pengajaran/{lecturer}/matakuliah',
    [PengajaranController::class, 'matakuliah']
)->name('admin.pengajaran.matakuliah');

Route::get('/kontrak_mk', [PengajaranController::class, 'index'])->name('dosen.prodi');

require __DIR__ . '/auth.php';
