<?php
namespace App\Models;
use App\Models\Lecturer;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    protected $table = 'prodi'; // karena nama tabel singular, bukan "prodis"
    protected $fillable = ['nama_prodi'];

     public function lecturers(): HasMany
    {
        return $this->hasMany(Lecturer::class, 'prodi_id', 'id');
    }

}