<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_paket');
            $table->integer('id_fasilitas');
            $table->integer('id_ujian');
            $table->integer('no_soal');
            $table->string('ragu_ragu');
            $table->string('jawaban');
            $table->date('tgl_ujian');
            $table->string('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawabans');
    }
}
