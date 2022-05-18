<?php

namespace App\Http\Controllers;

use App\Models\WarehouseReceiptType;
use Illuminate\Http\Request;

class WarehouseReceiptTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warehouse-receipt-type.index')->with([
            'warehouseReceiptTypes'=>WarehouseReceiptType::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('warehouse-receipt-type.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $warehouseReceiptType = new WarehouseReceiptType();
        $warehouseReceiptType->warehouse_receipt_type_name = $request->name;
        $warehouseReceiptType->save();
        return redirect()->route('warehouse-receipt-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('warehouse-receipt-type.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('warehouse-receipt-type.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WarehouseReceiptType $warehouseReceiptType)
    {
        $warehouseReceiptType->warehouse_receipt_type_name = $request->name;
        $warehouseReceiptType->save();
        return redirect()->route('warehouse-receipt-type.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseReceiptType $warehouseReceiptType)
    {
        $warehouseReceiptType->delete();
        return redirect()->route('warehouse-receipt-type.index');
    }
}
