<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'import_price',
        'quantity',
        'product_type_id',
        'supplier_id'
    ];

    public static function getAllProduct(){
        return DB::table('products')
        ->join('product_types', 'product_types.product_type_id','=', 'products.product_type_id')
        ->join('suppliers', 'suppliers.supplier_id','=', 'products.supplier_id')
        ->join('measures', 'measures.measure_id','=', 'products.measure_id')
        ->distinct()
        ->orderBy('product_name')
        ->paginate(10);
    }


    public static function findProductById($id){
        return DB::table('products')
            ->join('product_types', 'product_types.product_type_id','=', 'products.product_type_id')
            ->join('suppliers', 'suppliers.supplier_id','=', 'products.supplier_id')
            ->join('measures', 'measures.measure_id','=', 'products.measure_id')
            ->where('product_id', $id)
            ->distinct()
            ->first();

    }

    public static function updateProduct($productId, $updateArr){
        return DB::table('products')->where('product_id', $productId)->update($updateArr);
    }

    public static function updateIncrementProductQuantity($productId, $incrementValue){
        return DB::table('products')
            ->where('product_id', $productId)
            ->increment('quantity', $incrementValue);
    }

    public static function updateDecrementProductQuantity($productId, $decrementValue){
        return DB::table('products')
            ->where('product_id', $productId)
            ->decrement('quantity', $decrementValue);
    }


}
