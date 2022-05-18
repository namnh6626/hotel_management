<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWarehouseReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_warehouse_receipts', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_receipt_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity',6,0);
            $table->foreign('warehouse_receipt_id')->references('warehouse_receipt_id')->on('warehouse_receipts');
            $table->foreign('product_id')->references('product_id')->on('products');
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
        Schema::dropIfExists('product_receipts');
    }
}
