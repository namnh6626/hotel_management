<?php

namespace App\Models;

use App\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    protected $fillable = [
        'room_name',
        'room_type_id',
        'status_id'
    ];


    public static function findRoomInfoById($id)
    {
        return DB::table('rooms')
        ->join('room_types', 'room_types.room_type_id', '=', 'rooms.room_type_id')
        ->join('floors', 'floors.floor_id', '=', 'rooms.floor_id')
        ->where('room_id', $id)
        ->first();
    }


    public static function getAllRoom()
    {
        return DB::table('rooms')
        ->join('room_types', 'room_types.room_type_id', '=', 'rooms.room_type_id')
        ->join('floors', 'floors.floor_id', '=', 'rooms.floor_id')
        ->orderBy('room_name')->get();
    }


    public static function getListRoomIdByStatusId($statusId, $columns = ['room_id'])
    {
        return DB::table('rooms')->where('status_id', $statusId)->get($columns);
    }


    public static function getRoomInfoIsRented($id)
    {
        return DB::table('rooms')
            ->join('room_bills', 'rooms.room_id', '=', 'room_bills.room_id')
            ->join('bills', 'bills.bill_id', '=', 'room_bills.bill_id')
            ->join('service_bills', 'service_bills.bill_id', '=', 'bills.bill_id')
            ->join('customers', 'bills.cus_id', '=', 'customers.cus_id')
            ->where('bills.is_paid', '=', 0)
            ->where('rooms.room_id', $id)
            // ->distinct()
            ->get(['rooms.room_id', 'service_id', 'customers.cus_id', 'quantity']);




        // SELECT DISTINCT rooms.room_id,service_id,customers.cus_id FROM rooms
        // JOIN room_bills on rooms.room_id = room_bills.room_id
        // JOIN bills on bills.bill_id = room_bills.bill_id
        // JOIN service_bills on service_bills.room_id = rooms.room_id
        // JOIN customers on bills.cus_id = customers.cus_id
        // WHERE bills.is_paid = 0 AND rooms.room_id = 3;

    }

    public static function getListServiceRoomRented($roomId){
        return DB::table('rooms')
            ->join('room_bills', 'room_bills.room_id', '=', 'rooms.room_id')
            ->join('bills', 'bills.bill_id', '=', 'room_bills.bill_id')
            ->join('service_bills', 'service_bills.bill_id', '=', 'bills.bill_id')
            ->join('services', 'services.service_id', '=', 'service_bills.service_id')
            ->join('service_types', 'services.service_type_id', '=', 'service_types.service_type_id')
            ->where('is_paid', 0)
            ->where('rooms.room_id', $roomId)
            ->distinct()
            ->get(['services.service_id', 'services.service_name', 'services.service_price','service_type_name', 'service_price', 'quantity']);

    }

    public static function getBillInfoRoomRented($roomId){
        return DB::table('rooms')
        ->join('room_bills', 'room_bills.room_id', '=', 'rooms.room_id')
        ->join('bills', 'room_bills.bill_id', '=', 'bills.bill_id')
        ->join('customers', 'customers.cus_id', '=', 'bills.cus_id')
        ->where('is_paid', 0)
        ->where('rooms.room_id', $roomId)
        ->distinct()
        ->first();
    }

    public static function checkRoomIsBookedById($id, $checkin, $checkout)
    {
        return DB::table('bookings')
            ->where('room_id', $id)
            ->where('is_checkin', 0)
            ->where('checkin', $checkin)
            ->where('checkout', $checkout)
            ->first();
    }

    public static function changeRoomStatus($roomId, $statusId)
    {
        return DB::table('rooms')->where('room_id', $roomId)->update(['status_id' => $statusId]);
    }

    public static function findRoomStatusId($roomId)
    {
        return DB::table('rooms')->where('room_id', $roomId)->first('status_id');
    }

    public static function getRoomSameCustomerAndBill($billId, $columns = ['*'])
    {
        return DB::table('rooms')
            ->join('room_bills', 'rooms.room_id', '=', 'room_bills.room_id')
            ->join('bills', 'bills.bill_id', '=', 'room_bills.bill_id')
            ->join('customers', 'customers.cus_id', '=', 'bills.cus_id')
            ->where('bills.is_paid', '=', 0)
            ->where('bills.bill_id', '=', $billId)
            ->get($columns);
    }

    public static function findRoomIsBookedToBookOrCheckin($checkin, $checkout, $type)
    {
        if ($type == 0) {
            return DB::table('rooms')
                ->select(['rooms.room_id'])

                ->join('room_bookings', 'room_bookings.room_id', '=', 'rooms.room_id')
                ->join('bookings', 'bookings.booking_id', '=', 'room_bookings.booking_id')
                ->where('bookings.is_checkin', 0)
                ->where(function ($query) use ($checkin, $checkout) {
                    // $query->where('room_bookings.checkin', '>', $checkout)
                    //     ->orWhere('room_bookings.checkout', '<', $checkin);

                    $query->where(function ($newQuery) use ($checkin, $checkout){
                        $newQuery->where('checkin', '>=', $checkin)
                                ->where('checkin', '<=', $checkout);
                    })
                        ->orWhere(function ($newQuery) use ($checkin, $checkout){
                            $newQuery->where('checkout', '>=', $checkin)
                                ->where('checkout', '<=', $checkout);
                        })
                        ->orWhere(function ($newQuery) use ($checkin, $checkout){
                            $newQuery->where('checkin', '<=', $checkin)
                                ->where('checkout', '>=', $checkout);
                        });
                })
                ->orderBy('rooms.room_id')
                ->distinct()
                ->get();
        }
        return DB::table('rooms')
            ->select(['rooms.room_id'])

            ->join('room_bookings', 'room_bookings.room_id', '=', 'rooms.room_id')
            ->join('bookings', 'bookings.booking_id', '=', 'room_bookings.booking_id')
            ->where('bookings.is_checkin', 0)
            ->where(function ($query) use ($checkin, $checkout) {
                // $query->where('room_bookings.checkin', '>', $checkout)
                //     ->orWhere('room_bookings.checkout', '<', $checkin);

                $query->where(function ($newQuery) use ($checkin, $checkout){
                    $newQuery->where('checkin', '>=', $checkin)
                            ->where('checkin', '<=', $checkout);
                })
                    ->orWhere(function ($newQuery) use ($checkin, $checkout){
                        $newQuery->where('checkout', '>=', $checkin)
                            ->where('checkout', '<=', $checkout);
                    })
                    ->orWhere(function ($newQuery) use ($checkin, $checkout){
                        $newQuery->where('checkin', '<=', $checkin)
                            ->where('checkout', '>=', $checkout);
                    });
            })
            ->where('rooms.room_type_id', $type)
            ->orderBy('rooms.room_id')
            ->distinct()
            ->get();
    }

    public static function getAllRoomId($type){
        if($type==0){
            return DB::table('rooms')
                ->where('rooms.status_id', '!=', Constant::REPAIRED_ROOM_STATUS)
                ->get('room_id');
        }else{
            return DB::table('rooms')
                ->where('rooms.status_id', '!=', Constant::REPAIRED_ROOM_STATUS)
                ->where('rooms.room_type_id', $type)
                ->get('room_id');
        }
    }

    public static function findRoomIsRentedToBook($checkin, $checkout, $type)
    {
        if ($type == 0) {
            return DB::table('rooms')
                ->select(['rooms.room_id'])

                ->join('room_bills', 'room_bills.room_id', '=', 'rooms.room_id')
                ->join('bills', 'bills.bill_id', '=', 'room_bills.bill_id')
                ->where('bills.is_paid', 0)
                ->where(function ($query) use ($checkin, $checkout) {
                    $query->where(function ($newQuery) use ($checkin, $checkout){
                        $newQuery->where('date_checkin', '>=', $checkin)
                                ->where('date_checkin', '<=', $checkout);
                    })
                        ->orWhere(function ($newQuery) use ($checkin, $checkout){
                            $newQuery->where('date_checkout', '>=', $checkin)
                                ->where('date_checkout', '<=', $checkout);
                        })
                        ->orWhere(function ($newQuery) use ($checkin, $checkout){
                            $newQuery->where('date_checkin', '<=', $checkin)
                                ->where('date_checkout', '>=', $checkout);
                        });
                })
                ->orderBy('rooms.room_id')
                ->distinct()
                ->get();
        }
        return DB::table('rooms')
            ->select(['rooms.room_id'])

            ->join('room_bills', 'room_bills.room_id', '=', 'rooms.room_id')
            ->join('bills', 'bills.bill_id', '=', 'room_bills.bill_id')
            ->where('bills.is_paid', 0)
            ->where(function ($query) use ($checkin, $checkout) {
                $query->where(function ($newQuery) use ($checkin, $checkout){
                    $newQuery->where('date_checkin', '>=', $checkin)
                            ->where('date_checkin', '<=', $checkout);
                })
                    ->orWhere(function ($newQuery) use ($checkin, $checkout){
                        $newQuery->where('date_checkout', '>=', $checkin)
                            ->where('date_checkout', '<=', $checkout);
                    })
                    ->orWhere(function ($newQuery) use ($checkin, $checkout){
                        $newQuery->where('date_checkin', '<=', $checkin)
                            ->where('date_checkout', '>=', $checkout);
                    });
            })
            ->where('rooms.room_type_id', $type)
            ->orderBy('rooms.room_id')
            ->distinct()
            ->get();
    }

    public static function getRoomEmpty($type)
    {
        $isEmptyStatus = 1;
        $isDirtyStatus = 4;
        if ($type == 0) {
            return DB::table('rooms')
            ->select(['rooms.room_id'])
                ->where('status_id', $isEmptyStatus)
                ->orWhere('status_id', $isDirtyStatus)
                ->orderBy('rooms.room_id')
                ->get();
        }
        return DB::table('rooms')
        ->select(['rooms.room_id'])
        ->join('room_types', 'room_types.room_type_id', '=', 'rooms.room_type_id')

            ->where(function ($query) use ($isEmptyStatus, $isDirtyStatus) {
                $query->where('rooms.status_id', $isDirtyStatus)
                    ->orWhere('rooms.status_id', $isEmptyStatus);
            })
            ->orderBy('rooms.room_id')
            ->get();
    }


    public static function checkRoomIsBooked($roomId)
    {
        return DB::table('room_bills')
            ->join('rooms', 'rooms.room_id', '=', 'room_bills.room_id')
            ->join('room_bookings', 'room_bookings.room_id', '=', 'rooms.room_id')
            ->join('bookings', 'bookings.booking_id', '=', 'room_bookings.booking_id')
            ->join('statuses', 'statuses.status_id', '=', 'rooms.status_id')
            ->where('rooms.room_id', $roomId)
            ->where('bookings.is_checkin', 0)
            ->get();
    }


    public static function getCountRoom(){
        return DB::table('rooms')->count();
    }
}
