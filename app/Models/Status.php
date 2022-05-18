<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $primaryKey = 'status_id';
    protected $fillable = [
        'status_name'
    ];

    public static function getAllStatus(){
        return DB::table('statuses')->orderBy('status_name')->get();
    }

    public static function findStatusById($id){
        return DB::table('statuses')->where('status_id', $id)->first('status_name');
    }
}
