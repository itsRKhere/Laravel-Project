<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('role_id'); 
            $table->foreign('user_id')->references('id')->on('User_data')->onDelete('cascade');
            $table->foreign('role_id')->references('Role_id')->on('Role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
}
