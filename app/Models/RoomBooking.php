<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomBooking extends Model
{
    use HasFactory;

    protected $table = 'room_bookings';
    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'room_id',
        'checkin',
        'checkout',
    ];



    public static function findRoomsByBookingId($bookingId){
        return DB::table('room_bookings')
        ->join('rooms', 'rooms.room_id', '=', 'room_bookings.room_id')
        ->join('room_types', 'room_types.room_type_id', '=', 'rooms.room_type_id')
        ->join('floors', 'floors.floor_id', '=', 'rooms.floor_id')
        ->join('statuses', 'statuses.status_id', '=', 'rooms.status_id')
        ->where('booking_id', $bookingId)
        ->distinct()
        ->get();
    }

    public static function deleteRoomBooking($bookingId){
        return DB::table('room_bookings')
            ->where('booking_id', $bookingId)
            ->delete();
    }


}
