<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('users', function (Blueprint $table) {
	    	$table->increments('id');
	    	$table->string('name');
		    $table->string('email')->nullable();
		    $table->string('password')->nullable();
		    $table->string('remember_token', 100)->nullable();
		    $table->string('api_token', 60)->unique();
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
        //
    }
}
