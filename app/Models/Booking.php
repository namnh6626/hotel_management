<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    public $timestamps = false;

    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'cus_id',
        'is_checkin',
        'user_id',
        'date_booking'
    ];

    public static function getAllBooking()
    {
        return  DB::table('bookings')

            ->join('customers', 'customers.cus_id', '=', 'bookings.cus_id')
            ->join('users', 'users.user_id', '=', 'bookings.user_id')
            ->distinct()
            ->orderBy('booking_id')
            ->get();
    }

    public static function getAllBookingNotCheckin()
    {
        return DB::table('bookings')
            ->join('customers', 'customers.cus_id', '=', 'bookings.cus_id')
            // ->where('is_checkin', 0)
            // ->where('is_cancel', 0)
            ->distinct()
            ->get();
    }

    public static function findRoomIsReservedById($id, $columns = ["*"])
    {
        return DB::table('bookings')
            ->join('room_bookings', 'room_bookings.booking_id', '=', 'bookings.booking_id')
            ->join('rooms', 'rooms.room_id', '=', 'room_bookings.room_id')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.room_type_id')
            ->where('rooms.room_id', $id)
            ->where('is_checkin', 0)
            ->distinct()
            ->get($columns);
    }

    public static function filterBooking($dateStart, $dateFinish){
        return DB::table('bookings')
            ->join('room_bookings', 'bookings.booking_id', '=', 'room_bookings.booking_id')
            ->join('rooms', 'rooms.room_id', '=', 'room_bookings.room_id')
            ->join('room_types', 'room_types.room_type_id', '=', 'rooms.room_type_id')
            ->join('customers', 'customers.cus_id', '=', 'bookings.cus_id')
            ->join('users', 'users.user_id', '=', 'bookings.user_id')
            ->where('is_checkin', 0)
            ->where('is_cancel', 0)
            ->whereBetween('room_bookings.checkin', [$dateStart, $dateFinish])
            ->distinct()
            ->get();
    }

    public static function bookingCheckin($bookingId){
        return DB::table('bookings')
            ->where('booking_id', $bookingId)
            ->update(['is_checkin'=>1]);
    }

    public static function cancelBooking($bookingId){
        return DB::table('bookings')
            ->where('booking_id', $bookingId)
            ->update(['is_cancel'=>1]);
    }

    public static function cancelBookingOverDate($date){
        return DB::table('bookings')
            ->join('room_bookings', 'bookings.booking_id', '=', 'room_bookings.booking_id')
            ->where('checkin','<=', $date)
            ->where('is_checkin', 0)
            ->update(['is_cancel'=>1]);
            // ->get();
    }

    public static function findBookingById($bookingId){
        return DB::table('bookings')
            ->join('customers', 'customers.cus_id', '=', 'bookings.cus_id')
            ->where('booking_id', $bookingId)
            ->first();
    }

    public static function checkinOnDate($date){
        return DB::table('bookings')
            ->select('bookings.booking_id', 'customers.cus_id', 'cus_name', 'cus_email','bookings.user_id', 'user_name','customers.phone')
            ->join('room_bookings', 'bookings.booking_id', '=', 'room_bookings.booking_id')
            ->join('customers', 'customers.cus_id', '=', 'bookings.cus_id')
            ->join('users', 'users.user_id', '=', 'bookings.user_id')
            ->where('is_cancel', 0)
            ->where('checkin', '>=', $date)
            ->where('checkin', '<=', $date." 23:59:59")
            ->distinct()
            ->get();
    }
}
