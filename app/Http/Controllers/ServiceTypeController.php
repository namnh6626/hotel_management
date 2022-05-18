<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('service-type.index')->with([
            'serviceTypes'=>ServiceType::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serviceType = new ServiceType();
        $serviceType->service_type_name = $request->name;
        $serviceType->save();
        return redirect()->route('service-type.show'. $serviceType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceType $serviceType)
    {
        // return view('service-type.show')->with([
        //     'serviceType'=>$serviceType
        // ]);
        return redirect()->route('service-type.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceType $serviceType)
    {
        return view('service-type.edit')->with([
            'serviceType'=>$serviceType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceType $serviceType)
    {
        $serviceType->service_type_name = $request->name;
        $serviceType->save();
        return redirect()->route('service-type.show'. $serviceType);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        return redirect()->route('service-type.index')->with([
            'msg'=>'Xóa thành công'
        ]);
    }
}
