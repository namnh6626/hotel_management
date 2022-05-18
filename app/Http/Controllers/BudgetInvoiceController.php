<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Models\Budget;
use App\Models\BudgetInvoice;
use App\Models\BudgetInvoiceType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetInvoiceController extends Controller
{
    public function searchBudgetInvoice(Request $request){
        $results = BudgetInvoice::searchBudgetInvoice($request->search);
        // return $results;
        return view('budget-invoice.search')->with([
            'results'=>$results,
            'searchText'=>$request->search,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetInvoices = BudgetInvoice::getAllBudgetInvoice();
        // return $budgetInvoices;
        return view('budget-invoice.index')->with([
            'budgetInvoices'=>$budgetInvoices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $budgetInvoiceTypes = BudgetInvoiceType::all();
        $budgets = Budget::all();
        return view('budget-invoice.create')->with([
            'budgetInvoiceTypes'=>$budgetInvoiceTypes,
            'budgets'=>$budgets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $importInvoiceId = Constant::IMPORT_BUDGET_INVOICE_ID;
        $exportInvoiceId = Constant::EXPORT_BUDGET_INVOICE_ID;
        $budgetInvoice = new BudgetInvoice();


         //string currency to number
        $amount = (int)preg_replace("/([^0-9\\.])/i", "", $request->amount);
        $budgetInvoice->amount_of_money = $amount;

        $budgetInvoice->budget_invoice_type_id = $request->invoice_type;
        $budgetInvoice->budget_id = $request->budget_type;
        $budgetInvoice->user_id = auth()->user()->user_id;
        $budgetInvoice->date_created_invoice = Carbon::now();
        $budgetInvoice->invoice_note = $request->note;
        $budgetInvoice->save();

        $budgetInvoiceId = $budgetInvoice->budget_invoice_id;

        if($request->invoice_type == $importInvoiceId){
            $budgetInvoice->budget_invoice_name = Constant::PRE_STR_IMPORT_BUDGET_NAME . (string)$budgetInvoiceId;
        }else{
            $budgetInvoice->budget_invoice_name = Constant::PRE_STR_EXPORT_BUDGET_NAME . (string)$budgetInvoiceId;
        }

        $budgetInvoice->save();


        if($request->invoice_type == $importInvoiceId){
            // $newBudgetAmount = $budgetInvoice->amount_of_money + $budgetAmount;
            Budget::incrementBudgetAmount($request->budget_type, $amount);
        }else{
            Budget::decrementBudgetAmount($request->budget_type, $amount);
        }

        return redirect()->route('budget-invoice.show', $budgetInvoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetInvoice $budgetInvoice)
    {
        $budgetInvoice->budget_info = Budget::findBudgetById($budgetInvoice->budget_id);
        $budgetInvoice->invoice_type = BudgetInvoiceType::findBudgetInvoiceTypeById($budgetInvoice->budget_invoice_type_id);
        $budgetInvoice->user_info = User::findUserById($budgetInvoice->user_id);
        // return $budgetInvoice;
        return view('budget-invoice.show')->with([
            'budgetInvoice'=>$budgetInvoice,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetInvoice $budgetInvoice)
    {
        $budgetInvoiceTypes = BudgetInvoiceType::all();
        $budgets = Budget::all();
        $users = User::getAllUser();

        $budgetInvoice->budget_invoice_type_name = BudgetInvoiceType::findBudgetInvoiceTypeById($budgetInvoice->budget_invoice_type_id)->budget_invoice_type_name;
        $budgetInvoice->budget_name = Budget::findBudgetById($budgetInvoice->budget_id)->budget_name;
        $budgetInvoice->user_info = User::findUserById($budgetInvoice->user_id);
        // return $budgetInvoice;

        return view('budget-invoice.edit')->with([
            'budgetInvoice'=>$budgetInvoice,
            'budgetInvoiceTypes'=>$budgetInvoiceTypes,
            'budgets'=>$budgets,
            'users'=>$users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetInvoice $budgetInvoice)
    {
        $importInvoiceId = 1;
        $exportInvoiceId = 2;
        $currentBudgetInvoiceTypeId = $budgetInvoice->budget_invoice_type_id;
        $currentBudgetId = $budgetInvoice->budget_id;

        $updateBudgetOfInvoiceTypeId = $request->invoice_type;
        $updateBudgetId = $request->budget_type;

        //string currency to number
        $updateInvoiceAmount = (int)preg_replace("/([^0-9\\.])/i", "", $request->amount);
        $currentInvoiceAmount = $budgetInvoice->amount_of_money;

        $currentBudgetOfInvoiceAmount = Budget::findBudgetById($budgetInvoice->budget_id)->amount;
        $updateBudgetOfInvoiceAmount = Budget::findBudgetById($request->budget_type)->amount;


        //set budget amount to original before store this invoice
        if($currentBudgetInvoiceTypeId == $importInvoiceId){
            Budget::decrementBudgetAmount($budgetInvoice->budget_id, $currentInvoiceAmount);
        }else{
            Budget::incrementBudgetAmount($budgetInvoice->budget_id, $currentInvoiceAmount);
        }

        // update budget with new invoice

        //update budget amount when update invoice
        if($updateBudgetOfInvoiceTypeId == $importInvoiceId){
            Budget::incrementBudgetAmount($updateBudgetId, $updateInvoiceAmount);
        }else{
            Budget::decrementBudgetAmount($updateBudgetId, $updateInvoiceAmount);
        }

        // if($currentBudgetId == $updateBudgetId){

        //     if($updateBudgetOfInvoiceTypeId == $currentBudgetInvoiceTypeId){

        //         if($updateBudgetOfInvoiceTypeId == $importInvoiceId){
        //             $newBudgetAmount = $currentBudgetOfInvoiceAmount - $currentInvoiceAmount + $updateInvoiceAmount;
        //         }else{
        //             $newBudgetAmount = $currentBudgetOfInvoiceAmount + $currentInvoiceAmount - $updateInvoiceAmount;
        //         }
        //         Budget::updateBudget($updateBudgetId, ['amount'=>$newBudgetAmount]);
        //     }else{

        //         if($updateBudgetOfInvoiceTypeId == $importInvoiceId){
        //             $newBudgetAmount = $currentBudgetOfInvoiceAmount + $currentInvoiceAmount + $updateInvoiceAmount;
        //         }else{
        //             $newBudgetAmount = $currentBudgetOfInvoiceAmount - $currentInvoiceAmount - $updateInvoiceAmount;
        //         }
        //         Budget::updateBudget($updateBudgetId, ['amount'=>$newBudgetAmount]);

        //     }
        // }else{
        //     if($updateBudgetOfInvoiceTypeId == $currentBudgetInvoiceTypeId){

        //         if($updateBudgetOfInvoiceTypeId == $importInvoiceId){
        //             $currentBudgetAmount = $currentBudgetOfInvoiceAmount - $currentInvoiceAmount;
        //             $updateBudgetAmount = $updateBudgetOfInvoiceAmount  + $updateInvoiceAmount;
        //         }else{
        //             $currentBudgetAmount = $currentBudgetOfInvoiceAmount + $currentInvoiceAmount;
        //             $updateBudgetAmount = $updateBudgetOfInvoiceAmount  - $updateInvoiceAmount;                }
        //         Budget::updateBudget($currentBudgetId, ['amount'=>$currentBudgetAmount]);
        //         Budget::updateBudget($updateBudgetId, ['amount'=>$updateBudgetAmount]);
        //     }else{

        //         if($updateBudgetOfInvoiceTypeId == $importInvoiceId){
        //             $currentBudgetAmount = $currentBudgetOfInvoiceAmount + $currentInvoiceAmount;
        //             $updateBudgetAmount = $updateBudgetOfInvoiceAmount  + $updateInvoiceAmount;
        //         }else{
        //             $currentBudgetAmount = $currentBudgetOfInvoiceAmount - $currentInvoiceAmount;
        //             $updateBudgetAmount = $updateBudgetOfInvoiceAmount  - $updateInvoiceAmount;
        //         }
        //         Budget::updateBudget($currentBudgetId, ['amount'=>$currentBudgetAmount]);
        //         Budget::updateBudget($updateBudgetId, ['amount'=>$updateBudgetAmount]);
        //     }
        // }

        $budgetInvoice->budget_invoice_name = $request->name;

        //string currency to number
        $amount = (int)preg_replace("/([^0-9\\.])/i", "", $request->amount);
        $budgetInvoice->amount_of_money = $amount;

        $budgetInvoice->user_id = $request->user_id;
        $budgetInvoice->budget_id = $request->budget_type;
        $budgetInvoice->invoice_note = $request->note;
        $budgetInvoice->budget_invoice_type_id = $request->invoice_type;
        $budgetInvoice->user_id = $request->user_id;

        $budgetInvoice->save();
        return redirect()->route('budget-invoice.show', $budgetInvoice);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetInvoice $budgetInvoice)
    {
        // set budget amount
        $importInvoiceId = Constant::IMPORT_BUDGET_INVOICE_ID;
        $budgetInvoiceId = $budgetInvoice->budget_invoice_id;
        $budgetInvoiceAmount = $budgetInvoice->amount_of_money;
        if($budgetInvoiceId == $importInvoiceId){
            Budget::decrementBudgetAmount($budgetInvoiceId, $budgetInvoiceAmount);
        }else{
            Budget::incrementBudgetAmount($budgetInvoiceId, $budgetInvoiceAmount);
        }
        $budgetInvoice->delete();
        return redirect()->route('budget-invoice.index')->with([
            'msg'=>"Success"
        ]);
    }
}
