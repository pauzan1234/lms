<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        return view('admin.index-akun_dosen');
    }

    public function import_dosen(){
        return view('admin.import-dosen');
    }
}
