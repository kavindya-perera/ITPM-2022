<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('S_ID');
            $table->string('S_NUMBER');
            $table->string('S_FIRST_NAME');
            $table->string('S_LAST_NAME');
            $table->string('S_FULL_NAME');
            $table->string('S_NIC');
            $table->integer('S_AGE');
            $table->string('S_GENDER');
            $table->integer('S_CONTACT_NUMBER_1');
            $table->integer('S_CONTACT_NUMBER_2');
            $table->integer('S_WHATSAPP_NUMBER');
            $table->string('S_EMAIL');
            $table->string('S_ADDRESS');
            $table->string('S_P_NAME');
            $table->string('S_P_CONTACT_NUMBER');
            $table->integer('S_CLASS_ROOM_ID');
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
        Schema::dropIfExists('students');
    }
}
