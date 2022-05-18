<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id('bill_id');
            // $table->string('bill_name');
            // $table->decimal('total',10,0);
            $table->dateTime('date_payment');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cus_id');
            $table->string('note');
            $table->boolean('is_paid')->default(0);
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('cus_id')->references('cus_id')->on('customers');
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
        Schema::dropIfExists('bills');
    }
}
