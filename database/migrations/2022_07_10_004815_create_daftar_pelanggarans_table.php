<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarPelanggaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_mahasiswa');
            $table->foreignId('id_pelanggaran');
            $table->foreignId('id_item');
            $table->foreignId('id_user');
            $table->foreignId('id_prodi');
            $table->string('foto');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_pelanggaran');
    }
}
