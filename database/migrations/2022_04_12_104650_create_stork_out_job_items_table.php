<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorkOutJobItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stork_out_job_items', function (Blueprint $table) {
            $table->increments('JOI_ID');
            $table->string('JOI_JOB_ID');
            $table->string('JOI_ITEM_CODE');
            $table->string('JOI_QTY');
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
        Schema::dropIfExists('stork_out_job_items');
    }
}
