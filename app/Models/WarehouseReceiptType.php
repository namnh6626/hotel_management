<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WarehouseReceiptType extends Model
{
    use HasFactory;
    protected $table = 'warehouse_receipt_types';
    protected $primaryKey = 'warehouse_receipt_type_id';
    protected $fillable = [
        'warehouse_receipt_type_name'
    ];

    public static function getAllWarehouseReceiptType(){
        return DB::table('warehouse_receipt_types')->orderByDesc('warehouse_receipt_type_name')->get();
    }

    public static function findWarehouseReceiptTypeById($id){
        return DB::table('warehouse_receipt_types')->where('warehouse_receipt_type_id', $id)->first();
    }
}
