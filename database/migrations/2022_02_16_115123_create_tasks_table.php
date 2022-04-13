<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('T_ID');
            $table->string('T_NUMBER');
            $table->integer('T_ASIGN_ID');
            $table->string('T_NAME');
            $table->string('T_DESCRIPTION');
            $table->string('T_STATUS');
            $table->string('T_CREATED_DATE');
            $table->string('T_PROCESS_STATUS');
            $table->string('T_PROCESS_DATE');
            $table->string('T_COMPLETE_STATUS');
            $table->string('T_COMPLETE_DATE');
            $table->string('T_UPDATED_DATE');
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
        Schema::dropIfExists('tasks');
    }
}
