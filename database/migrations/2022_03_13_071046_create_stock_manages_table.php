<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_manages', function (Blueprint $table) {
            $table->increments('SM_ID');
            $table->integer('SM_ITEM_ID');
            $table->string('SM_UPDATE_EMPLOYEE');
            $table->string('SM_ITEM_QTY');
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
        Schema::dropIfExists('stock_manages');
    }
}
