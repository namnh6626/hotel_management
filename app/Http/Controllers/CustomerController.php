<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Genre;
use DateTime;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        foreach($customers as $customer){
            $customer->genre_name = Genre::findGenreById($customer->genre_id)->genre_name;
        }

        return view('customer.index')->with([
            'customers'=>$customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('customer.create')->with([
            'genres'=>$genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = new Customer();
        $customer->cus_name = $request->cus_name;
        $customer->cus_email = $request->cus_email;
        $customer->phone = $request->phone;
        $customer->citizen_id = $request->citizen_id;
        $customer->genre_id = $request->genre;
        $customer->address = $request->address;
        $customer->date_of_birth = date('Y-m-d',strtotime($request->date_of_birth));

        $customer->save();
        return redirect()->route('customer.show', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        // return $customer;
        $customer->genre_name = Genre::findGenreById($customer->genre_id)->genre_name;
        return view('customer.show')->with([
            'customer'=>$customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $genres = Genre::all();
        // return $genres;
        $customer->genre_name = Genre::findGenreById($customer->genre_id)->genre_name;
        return view('customer.edit')->with([
            'customer'=>$customer,
            'genres' =>$genres
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // return $request;
        $customer->cus_name = $request->cus_name;
        $customer->cus_email = $request->cus_email;
        $customer->phone = $request->phone;
        $customer->citizen_id = $request->citizen_id;
        $customer->genre_id = $request->genre;
        $customer->address = $request->address;

        $date_of_birth = DateTime::createFromFormat('d/m/Y',$request->date_of_birth);
        $customer->date_of_birth = $date_of_birth->format('Y-m-d');

        $customer->save();
        return redirect()->route('customer.show', $customer);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with([
            'msg'=>"Success"
        ]);
    }
}
