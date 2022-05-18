<?php

namespace App\Http\Controllers;

use App\Models\ShiftType;
use Illuminate\Http\Request;

class ShiftTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shift-type.index')->with([
            'shiftTypes'=>ShiftType::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shift-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shiftType = new ShiftType();
        $shiftType->shift_type_name = $request->name;
        $shiftType->time_start = $request->time_start;
        $shiftType->time_finish = $request->time_finish;
        if($request->is_tomorrow){
            $shiftType->is_tomorrow = 1;
        }else{
            $shiftType->is_tomorrow = 0;
        }
        $shiftType->save();
        return redirect()->route('shift-type.show', $shiftType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShiftType $shiftType)
    {
        // return view('shift-type.show')->with([
        //     'shiftType'=>$shiftType
        // ]);
        return redirect()->route('shift-type.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShiftType $shiftType)
    {
        return view('shift-type.edit')->with([
            'shiftType'=>$shiftType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShiftType $shiftType)
    {
        $shiftType->shift_type_name = $request->name;
        $shiftType->time_start = $request->time_start;
        $shiftType->time_finish = $request->time_finish;
        if($request->is_tomorrow){
            $shiftType->is_tomorrow = 1;
        }else{
            $shiftType->is_tomorrow = 0;
        }
        $shiftType->save();
        return redirect()->route('shift-type.show', $shiftType);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShiftType $shiftType)
    {
        $shiftType->delete();
        return response()->json([
            'msg'=>'Success'
        ]);
    }
}
