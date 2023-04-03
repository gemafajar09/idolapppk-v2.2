<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama',150);
            $table->string('email',30);
            $table->string('password');
            $table->string('password_confirmation');
            $table->string('kode_afiliasi',50)->nullable();
            $table->string('no_telpon',30)->nullable();
            $table->string('informasi_bank',30)->nullable();
            $table->string('no_rekening',30)->nullable();
            $table->double('saldo_afiliasi')->nullable();
            $table->integer('afiliasi_awards')->nullable();
            $table->integer('id_provinsi');
            $table->integer('id_kota');
            $table->string('iklan_idolapppk');
            $table->enum('status_user',['Aktif','Tidak Aktif']);
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
        Schema::dropIfExists('penggunas');
    }
}
