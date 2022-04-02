<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_privilege', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id'); 
            $table->unsignedBigInteger('privilege_id'); 
            $table->foreign('role_id')->references('role_id')->on('Role')->onDelete('cascade');
            $table->foreign('privilege_id')->references('privilege_id')->on('privilege')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_privilege');
    }
}
