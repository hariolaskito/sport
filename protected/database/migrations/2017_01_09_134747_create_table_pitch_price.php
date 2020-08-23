<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePitchPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitch_price', function (Blueprint $table) {
            $table->integer('pitch_id')->unsigned();
            $table->smallInteger('time_number');
            $table->decimal('price',11,2);

            $table->foreign('pitch_id')->references('id')->on('pitch')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['pitch_id', 'time_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pitch_price');
    }
}
