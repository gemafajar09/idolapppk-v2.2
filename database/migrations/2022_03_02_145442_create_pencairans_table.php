<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePencairansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencairans', function (Blueprint $table) {
            $table->id();
            $table->string('secret_kode');
            $table->integer('id_pengguna');
            $table->string('informasi_bank');
            $table->string('nama_penerima');
            $table->string('no_rekening');
            $table->double('saldo_komisi', 8, 2);
            $table->date('tanggal_pencairan');
            $table->enum('status_pencairan', ["Valid","Tidak Valid","Menunggu Verifikasi"]);
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
        Schema::dropIfExists('pencairans');
    }
}
