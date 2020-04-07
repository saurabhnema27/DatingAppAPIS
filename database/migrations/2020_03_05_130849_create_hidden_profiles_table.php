<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHiddenProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hidden_profiles', function (Blueprint $table) {
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
        Schema::dropIfExists('hidden_profiles');
    }
}
