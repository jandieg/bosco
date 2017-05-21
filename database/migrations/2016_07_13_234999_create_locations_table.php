<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('address', 25);
            $table->double('latitude', 10,8);
            $table->double('longitude', 10, 8);
            $table->integer('ubigeo_id');
            $table->string('level', 45);
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
        Schema::drop('locations');
    }
}
