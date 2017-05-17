<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pet_id')->unsigned();
            $table->bigInteger('last_location_id')->unsigned();
            $table->timestamp('date');
            $table->string('description', 255);
            $table->string('status', 45);
            $table->decimal('reward', 6,2);
            $table->string('code_qr', 255);
            $table->timestamps();
            $table->foreign('pet_id')->references('id')->on('pets')->onUpdate('CASCADE');
            $table->foreign('last_location_id')->references('id')->on('locations')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reports');
    }
}
