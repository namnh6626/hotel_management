<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomBill extends Model
{
    use HasFactory;
    protected $table = 'room_bills';
    protected $fillable = [
        'room_id',
        'bill_id',
        'date_checkin',
        'date_checkout'
    ];

    public static function findRoomByBillId($id, $columns = ["*"]){
        return DB::table('room_bills')->where('bill_id',$id)->get($columns);
    }
    public static function dropRoomBillById($id){
        return DB::table('room_bills')->where('bill_id', $id)->delete();
    }

    public static function findRoomBillByRoomIdAndBillId($roomId, $billId){
        return DB::table('room_bills')->where('room_id', $roomId)->where('bill_id', $billId)->first();
    }

    // fix
    public static function getCountRoomIsRentedBetweenDate($time){
        return DB::table('room_bills')
            ->where('date_checkin', '<=', $time." 23:59:59")
            ->where('date_checkout', '>=', $time)
            ->distinct()
            ->count();
    }

    public static function getListRoomRented($time){
        return DB::table('room_bills')
        ->where('date_checkin', '<=', $time." 23:59:59")
        ->where('date_checkout', '>=', $time)
        ->distinct()
        ->get();
    }


}
