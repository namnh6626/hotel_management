<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductWarehouseReceipt;
use App\Models\Supplier;
use App\Models\User;
use App\Models\WarehouseReceipt;
use App\Models\WarehouseReceiptType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WarehouseReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Product::findProductById(1);
        $warehouseReceipts = WarehouseReceipt::getAllWarehouseReceipt();
        foreach ($warehouseReceipts as $warehouseReceipt) {
            $warehouseReceiptId = $warehouseReceipt->warehouse_receipt_id;
            $warehouseReceipt->warehouse_receipt_type_name = WarehouseReceiptType::findWarehouseReceiptTypeById($warehouseReceipt->warehouse_receipt_type_id)->warehouse_receipt_type_name;
            $warehouseReceipt->user_info = User::findUserById($warehouseReceipt->user_id);
            $products = ProductWarehouseReceipt::findProductsByReceiptId($warehouseReceiptId);
            $warehouseReceipt->list_product = $products;

            $receiptTotal = 0;
            foreach ($products as $product) {
                $productInfo = Product::findProductById($product->product_id);
                $product->product_name = $productInfo->product_name;
                $product->measure_name = $productInfo->measure_name;
                $product->import_price = $productInfo->import_price;
                $product->supplier_name = $productInfo->supplier_name;
                $product->product_type_name = $productInfo->product_type_name;

                $productTotal = $productInfo->import_price * $product->quantity;
                $receiptTotal += $productTotal;
            }
            $warehouseReceipt->total = $receiptTotal;
        }


        $users = User::getAllUser();
        $warehouseReceiptTypes = WarehouseReceiptType::all();
        $products = Product::getAllProduct();
        // return $warehouseReceipts;
        // return $products;
        return view('warehouse-receipt.index')->with([
            'warehouseReceipts' => $warehouseReceipts,
            'users' => $users,
            'warehouseReceiptTypes' => $warehouseReceiptTypes,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::getAllUser();
        $warehouseReceiptTypes = WarehouseReceiptType::all();
        $products = Product::getAllProduct();
        $productTypes = ProductType::all();
        $suppliers = Supplier::all();
        return view('warehouse-receipt.create')->with([
            'users' => $users,
            'warehouseReceiptTypes' => $warehouseReceiptTypes,
            'products' => $products,
            'productTypes' => $productTypes,
            'suppliers' => $suppliers
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
        // return $request->receipt_type;
        $importWarehouseReceiptId = Constant::IMPORT_RECEIPT_ID;
        $exportWarehouseReceiptId = Constant::EXPORT_RECEIPT_ID;


        $warehouseReceipt = new WarehouseReceipt();

        $warehouseReceipt->receipt_created_at = Carbon::now();
        $warehouseReceipt->note = $request->note;
        $warehouseReceipt->user_id = auth()->user()->user_id;
        $warehouseReceipt->warehouse_receipt_type_id = $request->receipt_type;
        $warehouseReceipt->save();
        $receiptId = $warehouseReceipt->warehouse_receipt_id;

        if($request->receipt_type == $importWarehouseReceiptId){
            $warehouseReceipt->warehouse_receipt_name = Constant::PRE_STR_IMPORT_RECEIPT_NAME . (string)$receiptId;
        }else{
            $warehouseReceipt->warehouse_receipt_name = Constant::PRE_STR_EXPORT_RECEIPT_NAME . (string)$receiptId;
        }
        $warehouseReceipt->save();

        //get list product and save to database
        $products = $request->products;
        $quantities = $request->quantities;
        $i = 0;


        foreach ($products as $product) {


            $productReceipt = new ProductWarehouseReceipt();

            $currentWarehouseProductQuantity = Product::findProductById($product)->quantity;

            if ($request->receipt_type == $importWarehouseReceiptId) {
                Product::updateIncrementProductQuantity($product, $quantities[$i]);
            } else {
                Product::updateDecrementProductQuantity($product, $quantities[$i]);
            }
            $productReceipt->warehouse_receipt_id = $receiptId;
            $productReceipt->product_id = $product;
            $productReceipt->quantity = $quantities[$i];
            $productReceipt->save();
            ++$i;
        }

        return redirect()->route('warehouse-receipt.show', $warehouseReceipt);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseReceipt $warehouseReceipt)
    {
        $warehouseReceiptId = $warehouseReceipt->warehouse_receipt_id;
        $warehouseReceipt->warehouse_receipt_type_name = WarehouseReceiptType::findWarehouseReceiptTypeById($warehouseReceipt->warehouse_receipt_type_id)->warehouse_receipt_type_name;
        $warehouseReceipt->user_info = User::findUserById($warehouseReceipt->user_id);
        $products = ProductWarehouseReceipt::findProductsByReceiptId($warehouseReceiptId);
        // return $products;
        $total = 0;
        foreach ($products as $product) {
            $productInfo = Product::findProductById($product->product_id);
            $product->product_name = $productInfo->product_name;
            $product->measure_name = $productInfo->measure_name;
            $product->import_price = $productInfo->import_price;
            $product->supplier_name = $productInfo->supplier_name;
            $product->into_money = $product->import_price * $product->quantity;
            $product->product_type_name = ProductType::findProductTypeById($productInfo->product_type_id)->product_type_name;
            $total += $product->into_money;
        }
        $warehouseReceipt->products = $products;

        $warehouseReceipt->total = $total;
        // return $warehouseReceipt;
        return view('warehouse-receipt.show')->with([
            'warehouseReceipt' => $warehouseReceipt
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseReceipt $warehouseReceipt)
    {
        $warehouseReceiptId = $warehouseReceipt->warehouse_receipt_id;
        $warehouseReceipt->warehouse_receipt_type_name = WarehouseReceiptType::findWarehouseReceiptTypeById($warehouseReceipt->warehouse_receipt_type_id)->warehouse_receipt_type_name;
        $warehouseReceipt->user_info = User::findUserById($warehouseReceipt->user_id);
        $receiptProducts = ProductWarehouseReceipt::findProductsByReceiptId($warehouseReceiptId);
        $total = 0;
        foreach ($receiptProducts as $product) {
            $productInfo = Product::findProductById($product->product_id);
            $product->product_name = $productInfo->product_name;
            $product->measure_name = $productInfo->measure_name;
            $product->import_price = $productInfo->import_price;
            $product->supplier_name = $productInfo->supplier_name;
            $product->product_type_name = $productInfo->product_type_name;
            $product->into_money = $product->import_price * $product->quantity;
            $total += $product->into_money;
        }
        $warehouseReceipt->products = $receiptProducts;

        $warehouseReceipt->total = $total;
        $warehouseReceiptTypes = WarehouseReceiptType::all();
        $productTypes = ProductType::all();
        $products = Product::getAllProduct();
        return view('warehouse-receipt.edit')->with([
            'warehouseReceipt' => $warehouseReceipt,
            'warehouseReceiptTypes' => $warehouseReceiptTypes,
            'products' => $products,
            'productTypes' => $productTypes,
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WarehouseReceipt $warehouseReceipt)
    {
        // return $request;
        $warehouseReceipt->note = $request->note;




        // if ($request->receipt_type == Constant::IMPORT_RECEIPT_ID) {
        //     $warehouseReceipt->warehouse_receipt_name = Constant::PRE_STR_IMPORT_RECEIPT_NAME + $warehouseReceipt->warehouse_receipt_id;
        // } else {
        //     $warehouseReceipt->warehouse_receipt_name = Constant::PRE_STR_EXPORT_RECEIPT_NAME + $warehouseReceipt->warehouse_receipt_id;
        // }
        $warehouseReceipt->save();

        $warehouseReceiptId = $warehouseReceipt->warehouse_receipt_id;

        $listProductInWarehouseReceipt = ProductWarehouseReceipt::findProductsByReceiptId($warehouseReceiptId);

        //change product quantity to original
        if ($warehouseReceiptId == Constant::IMPORT_RECEIPT_ID) {
            foreach ($listProductInWarehouseReceipt as $product) {
                Product::updateDecrementProductQuantity($product->product_id, $product->quantity);
            }
        } else {
            foreach ($listProductInWarehouseReceipt as $product) {
                Product::updateIncrementProductQuantity($product->product_id, $product->quantity);
            }
        }

        // drop data in product_warehouse_receipts table
        ProductWarehouseReceipt::dropProductWarehouseReceiptById($warehouseReceiptId);
        $products = $request->products;
        $quantities = $request->quantities;

        $i = 0;
        foreach ($products as $product) {
            $productReceipt = new ProductWarehouseReceipt();
            $productReceipt->warehouse_receipt_id = $warehouseReceiptId;
            $productReceipt->product_id = $product;
            $productReceipt->quantity = $quantities[$i];
            $productReceipt->save();

            //change product quantity in products table
            if ($warehouseReceiptId == Constant::IMPORT_RECEIPT_ID) {
                Product::updateIncrementProductQuantity($product, $quantities[$i]);
            } else {
                Product::updateDecrementProductQuantity($product, $quantities[$i]);
            }

            ++$i;

        }
        return redirect()->route('warehouse-receipt.show', $warehouseReceipt);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseReceipt $warehouseReceipt)
    {
        $warehouseReceiptId = $warehouseReceipt->warehouse_receipt_id;

        // return original product quantity
        $listProductInWarehouseReceipt = ProductWarehouseReceipt::findProductsByReceiptId($warehouseReceiptId);

        //change product quantity to original

        if ($warehouseReceiptId == Constant::IMPORT_RECEIPT_ID) {
            foreach ($listProductInWarehouseReceipt as $product) {
                Product::updateDecrementProductQuantity($product->product_id, $product->quantity);
            }
        } else {
            foreach ($listProductInWarehouseReceipt as $product) {
                Product::updateIncrementProductQuantity($product->product_id, $product->quantity);
            }
        }


        ProductWarehouseReceipt::dropProductReceiptById($warehouseReceipt->warehouse_receipt_id);

        $warehouseReceipt->delete();
        return redirect()->route('warehouse-receipt.index')->with([
            'msg' => "Xóa thành công"
        ]);
    }
}
