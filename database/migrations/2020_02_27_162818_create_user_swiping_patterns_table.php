<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSwipingPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_swiping_patterns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('swiping_pattern_of_user')->nullable();
            $table->string('right_swipe_pattern')->nullable();
            $table->string('left_swipe_pattern')->nullable();
            $table->string('up_swipe_pattern')->nullable();
            $table->dateTime('last_recorded_pattern')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_swiping_patterns');
    }
}
