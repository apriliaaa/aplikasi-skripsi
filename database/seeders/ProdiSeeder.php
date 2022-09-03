<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Teknik Informatika',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Pendidikan Ekonomi (S1)',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Akuntansi',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Sistem Informasi',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Manajeman',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Sastra Inggris',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Sastra Indonesia',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Teknik Mesin',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Teknik Industri',
        ]);
        DB::table('program_studi')->insert([
            'nama_prodi' => 'Hukum',
        ]);
    }
}
