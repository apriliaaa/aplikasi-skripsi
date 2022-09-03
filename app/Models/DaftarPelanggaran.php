<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarPelanggaran extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'daftar_pelanggaran';
    protected $fillable = [
        'id_mahasiswa', 'id_pelanggaran', 'id_user', 'id_item', 'id_prodi', 'foto'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }
}
