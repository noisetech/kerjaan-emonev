<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlokasiTahunDpa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alokasi_tahun_dpa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dpa_id');
            $table->string('tahun');
            $table->string('nominal');
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
        Schema::dropIfExists('alokasi_tahun_dpa');
    }
}
