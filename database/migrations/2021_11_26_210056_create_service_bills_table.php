<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_bills', function (Blueprint $table) {
            $table->unsignedBigInteger('bill_id');
            $table->unsignedBigInteger('service_id');
            $table->decimal('quantity', 6, 0);
            $table->dateTime('date_use_service');
            $table->foreign('bill_id')->references('bill_id')->on('bills');
            $table->foreign('service_id')->references('service_id')->on('services');
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
        Schema::dropIfExists('service_bills');
    }
}
