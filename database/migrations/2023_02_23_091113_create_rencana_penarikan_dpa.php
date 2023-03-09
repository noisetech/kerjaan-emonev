<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaPenarikanDpa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_penarikan_dpa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dpa_id');
            $table->string('bulan');
            $table->integer('nominal');
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
        Schema::dropIfExists('rencana_penarikan_dpa');
    }
}
