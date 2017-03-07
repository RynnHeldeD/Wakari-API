<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_page', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_from_id')->unsigned();
            $table->integer('page_to_id')->unsigned();

            $table->foreign('page_from_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('page_to_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_page');
    }
}
