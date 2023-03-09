<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndikatorTolaUkurKinjerKegiatanDpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_tola_ukur_kinjer_kegiatan_dpa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dpa_id');
            $table->string('indikator');
            $table->longText('tolak_ukur_kinerja');
            $table->string('target_kinerja');
            $table->timestamps();

            $table->foreign('dpa_id')->references('id')
                ->on('dpa')
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
        Schema::dropIfExists('indikator_tola_ukur_kinjer_kegiatan_dpa');
    }
}
