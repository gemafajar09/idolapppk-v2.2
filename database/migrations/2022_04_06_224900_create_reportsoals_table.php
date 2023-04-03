<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportsoals', function (Blueprint $table) {
            $table->id();
            $table->integer('id_paket');
            $table->integer('id_fasilitas');
            $table->integer('id_soal');
            $table->string('kategori_laporan');
            $table->string('laporan');
            $table->date('tgl_lapor');
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
        Schema::dropIfExists('reportsoals');
    }
}
