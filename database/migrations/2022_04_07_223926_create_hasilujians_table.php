<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasilujians', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ujian');
            $table->integer('id_paket');
            $table->integer('id_fasilitas');
            $table->integer('id_user');
            $table->string('nilai_a');
            $table->string('nilai_b');
            $table->string('nilai_c');
            $table->string('nilai_d');
            $table->string('nilai_benar');
            $table->date('tgl_ujian');
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
        Schema::dropIfExists('hasilujians');
    }
}
