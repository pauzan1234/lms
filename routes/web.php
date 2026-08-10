<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
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

Route::get('/akun', [AccountController::class, 'index'])->name('akun.index');
require __DIR__.'/auth.php';
