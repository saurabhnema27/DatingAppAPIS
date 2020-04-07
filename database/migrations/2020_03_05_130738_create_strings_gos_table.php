<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStringsGosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strings_gos', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->string('superlike');
            $table->integer('superlike_count');
            $table->string('boosts');
            $table->integer('boosts_count');
            $table->string('change_location');
            $table->integer('change_location_count');
            $table->string('rewind_swipe');
            $table->integer('rewind_count');
            $table->enum('package_is_for',array("DAYS","MONTHS","YEAR"));
            $table->integer('pacakge_count');
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
        Schema::dropIfExists('strings_gos');
    }
}
