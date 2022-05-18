<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shifts';
    protected $primaryKey = 'shift_id';
    protected $fillable = [
        'date_start',
        'date_finish',
        'shift_type_id',
        'user_id'
    ];

    public static function getAllShift(){
        return DB::table('shifts')->orderByDesc('shift_id')->get();
    }

    public static function findShiftById($id){
        return DB::table('shifts')->where('shift_id', $id)->first();
    }
}
