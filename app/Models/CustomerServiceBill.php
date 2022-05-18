<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerServiceBill extends Model
{
    use HasFactory;

    protected $table = 'customer_service_bills';
    protected $primaryKey = 'cs_bill_id';
    protected $fillable = [
        'cs_bill_name',
        'cus_name',
        'date_created_bill',
        'user_id',
        'note'
    ];

    public static function getAllCustomerServiceBill(){
        return DB::table('customer_service_bills')->orderByDesc('cs_bill_id')->get();
    }

    public static function findCustomerById($id){
        return DB::table('customer_service_bills')->where('cs_bill_id', $id)->first();
    }
}
