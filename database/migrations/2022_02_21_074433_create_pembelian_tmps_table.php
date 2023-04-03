<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_tmps', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengguna');
            $table->integer('id_paket');
            $table->integer('harga');
            $table->integer('harga_coret');
            $table->integer('masa_aktif');
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
        Schema::dropIfExists('pembelian_tmps');
    }
}
