<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lecturer;
use App\Models\Pengajaran;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';

    protected $primaryKey = 'kode_mk';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'prodi_id',
    ];

    /**
     * Relasi ke Program Studi
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function lecturers()
    {
        return $this->belongsToMany(
            Lecturer::class,
            'pengajaran',
            'kode_mk',
            'lecturer_id',
            'kode_mk',
            'id'
        );
    }
    public function pengajaran()
    {
        return $this->hasMany(
            Pengajaran::class,
            'kode_mk',
            'kode_mk'
        );
    }
}
