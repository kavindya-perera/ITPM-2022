<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorkOutJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stork_out_jobs', function (Blueprint $table) {
            $table->increments('JO_ID');
            $table->string('JO_DATE');
            $table->string('JO_TO');
            $table->string('JO_DESCRIPTION');
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
        Schema::dropIfExists('stork_out_jobs');
    }
}
