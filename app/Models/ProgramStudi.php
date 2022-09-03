<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;
    protected $table = 'program_studi';
    protected $fillable = [
        'nama_prodi'
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_prodi');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id_prodi');
    }

    public function daftarpelanggaran()
    {
        return $this->hasMany(DaftarPelanggaran::class, 'id_prodi');
    }
}
