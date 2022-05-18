<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $primaryKey = 'bill_id';
    protected $fillable = [
        'bill_name',
        'date_payment',
        'cus_id',
        'user_id',
        'note'
    ];

    public static function getAllBillIsPaid($order = 'desc'){
        return DB::table('bills')
            ->where('is_paid', 1)
            ->orderBy('date_payment', $order)
            ->get();
    }

    public static function findBillById($id){
        return DB::table('bills')->where('bill_id', $id)->first();
    }

    public static function getAllUnpaidBill($columns = ["*"]){
        return DB::table('bills')->where('is_paid',0)->get($columns);
    }

    public static function updateBillById($billId, $updateArr){
        return DB::table('bills')->where('bill_id', $billId)->update($updateArr);
    }

    public static function filterBill($time){
        return DB::table('bills')
            ->join('customers', 'customers.cus_id', '=', 'bills.cus_id')
            ->join('users', 'users.user_id', '=', 'bills.user_id')
            ->where('date_payment', ">=", $time)
            ->where('date_payment', '<=', $time." 23:59:59")
            ->distinct()
            ->get();
    }

    public static function filterListBill($start, $finish){
        return DB::table('bills')
            ->join('customers', 'customers.cus_id', '=', 'bills.cus_id')
            ->join('users', 'users.user_id', '=', 'bills.user_id')
            ->where('date_payment', ">=", $start)
            ->where('date_payment', '<=', $finish." 23:59:59")
            ->distinct()
            ->get();
    }

    public static function findBillByRoomRentedId($roomId){
        return DB::table('room_bills')
            ->join('bills', 'room_bills.bill_id', '=', 'bills.bill_id')
            ->where('is_paid', 0)
            ->where('room_id', $roomId)
            ->distinct()
            ->get();
    }
}
