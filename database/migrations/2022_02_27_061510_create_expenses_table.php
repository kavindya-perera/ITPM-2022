<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('E_ID');
            $table->integer('E_YEAR');
            $table->integer('E_MONTH');
            $table->integer('E_DATE');
            $table->string('E_FOR');
            $table->string('E_AMOUNT');
            $table->string('E_DESCRIPTION');
            $table->string('E_EMP_NUMBER');
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
        Schema::dropIfExists('expenses');
    }
}
