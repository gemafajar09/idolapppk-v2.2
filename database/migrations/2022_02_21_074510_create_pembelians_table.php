<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pembelian',40);
            $table->string('kode_referal')->nullable();
            $table->integer('id_pengguna');
            $table->integer('total');
            $table->integer('potong_harga')->nullable();
            $table->integer('total_bayar');
            $table->integer('potong_komisi')->nullable();
            $table->string('bank');
            $table->enum('status_pembelian',['Batal','Menunggu Pembayaran','Berhasil','Tidak Valid']);
            $table->date('tanggal_pembelian');
            $table->date('tanggal_aktifasi')->nullable();
            $table->string('bukti_bayar')->nullable();
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
        Schema::dropIfExists('pembelians');
    }
}
