<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productTypes = ProductType::all();
        $measures = Measure::all();
        $suppliers = Supplier::all();
        return view('product.index')->with([
            'products'=>Product::getAllProduct(),
            'productTypes'=>$productTypes,
            'measures'=>$measures,
            'suppliers'=>$suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product();
        $product->product_name = $request->name;

        $price = (int)preg_replace("/([^0-9\\.])/i", "", $request->price);
        $product->import_price = $price;

        $product->product_type_id = $request->type;
        $product->supplier_id = $request->supplier;
        $product->measure_id = $request->measure;

        $product->save();
        return redirect()->route('product.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $productTypes = ProductType::all();
        $measures = Measure::all();
        $suppliers = Supplier::all();

        $product->product_type_name = ProductType::findProductTypeById($product->product_type_id)->product_type_name;
        $product->measure_name = Measure::findMeasureById($product->measure_id)->measure_name;
        $product->supplier_name = Supplier::findSupplierById($product->supplier_id)->supplier_name;
        return view('product.show')->with([
            'product'=>$product,
            'productTypes'=>$productTypes,
            'measures'=>$measures,
            'suppliers'=>$suppliers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // $product->product_type_name = ProductType::findProductTypeById($product->product_type_id)->product_type_name;
        // $product->supplier_name = Supplier::findSupplierById($product->supplier_id)->supplier_name;
        // $product->measure = Measure::findMeasureById($product->measure_id)->measure_name;
        // $productTypes = ProductType::all();
        // $suppliers = Supplier::all();
        // $measures = Measure::all();
        // return view('product.edit')->with([
        //     'product'=>$product,
        //     'productTypes'=>$productTypes,
        //     'suppliers'=>$suppliers,
        //     'measures'=>$measures,
        // ]);

        return redirect()->route('product.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->product_name = $request->name;

        $price = (int)preg_replace("/([^0-9\\.])/i", "", $request->price);
        $product->import_price = $price;

        $product->quantity = $request->quantity;
        $product->product_type_id = $request->type;
        $product->supplier_id = $request->supplier;
        $product->measure_id = $request->measure;
        $product->save();
        return redirect()->route('product.show', $product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with([
            'msg'=>"Xóa thành công"
        ]);
    }
}
