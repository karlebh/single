<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
       
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('artist');
            $table->string('slug');
            $table->string('country')->nullable();
            $table->string('genre')->nullable();
            $table->string('latest_album')->nullable();
            $table->string('latest_hit');
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
        Schema::dropIfExists('music');
    }
}
