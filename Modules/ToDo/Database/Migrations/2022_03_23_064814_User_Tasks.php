<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User_Tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('User_id');
            $table->unsignedBigInteger('Task_id');
            $table->foreign('User_id')->references('id')->on('User_data')->onDelete('Cascade');
            $table->foreign('Task_id')->references('Task_id')->on('Tasks')->onDelete('Cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User_Tasks');
    }
}