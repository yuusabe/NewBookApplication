<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->string('mail_address');
<<<<<<< HEAD
            $table->boolval('manager_flag');
            $table->boolval('logic_flag');
=======
            $table->boolean('manager_flag');
            $table->boolean('logic_flag');
>>>>>>> 6f47d50641e14a88be59dfadd64cb0597dfe23f9
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
        Schema::dropIfExists('accounts');
    }
}
