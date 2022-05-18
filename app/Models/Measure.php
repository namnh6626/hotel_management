<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Measure extends Model
{
    use HasFactory;
    protected $table = 'measures';
    protected $primaryKey = 'measure_id';
    protected $fillable = [
        'measure_name'
    ];
    public static function getAllMeasure(){
        return DB::table('measures')->orderByDesc('measure_name')->get();
    }

    public static function findMeasureById($id){
        return DB::table('measures')->where('measure_id', $id)->first();
    }
}
