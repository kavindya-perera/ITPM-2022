<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_lessons', function (Blueprint $table) {
            $table->increments('V_ID');
            $table->string('V_SUBJECT');
            $table->string('V_CHAPTER');
            $table->string('V_NAME');
            $table->string('V_CODE');
            $table->string('V_EMBED_BY');
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
        Schema::dropIfExists('video_lessons');
    }
}
