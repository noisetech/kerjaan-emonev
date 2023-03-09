<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_dpa');
            $table->unsignedBigInteger('tahun_id');
            $table->unsignedBigInteger('dinas_id');
            $table->unsignedBigInteger('urusan_id');
            $table->unsignedBigInteger('bidang_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('kegiatan_id');
            $table->unsignedBigInteger('organisasi_id');
            $table->unsignedBigInteger('unit_id');
            $table->text('sasaran_prgoram')->nullable();
            $table->string('kelompok_sasaran_kegiatan')->nullable();
            $table->timestamps();

            $table->foreign('tahun_id')->references('id')
                ->on('tahun')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('dinas_id')->references('id')
                ->on('dinas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('urusan_id')->references('id')
                ->on('urusan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('bidang_id')->references('id')
                ->on('bidang')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kegiatan_id')->references('id')
                ->on('kegiatan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('organisasi_id')->references('id')
                ->on('organisasi')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('unit_id')->references('id')
                ->on('unit')
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
        Schema::dropIfExists('dpa');
    }
}
