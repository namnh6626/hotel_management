<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetInvoiceType;
use Illuminate\Http\Request;

class BudgetInvoiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('budget-invoice-type.index')->with([
            'budgetInvoiceTypes'=>BudgetInvoiceType::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('budget-invoice-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $budgetInvoiceType = new BudgetInvoiceType();
        $budgetInvoiceType->budget_invoice_type_name = $request->name;
        $budgetInvoiceType->save();
        return redirect()->route('budget-invoice-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('budget-invoice-type.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetInvoiceType $budgetInvoiceType)
    {
        return view('budget-invoice-type.edit')->with([
            'budgetInvoiceType'=>$budgetInvoiceType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BudgetInvoiceType $budgetInvoiceType)
    {
        $budgetInvoiceType->budget_invoice_type_name = $request->name;
        $budgetInvoiceType->save();
        return redirect()->route('budget-invoice-type.index')->with([
            'msg'=>'Cập nhật thành công'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetInvoiceType $budgetInvoiceType)
    {
        $budgetInvoiceType->delete();
        return redirect()->route('budget-invoice-type.index')->with([
            'msg'=>'Xóa thành công'
        ]);
    }
}
