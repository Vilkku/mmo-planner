<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('character_id')->unsigned();
            $table->integer('raid_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->text('comment')->nullable();
            $table->boolean('attended')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('raid_id')->references('id')->on('raids');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signups');
    }
}
