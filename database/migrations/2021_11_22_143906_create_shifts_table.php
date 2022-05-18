<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id('shift_id');
            $table->dateTime('date_start');
            $table->dateTime('date_finish');
            $table->unsignedBigInteger('shift_type_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('shift_type_id')->references('shift_type_id')->on('shift_types');
            $table->foreign('user_id')->references('user_id')->on('users');
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
        Schema::dropIfExists('shifts');
    }
}
