<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WarehouseReceipt extends Model
{
    use HasFactory;
    protected $table = 'warehouse_receipts';
    protected $primaryKey = 'warehouse_receipt_id';
    protected $fillable = [
        'warehouse_receipt_name',
        'receipt_created_at',
        'note',
        'user_id'
    ];

    public static function getAllWarehouseReceipt(){
        return DB::table('warehouse_receipts')->orderByDesc('warehouse_receipt_id')->paginate(10);
    }

    public static function findWarehouseReceiptById($id){
        return DB::table('warehouse_receipts')->where('warehouse_receipt_id', $id);
    }

    public static function filterWarehouseReceipt($start, $finish){
        return DB::table('warehouse_receipts')
            ->join('warehouse_receipt_types', 'warehouse_receipt_types.warehouse_receipt_type_id', '=', 'warehouse_receipts.warehouse_receipt_type_id')
            ->join('users', 'users.user_id', '=', 'warehouse_receipts.user_id')
            ->where('receipt_created_at', '>=', $start)
            ->where('receipt_created_at', '<=', $finish.' 23:59:59')
            ->distinct()
            ->get();
    }
}
