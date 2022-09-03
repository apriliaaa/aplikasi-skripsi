<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['nama_item'];

    protected $table = 'item';

    public function daftarpelanggaran()
    {
        return $this->hasMany(DaftarPelanggaran::class, 'id_item');
    }
}
