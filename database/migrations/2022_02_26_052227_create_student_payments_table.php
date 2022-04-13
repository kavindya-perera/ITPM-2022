<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->increments('SP_ID');
            $table->integer('SP_S_ID');
            $table->integer('SP_INVOICE_NO');
            $table->integer('SP_YEAR');
            $table->integer('SP_MONTH');
            $table->integer('SP_DATE');
            $table->string('SP_FOR');
            $table->string('SP_AMOUNT');
            $table->string('SP_REMARK');
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
        Schema::dropIfExists('student_payments');
    }
}
