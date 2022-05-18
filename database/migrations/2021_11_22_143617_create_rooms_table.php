<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id');
            $table->string('room_name');
            $table->unsignedBigInteger('room_type_id');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('room_type_id')->references('room_type_id')->on('room_types')->cascadeOnUpdate();
            $table->foreign('status_id')->references('status_id')->on('statuses')->cascadeOnUpdate();
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
        Schema::dropIfExists('rooms');
    }
}
