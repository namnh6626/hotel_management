<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_name'
    ];

    public static function findRoleById($id){
        return DB::table('user_roles')->where('role_id', $id)->first();
    }
    public static function getAllUserRole(){
        return DB::table('user_roles')->orderBy('role_name')->get();
    }
}
