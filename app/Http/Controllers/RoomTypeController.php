<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('room-type.index')->with([
            'roomTypes'=>RoomType::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('room-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roomType = new RoomType();
        $roomType->type_name = $request->type_name;
        //string currency to number
        $price = (int)preg_replace("/([^0-9\\.])/i", "", $request->price);
        $roomType->price = $price;
        $roomType->guest_number = $request->guest_number;
        $roomType->room_des = $request->description;
        $roomType->save();
        return redirect()->route('room-type.show', $roomType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RoomType $roomType)
    {
        return view('room-type.show')->with([
            'roomType'=>$roomType
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        return view('room-type.edit')->with([
            'roomType'=>$roomType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomType $roomType)
    {
        $roomType->type_name = $request->name;
        $roomType->price = $request->price;
        $roomType->guest_number = $request->guest_number;
        $roomType->room_des = $request->description;
        $roomType->save();
        return redirect()->route('room-type.show', $roomType);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return view('room-type.index')->with([
            'msg'=>"Xóa thành công"
        ]);
    }
}
