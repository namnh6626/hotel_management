<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product-type.index')->with([
            'productTypes'=>ProductType::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('product-type.create');
        return redirect()->route('product-type.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productType = new ProductType();
        $productType->product_type_name = $request->name;
        $productType->save();
        return redirect()->route('product-type.show', $productType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        // return view('product-type.show')->with([
        //     'productType'=>$productType
        // ]);
        return redirect()->route('product-type.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        // return view('product-type.edit')->with([
        //     'productType'=>$productType
        // ]);
        return redirect()->route('product-type.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        $productType->product_type_name = $request->name;
        $productType->save();
        // return redirect()->route('product-type.show', $productType);
        return redirect()->route('product-type.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
        return redirect()->route('product-type.index')->with([
            'msg'=>"Xóa thành công"
        ]);
    }
}
