<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Floor extends Model
{
    use HasFactory;

    protected $table = 'floors';
    protected $primaryKey = 'floor_id';
    protected $fillable = [
        'floor_name'
    ];

    public $timestamps = false;

    public static function getFloorById($floorId)
    {
        return DB::table('floors')->where('floor_id', $floorId)->first();
    }
}
