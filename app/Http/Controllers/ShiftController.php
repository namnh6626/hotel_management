<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Models\Shift;
use App\Models\ShiftType;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function finishShift(){
        // $now = Carbon::now();
        // $time = strtotime('21:30:00');
        // return date('d/m/Y H:i:s',$time);

        // return date('d/m/Y',time());

        $shiftTypes = ShiftType::all();
        $nowTime = date('Y-m-d H:i:s',strtotime(Carbon::now()));
        $now = strtotime(Carbon::now()) - Constant::ROUNDING_SHIFT_MINUTE_TIME * 60;
        // return strtotime(Carbon::now());
        $arr = [];
        foreach($shiftTypes as $shiftType){
            if($shiftType->is_tomorrow){
                $startTime = strtotime($shiftType->time_start) - 3600 * 24;
                $finishTime = strtotime($shiftType->time_finish);
            }else{
                $startTime = strtotime($shiftType->time_start);
                $finishTime = strtotime($shiftType->time_finish);
            }

            array_push($arr, [date('Y-m-d H:i:s',$now), date('Y-m-d H:i:s',$startTime), date('Y-m-d H:i:s',$finishTime)]);
            if($now <= $finishTime && $now > $startTime){
                $shift = new Shift();
                $shift->date_start = date('Y-m-d H:i:s',$startTime);
                $shift->date_finish = date('Y-m-d H:i:s',$finishTime);
                $shift->shift_type_id = $shiftType->shift_type_id;
                $shift->user_id = auth()->id();
                $shift->save();
                return redirect()->route('logout');
            }
        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::all();
        foreach($shifts as $shift){
            // return ShiftType::findShiftTypeById($shift->shift_type_id);
            $shift->shift_type_name = ShiftType::findShiftTypeById($shift->shift_type_id)->shift_type_name;
            $shift->user_info = User::findUserById($shift->user_id);
        }
        return view('shift.index')->with([
            'shifts'=>$shifts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shiftTypes = ShiftType::all();
        return view('shift.create')->with([
            'shiftTypes'=>$shiftTypes
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
        $shift = new Shift();
        $shift->date_start = $request->date_start;
        $shift->date_finish = $request->date_finish;
        $shift->shift_type_id = $request->type;
        $shift->user_id = $request->user;
        $shift->save();
        return redirect()->route('shift.show', $shift);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        return view('shift.show')->with([
            'shift'=>$shift
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        $shiftTypes = ShiftType::all();
        return view('shift.edit')->with([
            'shift'=>$shift,
            'shiftTypes'=>$shiftTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        $shift->date_start = $request->date_start;
        $shift->date_finish = $request->date_finish;
        $shift->shift_type_id = $request->type;
        $shift->user_id = $request->user;
        $shift->save();
        return redirect()->route('shift.show', $shift);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return redirect()->route('shift.index')->with([
            'msg'=>'Xóa thành công'
        ]);
    }
}
