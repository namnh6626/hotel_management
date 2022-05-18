<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'cus_id';
    protected $fillable = [
        'cus_name',
        'phone',
        'cus_email',
        'citizen_id',
        'date_of_birth',
        'address'
    ];

    public static function findCustomerById($id){
        return DB::table('customers')->where('cus_id',$id)->first();
    }

    public static function getAllCustomer(array $columns = ['*']){
        return DB::table('customers')->orderBy('cus_id')->paginate(10);
    }

    public static function searchCustomer($searchText){
        return DB::table('customers')
        ->where('phone', 'LIKE', '%'.$searchText.'%')
        ->orWhere('citizen_id', 'LIKE', '%'.$searchText.'%')
        ->orWhere('cus_name','LIKE','%'.$searchText.'%')
        ->paginate(10);

    }

    public static function findCustomerByPhoneOrCitizenId($phoneOrId){
        return DB::table('customers')->where('citizen_id',$phoneOrId)->orWhere('phone',$phoneOrId)->first();
    }
}
