<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Budget extends Model
{
    use HasFactory;
    protected $table = 'budgets';
    protected $primaryKey = 'budget_id';
    protected $fillable = [
        'budget_name',
        'amount'
    ];

    // public static function getAllBudget(){
    //     return DB::table('budgets')->get();
    // }

    public static function findBudgetById($id){
        return DB::table('budgets')->where('budget_id', $id)->first(['budget_name', 'amount']);
    }


    public static function updateBudget($budgetId, $updateArr){
        return DB::table('budgets')->where('budget_id', $budgetId)->update($updateArr);
    }

    public static function incrementBudgetAmount($budgetId, $incrementValue){
        return DB::table('budgets')
            ->where('budget_id', $budgetId)
            ->increment('amount', $incrementValue);
    }

    public static function decrementBudgetAmount($budgetId, $incrementValue){
        return DB::table('budgets')
            ->where('budget_id', $budgetId)
            ->decrement('amount', $incrementValue);
    }
}
