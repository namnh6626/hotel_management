<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerServiceBill;
use App\Models\Service;
use App\Models\ServiceBill;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerServiceBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerServiceBills = CustomerServiceBill::all();
        foreach($customerServiceBills as $customerServiceBill){
            $billId = $customerServiceBill->cs_bill_id;
            $customerServiceBill->user_info = User::findUserById($customerServiceBill->user_id);
            $serviceInfo = ServiceBill::findServicesByServiceBillId($billId);
            $customerServiceBill->listService = $serviceInfo;
            $customerServiceBill->total = 0;
            foreach($serviceInfo as $service){
                $serviceInfo = Service::findServiceById($service->service_id);
                $service->service_name = $serviceInfo->service_name;
                $service->service_price = $serviceInfo->service_price;
                $service->into_money = $service->quantity * $service->service_price;
                $customerServiceBill->total += $service->into_money;
            }
        }
        return view('customer-service-bill.index')->with([
            'customerServiceBills'=>$customerServiceBills
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        //$user = auth()->user()
        $services = Service::all();
        return view('customer-service-bill.create')->with([
            'user'=>$user,
            'services'=>$services,
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
        $customerServiceBill = new CustomerServiceBill();
        $quantities = $request->quantities;
        $customerServiceBill->cs_bill_name = $request->bill_name;
        $customerServiceBill->cus_name = $request->cus_name;
        $customerServiceBill->date_created_bill = $request->date;
        $customerServiceBill->user_id = $request->user;
        $customerServiceBill->note = $request->note;
        $customerServiceBill->save();
        $i = 0;
        foreach($request->services as $service){
            $serviceBill = new ServiceBill();
            $serviceBill->cs_bill_id = $customerServiceBill;
            $serviceBill->service_id = $service;
            $serviceBill->quantity = $quantities[$i];
            $serviceBill->save();
            ++$i;
        }
        return redirect()->route('customer-service-bill.show', $customerServiceBill);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerServiceBill $customerServiceBill)
    {
        $billId = $customerServiceBill->cs_bill_id;
        $customerServiceBill->user_info = User::findUserById($customerServiceBill->user_id);
        $serviceInfo = ServiceBill::findServicesByServiceBillId($billId);
        $customerServiceBill->listService = $serviceInfo;
        $customerServiceBill->total = 0;
        foreach($serviceInfo as $service){
            $serviceInfo = Service::findServiceById($service->service_id);
            $service->service_name = $serviceInfo->service_name;
            $service->service_price = $serviceInfo->service_price;
            $service->into_money = $service->quantity * $service->service_price;
            $customerServiceBill->total += $service->into_money;
        }
        return view('customer-service-bill.show')->with([
            'customerServiceBill'=>$customerServiceBill
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerServiceBill $customerServiceBill)
    {
        $billId = $customerServiceBill->cs_bill_id;
        $customerServiceBill->user_info = User::findUserById($customerServiceBill->user_id);
        $serviceInfo = ServiceBill::findServicesByServiceBillId($billId);
        $customerServiceBill->listService = $serviceInfo;
        $customerServiceBill->total = 0;
        foreach($serviceInfo as $service){
            $serviceInfo = Service::findServiceById($service->service_id);
            $service->service_name = $serviceInfo->service_name;
            $service->service_price = $serviceInfo->service_price;
            $service->into_money = $service->quantity * $service->service_price;
            $customerServiceBill->total += $service->into_money;
        }
        $services = Service::all();
        $users = User::all();
        //$user = auth()->user();
        return view('customer-service-bill.edit')->with([
            'customerServiceBill'=>$customerServiceBill,
            'services'=>$services,
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
    public function update(Request $request, CustomerServiceBill $customerServiceBill)
    {
        $services = $request->services;
        $quantities = $request->quantities;
        $billId = $customerServiceBill->cs_bill_id;
        $customerServiceBill->cs_bill_name = $request->bill_name;
        $customerServiceBill->cus_name = $request->cus_name;
        $customerServiceBill->date_created_bill = $request->date;
        $customerServiceBill->user_id = $request->user;
        $customerServiceBill->note = $request->note;
        $customerServiceBill->save();
        ServiceBill::dropServiceBillById($customerServiceBill->cs_bill_id);
        $i = 0;
        foreach($services as $service){
            $serviceBill = new ServiceBill();
            $serviceBill->service_id = $service;
            $serviceBill->cs_bill_id = $billId;
            $serviceBill->quantity = $quantities[$i];
            $serviceBill->save();
            ++$i;
        }
        return redirect()->route('customer-service-bill.show', $customerServiceBill);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerServiceBill $customerServiceBill)
    {
        $customerServiceBill->delete();
        return redirect()->route('customer-service-bill.index')->with([
            'msg'=>'Xóa thành công'
        ]);
    }
}
