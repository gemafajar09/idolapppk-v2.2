<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMulaiujiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mulaiujians', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_paket');
            $table->integer('id_fasilitas');
            $table->date('tgl_mulai');
            $table->integer('alokasi_waktu');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
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
        Schema::dropIfExists('mulaiujians');
    }
}
