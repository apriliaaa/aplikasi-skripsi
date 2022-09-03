<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'name', 'nim', 'id_prodi'
    ];


    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }

    public function daftarpelanggaran()
    {
        return $this->hasMany(DaftarPelanggaran::class, 'id_mahasiswa');
    }
}
