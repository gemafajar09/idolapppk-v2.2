<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_details', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pembelian',40);
            $table->integer('id_pengguna');
            $table->integer('id_paket');
            $table->integer('harga');
            $table->integer('masa_aktif');
            $table->date('tanggal_pembelian');
            $table->date('tanggal_aktifasi')->nullable();
            $table->enum('status_pembelian',['Batal','Menunggu Pembayaran','Berhasil','Tidak Valid']);
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
        Schema::dropIfExists('pembelian_details');
    }
}
