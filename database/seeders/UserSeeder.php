<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'email' => 'sa@sa.com',
            'role' => 'SuperAdmin',
            'id_prodi' => 1,
            'password' => Hash::make('superadmin'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'Admin',
            'id_prodi' => 4,
            'password' => Hash::make('admin@admin.com'),
        ]);
        DB::table('users')->insert([
            'name' => 'dosen',
            'email' => 'dosen@dosen.com',
            'role' => 'Dosen',
            'id_prodi' => 2,
            'password' => Hash::make('dosen@dosen.com'),
        ]);
    }
}
