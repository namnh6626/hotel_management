<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'product_types';
    protected $primaryKey = 'product_type_id';
    protected $fillable = [
        'product_type_name'
    ];

    public static function findProductTypeById($id){
        return DB::table('product_types')->where('product_type_id', $id)->first();
    }

    public static function getAllProductType(){
        return DB::table('product_types')->orderBy('product_type_name')->get();
    }
}
