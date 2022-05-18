<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBudgetInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budget_invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('budget_invoice_type_id');
            $table->foreign('budget_invoice_type_id')->references('budget_invoice_type_id')->on('budget_invoice_types')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('budget_invoices', 'budget_invoice_type_id');
    }
}
