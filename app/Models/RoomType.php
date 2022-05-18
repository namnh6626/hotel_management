<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'room_types';
    protected $primaryKey = 'room_type_id';
    protected $fillable = [
        'type_name',
        'price',
        'guest_name',
        'room_des'
    ];

    public static function findRoomTypeById($id){
        return DB::table('room_types')->where('room_type_id',$id)->first(['type_name','price','guest_number']);
    }
    public static function getAllRoomType(){
        return DB::table('room_types')->orderBy('type_name')->get();
    }


}
