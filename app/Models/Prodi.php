<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi'; // karena nama tabel singular, bukan "prodis"
    protected $fillable = ['nama_prodi'];
}