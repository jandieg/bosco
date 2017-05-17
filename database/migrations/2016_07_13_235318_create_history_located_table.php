<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryLocatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_located', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('history_location_id')->unsigned();
            $table->bigInteger('pet_id')->unsigned();
            $table->string('status', 45);
            $table->timestamps();
            $table->foreign('history_location_id')->references('id')->on('history_locations')->onUpdate('CASCADE');
            $table->foreign('pet_id')->references('id')->on('pets')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('history_located');
    }
}
