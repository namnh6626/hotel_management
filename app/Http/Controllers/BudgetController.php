<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('budget.index')->with([
            'budgets'=>Budget::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('budget.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $budget = new Budget();
        $budget->budget_name = $request->name;

        $amount = (int)preg_replace("/([^0-9\\.])/i", "", $request->amount);
        $budget->amount = $amount;

        $budget->save();
        return redirect()->route('budget.show', $budget);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        // return view('budget.show')->with([
        //     'budget'=>$budget
        // ]);
        return redirect()->route('budget.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        return view('budget.edit')->with([
            'budget'=>$budget
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        $budget->budget_name = $request->name;

        $amount = (int)preg_replace("/([^0-9\\.])/i", "", $request->amount);
        $budget->amount = $amount;

        $budget->save();
        return redirect()->route('budget.show', $budget)->with([
            'budget'=>$budget
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect()->route('budget.index')->with([
            'msg'=>"Success"
        ]);
    }
}
