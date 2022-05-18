<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
                $table->id('booking_id');
                $table->unsignedBigInteger('cus_id');
                $table->boolean('is_checkin');
                $table->dateTime('date_booking');
                $table->boolean('is_cancel');
                $table->foreign('cus_id')->references('cus_id')->on('customers')->cascadeOnDelete();
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
        Schema::dropIfExists('bookings');
    }
}
