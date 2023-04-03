<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_bonuses', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pengguna');
            $table->string('kode_referal');
            $table->double('bonus_afiliasi');
            $table->date('tanggal_bonus');
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
        Schema::dropIfExists('histori_bonuses');
    }
}
