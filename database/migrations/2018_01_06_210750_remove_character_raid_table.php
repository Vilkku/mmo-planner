<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCharacterRaidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('character_raid');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('character_raid', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('character_id')->unsigned();
            $table->integer('raid_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('raid_id')->references('id')->on('raids');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }
}
