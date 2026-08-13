<?php

namespace App\Models;

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
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}