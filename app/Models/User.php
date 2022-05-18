<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_name',
        'user_email',
        'phone',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAllUser(){
        return DB::table('users')
        ->join('user_roles', 'user_roles.role_id','=', 'users.role_id')
        ->orderBy('user_name')
        ->distinct()
        ->get();
    }

    public static function findUserById($id){
        $user = DB::table('users')->where('user_id', $id)->first(['user_name', 'user_email','phone','role_id']);

        $user->role_name = DB::table('user_roles')->where('role_id', $user->role_id)->first()->role_name;
        return $user;
    }
}
