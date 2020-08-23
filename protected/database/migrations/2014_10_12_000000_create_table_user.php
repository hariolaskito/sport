<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname',50);
            $table->string('username')->unique();
            $table->string('phone',15);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('isactive',[0,1]);
            $table->enum('isdefault',[0,1]);
            $table->enum('role',['admin','operator','member']);
            $table->rememberToken();
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
        Schema::drop('user');
    }
}
