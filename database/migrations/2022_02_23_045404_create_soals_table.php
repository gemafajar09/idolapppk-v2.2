<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id('id_soal');
            $table->string('id_paket');
            $table->string('id_fasilitas');
            $table->integer('waktu');
            $table->integer('no_soal');
            $table->string('gambar')->nullable();
            $table->string('soal');
            $table->string('a')->nullable();
            $table->string('b')->nullable();
            $table->string('c')->nullable();
            $table->string('d')->nullable();
            $table->string('e')->nullable();
            $table->integer('jawaban_a')->nullable();
            $table->integer('jawaban_b')->nullable();
            $table->integer('jawaban_c')->nullable();
            $table->integer('jawaban_d')->nullable();
            $table->integer('jawaban_e')->nullable();
            $table->string('pembahasan')->nullable();
            $table->string('level')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('indikator')->nullable();
            $table->string('kategori')->nullable();
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
        Schema::dropIfExists('soals');
    }
}
