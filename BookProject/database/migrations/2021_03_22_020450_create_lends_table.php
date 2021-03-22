<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lends', function (Blueprint $table) {
            $table->bigIncrements('lend_number');
            // $table->integer('book_number')->unsigned();
            $table->integer('account_number');
            $table->string('return_day');
            $table->boolean('lend_flag');
            $table->timestamps();

            //$table->foreign('book_number')
            //      ->references('lend_number')
             //     ->on('books')
             //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lends');
    }
}
