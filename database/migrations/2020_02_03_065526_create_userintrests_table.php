<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserintrestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userintrests', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('orientation',array('Straight','Gay','Lesbian','Bisexual'))->nullable();
            $table->enum('looking_for', array('Male','Female','Other'))->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->float('distance')->nullable();
            $table->string('distance_is_in');
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
        Schema::dropIfExists('userintrests');
    }
}
