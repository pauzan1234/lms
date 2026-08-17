<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;

class MatakuliahController extends Controller
{
    public function index(){
        return view('admin.matakuliah-index');
    }
    public function dosen_dan_mhs(){
        $prodiList = Prodi::all();

        return view('admin.dosen-pengampu', compact('prodiList'));
    }
}
