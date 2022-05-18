<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function filterService(Request $request)
    {
        $room = $request->room;
        $type = $request->type;
        if ($type == 0) {
            $data = Service::getAllService();
        } else {
            $data = Service::filterService($type);
        }
        return response()->json([$data, $room] );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::getAllService();
        foreach ($services as $service) {
            $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
        }
        return view('service.index')->with([
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceTypes = ServiceType::all();
        // return $serviceTypes;
        return view('service.create')->with([
            'serviceTypes' => $serviceTypes
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
        $service = new Service();
        $service->service_name = $request->service_name;
        //string currency to number
        $price = (int)preg_replace("/([^0-9\\.])/i", "", $request->price);
        $service->service_price = $price;

        $service->service_type_id = $request->service_type;
        $service->save();
        return redirect()->route('service.show', $service);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
        return view('service.show')->with([
            'service' => $service,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
        $serviceTypes = ServiceType::all();
        return view('service.edit')->with([
            'service' => $service,
            'serviceTypes' => $serviceTypes,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->service_name = $request->service_name;
        //string currency to number
        $price = (int)preg_replace("/([^0-9\\.])/i", "", $request->price);
        $service->service_price = $price;

        $service->service_type_id = $request->service_type;
        $service->save();
        return redirect()->route('service.show', $service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('service.index')->with([
            'msg' => 'Xóa thành công'
        ]);
    }
}
