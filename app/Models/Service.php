<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'service_id';
    protected $fillable = [
        'service_name',
        'service_price',
        'service_type_id'
    ];

    public static function getAllService(){
        return DB::table('services')
            ->join('service_types', 'service_types.service_type_id', '=', 'services.service_type_id')
            ->orderBy('service_name')
            ->distinct()
            ->get();
    }

    public static function findServiceById($id){
        return DB::table('services')->where('service_id',$id)->first();
    }

    public static function filterService($type){
        return DB::table('services')
            ->join('service_types', 'service_types.service_type_id', '=', 'services.service_type_id')
            ->where('services.service_type_id', $type)
            ->orderBy('service_name')
            ->distinct()
            ->get();
    }

}
