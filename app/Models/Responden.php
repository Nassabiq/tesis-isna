<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responden extends Model
{
    protected $table = 'responden';
    protected $fillable = ['user_id', 'nama_mahasiswa', 'nim', 'prodi', 'jenis_kelamin'];
    use HasFactory;
}
