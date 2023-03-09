<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamAnggaranDpa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_anggaran_dpa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dpa_id');
            $table->string('nama');
            $table->string('nip');
            $table->string('jabatan');
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
        Schema::dropIfExists('team_anggaran_dpa');
    }
}
