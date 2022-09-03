<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item')->insert([
            'nama_item' => 'KTP',
        ]);
        DB::table('item')->insert([
            'nama_item' => 'KTM',
        ]);
    }
}
