<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinas_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dinas_id');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->foreign('dinas_id')->references('id')
                ->on('dinas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('users_id')->references('id')
                ->on('users')
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
        Schema::dropIfExists('dinas_users');
    }
}
