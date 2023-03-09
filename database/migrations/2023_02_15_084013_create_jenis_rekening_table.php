<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_rekening', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kelompok_rekening_id');
            $table->string('kode');
            $table->longText('uraian_akun');
            $table->longText('deskripsi_akun');
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
        Schema::dropIfExists('jenis_rekening');
    }
}
