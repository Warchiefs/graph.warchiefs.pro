<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWorkspacePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('workspace_permissions', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('workspace_id');
		    $table->integer('user_id');
		    $table->tinyInteger('permissions');
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
