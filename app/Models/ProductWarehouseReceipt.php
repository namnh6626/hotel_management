<?php

namespace App\Models;

use App\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductWarehouseReceipt extends Model
{
    use HasFactory;
    protected $table = 'product_warehouse_receipts';
    protected $fillable = [
        'warehouse_receipt_id',
        'product_id',
        'quantity'
    ];


    public static function findProductsByReceiptId($id){
        return DB::table('product_warehouse_receipts')
        ->join('products','products.product_id', '=', 'product_warehouse_receipts.product_id')
        ->where('warehouse_receipt_id', $id)
        ->get(['product_warehouse_receipts.quantity', 'products.product_id','product_type_id']);
    }

    public static function dropProductWarehouseReceiptById($id){
        return DB::table('product_warehouse_receipts')->where('warehouse_receipt_id', $id)->delete();
    }

    public static function filterProductBill($time, $productId){
        return DB::table('product_warehouse_receipts')
            ->select('product_name','product_warehouse_receipts.quantity','product_warehouse_receipts.warehouse_receipt_id')
            ->join('warehouse_receipts', 'warehouse_receipts.warehouse_receipt_id', '=', 'product_warehouse_receipts.warehouse_receipt_id')
            ->join('warehouse_receipt_types', 'warehouse_receipt_types.warehouse_receipt_type_id', '=', 'warehouse_receipts.warehouse_receipt_type_id')
            ->join('products', 'products.product_id', '=', 'product_warehouse_receipts.product_id')
            ->where('receipt_created_at', '>=', $time)
            ->where('receipt_created_at','<=', $time." 23:59:59")
            ->where('product_warehouse_receipts.product_id', $productId)
            ->where('warehouse_receipts.warehouse_receipt_type_id', '=', Constant::EXPORT_RECEIPT_ID)
            ->distinct()
            ->get();
    }
}
