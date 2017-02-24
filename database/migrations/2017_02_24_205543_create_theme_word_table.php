<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTheme_WordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_word', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('word_id')->unsigned();
            $table->integer('theme_id')->unsigned();

            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_word');
    }
}
