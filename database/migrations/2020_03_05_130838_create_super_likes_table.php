<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->integer('count');
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
        Schema::dropIfExists('super_likes');
    }
}
