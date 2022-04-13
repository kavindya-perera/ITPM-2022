<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_payments', function (Blueprint $table) {
            $table->increments('OP_ID');
            $table->string('OP_CUSTOMER_NAME');
            $table->string('OP_CUSTOMER_ADDRESS');
            $table->string('OP_CUSTOMER_CONTACT');
            $table->integer('OP_INVOICE_NO');
            $table->integer('OP_YEAR');
            $table->integer('OP_MONTH');
            $table->integer('OP_DATE');
            $table->string('OP_FOR');
            $table->string('OP_AMOUNT');
            $table->string('OP_REMARK');
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
        Schema::dropIfExists('other_payments');
    }
}
