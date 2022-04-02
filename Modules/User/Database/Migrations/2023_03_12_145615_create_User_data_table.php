<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User_data', function (Blueprint $table) {
            $table->id();
            $table->string('firstName', 60);
            $table->string('lastName', 60);
            $table->date('DOB');
            $table->boolean('status')->default(1);
            $table->string('emailID', 40);
            $table->string('phoneNumber', 25);
            $table->string('password');

            $table->timestamps();
            $table->boolean('actionPermission')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User_data');
    }
}
