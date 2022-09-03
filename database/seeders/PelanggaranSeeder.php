<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggaran')->insert([
            'nama_pelanggaran' => 'Rambut Panjang',
        ]);
        DB::table('pelanggaran')->insert([
            'nama_pelanggaran' => 'Celana Sobek',
        ]);
        DB::table('pelanggaran')->insert([
            'nama_pelanggaran' => 'Mencontek',
        ]);
    }
}
