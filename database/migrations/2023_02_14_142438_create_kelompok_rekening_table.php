<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelompokRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_rekening', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('akun_rekening_id');
            $table->string('kode');
            $table->longText('uraian_akun');
            $table->longText('deskripsi_akun');
            $table->timestamps();

            $table->foreign('akun_rekening_id')->references('id')
                ->on('akun_rekening')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelompok_rekening');
    }
}
