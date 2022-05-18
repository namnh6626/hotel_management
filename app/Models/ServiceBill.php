<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceBill extends Model
{
    use HasFactory;

    protected $table = 'service_bills';
    protected $fillable = [
        'bill_id',
        'service_id',
        'date_use_service',
        'quantity'
    ];

    public static function findServicesByBillId($id,$columns = ["*"]){
        return DB::table('service_bills')
        ->where('bill_id', $id)->get();
    }

    public static function dropServiceBillById($id){
        return DB::table('service_bills')->where('bill_id', $id)->delete();
    }

    public static function getListUseService($time){
        return DB::table('service_bills')
            ->where('date_use_service', '>=', $time)
            ->where('date_use_service', '<=', $time.' 23:59:59')
            ->get();
    }

    public static function findServiceIsUsedByRoomIdAndBillId($serviceId, $billId, $roomId){
        return DB::table('service_bills')
            ->where('service_id', $serviceId)
            ->where('bill_id', $billId)
            ->where('room_id', $roomId)
            ->get();
    }

    public static function increaseServiceQuantity($serviceId, $roomId, $billId, $increase){
        return DB::table('service_bills')
            ->where('service_id', $serviceId)
            ->where('bill_id', $billId)
            ->where('room_id', $roomId)
            ->increment('quantity', $increase);
    }
}
