<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShiftType extends Model
{
    use HasFactory;
    protected $table = 'shift_types';
    protected $primaryKey = 'shift_type_id';
    protected $fillable = [
        'shift_type_name',
        'time_start',
        'time_finish',
        'is_tomorrow'
    ];

    public static function getAllShift(){
        return DB::table('shift_types')->orderByDesc('shift_type_id')->get();
    }

    public static function findShiftTypeById($id){
        return DB::table('shift_types')->where('shift_type_id', $id)->first();
    }
}
