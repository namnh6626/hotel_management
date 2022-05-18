<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    protected $fillable = [
        'supplier_name',
        'supplier_phone',
        'supplier_address',
    ];

    public static function getAllSupplier(){
        return DB::table('suppliers')->orderByDesc('supplier_id')->get();
    }

    public static function findSupplierById($id){
        return DB::table('suppliers')->where('supplier_id', $id)->first();
    }
}
