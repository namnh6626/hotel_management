<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceType extends Model
{
    use HasFactory;
    protected $table = 'service_types';
    protected $primaryKey = 'service_type_id';
    protected $fillable = [
        'service_type_name'
    ];

    public static function getAllServiceType(){
        return DB::table('service_types')->orderBy('service_type_name')->get();
    }

    public static function findServiceTypeById($id){
        return DB::table('service_types')->where('service_type_id', $id)->first();
    }
}
