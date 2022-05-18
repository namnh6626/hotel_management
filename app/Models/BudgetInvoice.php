<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BudgetInvoice extends Model
{
    use HasFactory;
    protected $table = 'budget_invoices';
    protected $primaryKey = 'budget_invoice_id';
    protected $fillable = [
        'budget_invoice_name',
        'amount_of_money',
        'budget_id',
        'date_created_invoice',
        'invoice_note',
    ];

    public static function getAllBudgetInvoice(){
        return DB::table('budget_invoices')
        ->join('users', 'users.user_id','=', 'budget_invoices.user_id')
        ->join('budgets', 'budgets.budget_id','=', 'budget_invoices.budget_id')
        ->join('budget_invoice_types', 'budget_invoice_types.budget_invoice_type_id','=', 'budget_invoices.budget_invoice_type_id')
        ->distinct()
        ->orderByDesc('budget_invoice_id')->get();
    }

    public static function findBudgetInvoiceById($id){
        return DB::table('budget_invoices')->where('budget_invoice_id', $id)->first();
    }

    public static function searchBudgetInvoice($searchText){
        return DB::table('budget_invoices')
        ->join('users', 'users.user_id','=', 'budget_invoices.user_id')
        ->join('budgets', 'budgets.budget_id','=', 'budget_invoices.budget_id')
        ->join('budget_invoice_types', 'budget_invoice_types.budget_invoice_type_id','=', 'budget_invoices.budget_invoice_type_id')
        ->where('budget_invoice_name', 'LIKE', '%'.$searchText.'%')
        ->orWhere('user_name', 'LIKE', '%'.$searchText.'%')
        ->orWhere('budget_name','LIKE','%'.$searchText.'%')
        ->orWhere('budget_invoice_type_name','LIKE','%'.$searchText.'%')
        ->distinct()
        ->get();

    }

    public static function filterBudgetInvoice($start, $finish){
        return DB::table('budget_invoices')
        ->join('users', 'users.user_id','=', 'budget_invoices.user_id')
        ->join('budgets', 'budgets.budget_id','=', 'budget_invoices.budget_id')
        ->join('budget_invoice_types', 'budget_invoice_types.budget_invoice_type_id','=', 'budget_invoices.budget_invoice_type_id')
        ->where('date_created_invoice', '>=', $start)
        ->where('date_created_invoice', '<=', $finish." 23:59:59")
        ->distinct()
        ->get();

    }
}
