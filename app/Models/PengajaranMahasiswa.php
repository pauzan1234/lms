<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajaranMahasiswa extends Model
{
    protected $table = 'pengajaran_mahasiswa';

    protected $fillable = [
        'pengajaran_id',
        'mahasiswa_id',
    ];

    public function pengajaran()
    {
        return $this->belongsTo(
            Pengajaran::class,
            'pengajaran_id'
        );
    }

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'mahasiswa_id'
        );
    }
}
