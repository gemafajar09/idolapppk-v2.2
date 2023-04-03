<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kategori_paket')->nullable();
            $table->string('nama_paket');
            $table->string('harga_paket');
            $table->string('harga_coret')->nullable();
            $table->integer('masa_aktif')->nullable();
            $table->string('deskripsi_paket');
            $table->string('slug');
            $table->enum('tipe_paket',["Umum","Bidang"])->nullable();
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
        Schema::dropIfExists('pakets');
    }
}
