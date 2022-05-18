<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWarehouseReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_receipts', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_receipt_type_id');
            $table->foreign('warehouse_receipt_type_id')->references('warehouse_receipt_type_id')->on('warehouse_receipt_types')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('warehouse_receipts', 'warehouse_receipt_type_id');
    }
}
