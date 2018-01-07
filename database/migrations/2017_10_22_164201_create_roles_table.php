<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('charclass_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('charclass_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('charclass_id')->references('id')->on('charclasses');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_role');
        Schema::dropIfExists('roles');
    }
}
