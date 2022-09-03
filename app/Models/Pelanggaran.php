<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;
    protected $table = 'pelanggaran';
    protected $fillable = [
        'nama_pelanggaran'
    ];

    public function daftarpelanggaran()
    {
        return $this->hasMany(DaftarPelanggaran::class, 'id_pelanggaran');
    }
}
