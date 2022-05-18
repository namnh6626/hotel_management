<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BudgetInvoiceType extends Model
{
    use HasFactory;
    protected $table = 'budget_invoice_types';
    protected $primaryKey = 'budget_invoice_type_id';
    protected $fillable = [
        'budget_invoice_type_name'
    ];

    public static function getAllBudgetInvoiceType(){
        return DB::table('budget_invoice_types')->orderByDesc('budget_invoice_type_name')->get();
    }

    public static function findBudgetInvoiceTypeById($id){
        return DB::table('budget_invoice_types')->where('budget_invoice_type_id', $id)->first();
    }
}
