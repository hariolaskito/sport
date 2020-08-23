<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->integer('user_id');
            $table->enum('type',['cash','transfer','coupon']);
            $table->decimal('amount',11,2);
            $table->string('account_name',30)->nullable();
            $table->date('date');
            $table->integer('status')->default(0);
            $table->integer('coupon_id')->nullable();
            $table->integer('confirmer_id')->nullable();
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('booking')
                ->onUpdate('cascade')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
