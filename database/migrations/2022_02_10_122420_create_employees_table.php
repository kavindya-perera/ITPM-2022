<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('EM_ID');
            $table->string('EM_SystemRole');
            $table->string('EM_FirstName');
            $table->string('EM_LastName');
            $table->string('EM_Designation');
            $table->integer('EM_ContactNumber');
            $table->integer('EM_Address');
            $table->string('EM_Email');
            $table->string('EM_Password');
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
        Schema::dropIfExists('employees');
    }
}
