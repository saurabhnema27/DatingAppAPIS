<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBehaviorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_behaviors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_like_type')->nullable();
            $table->integer('total_dislike_type')->nullable();
            $table->integer('total_superlike_type')->nullable();
            $table->time('total_login_time')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('can_he_do_swipe')->default(FALSE);
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
        Schema::dropIfExists('user_behaviors');
    }
}
