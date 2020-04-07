<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlottingDoneOnProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slotting_done_on_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("slot_number")->nullable();
            $table->integer("liked_profile_to_display")->nullable();
            $table->integer("dislike_profile_to_display")->nullable();
            $table->integer("notseen_profile_to_display")->nullable();
            $table->integer("slot_sequence")->nullable();
            $table->time("slot_timing")->nullable();
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
        Schema::dropIfExists('slotting_done_on_profiles');
    }
}
