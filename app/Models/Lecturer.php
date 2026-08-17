<?php

namespace App\Models;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecturer extends Model
{
    use HasFactory;

    protected $table = 'lecturer';

    protected $fillable = [
        'user_id',
        'nidn',
        'study_program',
        'prodi_id',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function prodi()
{
    return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
}
}