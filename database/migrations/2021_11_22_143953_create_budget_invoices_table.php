<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_invoices', function (Blueprint $table) {
            $table->id('budget_invoice_id');
            $table->string('budget_invoice_name')->nullable();
            $table->decimal('amount_of_money',9,0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('budget_id');
            $table->dateTime('date_created_invoice');
            $table->string('invoice_note');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('budget_id')->references('budget_id')->on('budgets');
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
        Schema::dropIfExists('budget_invoices');
    }
}
