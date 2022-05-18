<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Floor;
use App\Models\Room;
use App\Models\RoomBill;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\ServiceBill;
use App\Models\ServiceType;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class BillController extends Controller
{
    public static function getBillTotal($billId){
        // phu thu
    }

    public function payBill($billId)
    {
        $bill = Bill::findBillById($billId);
        if($bill->is_paid == 1){
            return redirect()->route('bill.show',$billId);
        }
        // $checkinTime = strtotime(Constant::TIME_CHECKIN);
        // $checkoutTime = strtotime(Constant::TIME_CHECKOUT) + Constant::ROUNDING_TIME_ROOM_MINUTE * 60;

        $listRooms = RoomBill::findRoomByBillId($bill->bill_id);
        $roomsTotal = 0;
            foreach($listRooms as $room){
                $roomInfo = Room::findRoomInfoById($room->room_id);
                $roomTypeInfo = RoomType::findRoomTypeById($roomInfo->room_type_id);
                foreach($roomTypeInfo as $key=>$value){
                    $room->$key = $value;
                }
                foreach($roomInfo as $key=>$value){
                    $room->$key = $value;
                }

                //calculate room rent amount
                $dateCheckin = date('Y-m-d', strtotime($room->date_checkin));
                $dateCheckout = date('Y-m-d', strtotime($room->date_checkout));

                $timeCheckinRoom = strtotime($room->date_checkin);
                $timeCheckoutRoom = strtotime($room->date_checkout);

                $timeCheckinRegulation = strtotime($dateCheckin.Constant::TIME_CHECKIN);

                $timeCheckoutRegulation = strtotime($dateCheckout.Constant::TIME_CHECKOUT);
                $dateDiffRoom = ceil(($timeCheckoutRegulation - $timeCheckinRegulation)/(3600 * 24));

                //surcharge checkin early
                if($timeCheckinRoom < $timeCheckinRegulation){
                    $countHourDiff = ($timeCheckinRegulation - $timeCheckinRoom)/3600;
                    if($countHourDiff <= Constant::TIME_EARLY_CHECKIN_1_HOURS){
                        $surchargeCheckin = Constant::TIME_CHECKIN_1_RATIO;
                    }else if($countHourDiff > Constant::TIME_EARLY_CHECKIN_1_HOURS && $countHourDiff <= Constant::TIME_EARLY_CHECKIN_2_HOURS){
                        $surchargeCheckin = Constant::TIME_CHECKIN_2_RATIO;
                    }else if($countHourDiff > Constant::TIME_EARLY_CHECKIN_2_HOURS && $countHourDiff <= Constant::TIME_EARLY_CHECKIN_3_HOURS){
                        $surchargeCheckin = Constant::TIME_CHECKIN_2_RATIO;
                    }else{
                        $surchargeCheckin = 1;
                    }
                }else{
                    $surchargeCheckin = 0;
                }

                //surcharge checkout late
                if($timeCheckoutRoom > $timeCheckoutRegulation){
                    $countHourDiff = ($timeCheckoutRoom - $timeCheckoutRegulation)/3600;
                    if($countHourDiff <= Constant::TIME_LATE_CHECKOUT_1_HOURS){
                        $surchargeCheckout = Constant::TIME_CHECKOUT_1_RATIO;
                    }else if($countHourDiff > Constant::TIME_LATE_CHECKOUT_1_HOURS && $countHourDiff <= Constant::TIME_LATE_CHECKOUT_2_HOURS){
                        $surchargeCheckout = Constant::TIME_CHECKOUT_2_RATIO;
                    }else{
                        $surchargeCheckout = 1;
                    }
                }else{
                    $surchargeCheckout = 0;
                }

                $room->roomRentAmount = $dateDiffRoom * $room->price;
                $room->surchargeCheckinAmount = $surchargeCheckin * $room->price;
                $room->surchargeCheckoutAmount = $surchargeCheckout * $room->price;
                $room->total = ($dateDiffRoom + $surchargeCheckin + $surchargeCheckout) * $room->price;

                $roomsTotal += ($dateDiffRoom + $surchargeCheckin + $surchargeCheckout) * $room->price;
            }
            $listServices = ServiceBill::findServicesByBillId($bill->bill_id);
            foreach($listServices as $service){
                $serviceInfo = Service::findServiceById($service->service_id);
                foreach($serviceInfo as $key=>$value){
                    $service->$key = $value;
                }
                $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
                $service->room_name = Room::findRoomInfoById($service->room_id)->room_name;
            }
            $bill->cus_info = Customer::findCustomerById($bill->cus_id);
            $bill->rooms = $listRooms;
            $bill->services = $listServices;
            $bill->roomsTotal = $roomsTotal;
            // return $bill;
            return view('bill.pay-bill')->with([
                'bill'=>$bill
            ]);
    }


    public function paymentSuccess(Request $request,$billId){
        $isDirtyStatus = Constant::DIRTY_ROOM_STATUS;

        if($request){
            Bill::updateBillById($billId,['is_paid'=>1,'date_payment'=>Carbon::now()]);
        }
        $listRooms = RoomBill::findRoomByBillId($billId);
        foreach($listRooms as $room){
            Room::changeRoomStatus($room->room_id, $isDirtyStatus);
        }
        return redirect()->route('bill.show',$billId);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select option type, user, cus?
        $bills = Bill::getAllBillIsPaid();
        foreach($bills as $bill){
            $listRooms = RoomBill::findRoomByBillId($bill->bill_id);
            foreach($listRooms as $room){
                $roomInfo = Room::findRoomInfoById($room->room_id);
                $roomTypeInfo = RoomType::findRoomTypeById($roomInfo->room_type_id);
                foreach($roomTypeInfo as $key=>$value){
                    $room->$key = $value;
                }
                foreach($roomInfo as $key=>$value){
                    $room->$key = $value;
                }
            }
            $listServices = ServiceBill::findServicesByBillId($bill->bill_id);
            foreach($listServices as $service){
                $serviceInfo = Service::findServiceById($service->service_id);
                foreach($serviceInfo as $key=>$value){
                    $service->$key = $value;
                }
                $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
            }
            $bill->rooms = $listRooms;
            $bill->services = $listServices;
            $bill->cus_info = Customer::findCustomerById($bill->cus_id);
            $bill->user_info = User::findUserById($bill->user_id);
        }
        // return $bills;
        return view('bill.index')->with([
            'bills'=>$bills
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roomTypes = RoomType::getAllRoomType();

        // return $rooms;
        return view('bill.create')->with([
            'roomTypes'=>$roomTypes,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request)
    {
        $isRentedStatus = Constant::RENTED_ROOM_STATUS;
        // return $request;
        // fix pay-bill
        $rooms = $request->rooms;
        $checkinDateTimes = $request->datetime_checkin;
        $checkoutDateTimes = $request->datetime_checkout;

        $bill = new Bill();
        // $bill->bill_name = $request->name;
        // $bill->user_id = $request->user;
        $bill->user_id = auth()->user()->user_id;
        $bill->cus_id = $request->customer;
        $bill->note = $request->note;
        $bill->deposit = (int)preg_replace("/([^0-9\\.])/i", "", $request->deposit);
        $bill->save();


		$billId = $bill->bill_id;
        $bill->bill_name = Constant::PRE_STR_BILL_NAME . (string)$billId;
        $bill->save();

        for($i = 0; $i < count($rooms); $i++){
            $checkinDatetime = DateTime::createFromFormat('d/m/Y H:i', $checkinDateTimes[$i]);

            $checkoutDateTime = DateTime::createFromFormat('d/m/Y H:i', $checkoutDateTimes[$i]);

            if($checkinDatetime > $checkoutDateTime){
                return back()->with([
                    'error'=>'Ngày checkout phải lớn hơn ngày checkin'
                ]);
            }
        }

        for($i = 0; $i < count($rooms); $i++){
            Room::changeRoomStatus($rooms[$i], $isRentedStatus);

            $roomBill = new RoomBill();
            $roomBill->room_id = $rooms[$i];
            $roomBill->bill_id = $billId;

            $checkinDatetime = DateTime::createFromFormat('d/m/Y H:i', $checkinDateTimes[$i]);
            $roomBill->date_checkin = $checkinDatetime->format('Y-m-d H:i:s');

            $checkoutDateTime = DateTime::createFromFormat('d/m/Y H:i', $checkoutDateTimes[$i]);
            $roomBill->date_checkout = $checkoutDateTime->format('Y-m-d H:i:s');
            $roomBill->save();
        }


        return redirect()->route('bill.show', $billId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        if($bill->is_paid == 0){
            return redirect()->route('bill.pay-bill',$bill->bill_id);
        }
        $listRooms = RoomBill::findRoomByBillId($bill->bill_id);
        $roomsTotal = 0;
            foreach($listRooms as $room){
                $roomInfo = Room::findRoomInfoById($room->room_id);
                $roomTypeInfo = RoomType::findRoomTypeById($roomInfo->room_type_id);
                foreach($roomTypeInfo as $key=>$value){
                    $room->$key = $value;
                }
                foreach($roomInfo as $key=>$value){
                    $room->$key = $value;
                }

                //calculate room rent amount
                $dateCheckin = date('Y-m-d', strtotime($room->date_checkin));
                $dateCheckout = date('Y-m-d', strtotime($room->date_checkout));

                $timeCheckinRoom = strtotime($room->date_checkin);
                $timeCheckoutRoom = strtotime($room->date_checkout);

                $timeCheckinRegulation = strtotime($dateCheckin.Constant::TIME_CHECKIN);

                $timeCheckoutRegulation = strtotime($dateCheckout.Constant::TIME_CHECKOUT);
                $dateDiffRoom = ceil(($timeCheckoutRegulation - $timeCheckinRegulation)/(3600 * 24));

                //surcharge checkin early
                if($timeCheckinRoom < $timeCheckinRegulation){
                    $countHourDiff = ($timeCheckinRegulation - $timeCheckinRoom)/3600;
                    if($countHourDiff <= Constant::TIME_EARLY_CHECKIN_1_HOURS){
                        $surchargeCheckin = Constant::TIME_CHECKIN_1_RATIO;
                    }else if($countHourDiff > Constant::TIME_EARLY_CHECKIN_1_HOURS && $countHourDiff <= Constant::TIME_EARLY_CHECKIN_2_HOURS){
                        $surchargeCheckin = Constant::TIME_CHECKIN_2_RATIO;
                    }else if($countHourDiff > Constant::TIME_EARLY_CHECKIN_2_HOURS && $countHourDiff <= Constant::TIME_EARLY_CHECKIN_3_HOURS){
                        $surchargeCheckin = Constant::TIME_CHECKIN_2_RATIO;
                    }else{
                        $surchargeCheckin = 1;
                    }
                }else{
                    $surchargeCheckin = 0;
                }

                //surcharge checkout late
                if($timeCheckoutRoom > $timeCheckoutRegulation){
                    $countHourDiff = ($timeCheckoutRoom - $timeCheckoutRegulation)/3600;
                    if($countHourDiff <= Constant::TIME_LATE_CHECKOUT_1_HOURS){
                        $surchargeCheckout = Constant::TIME_CHECKOUT_1_RATIO;
                    }else if($countHourDiff > Constant::TIME_LATE_CHECKOUT_1_HOURS && $countHourDiff <= Constant::TIME_LATE_CHECKOUT_2_HOURS){
                        $surchargeCheckout = Constant::TIME_CHECKOUT_2_RATIO;
                    }else{
                        $surchargeCheckout = 1;
                    }
                }else{
                    $surchargeCheckout = 0;
                }

                $room->roomRentAmount = $dateDiffRoom * $room->price;
                $room->surchargeCheckinAmount = $surchargeCheckin * $room->price;
                $room->surchargeCheckoutAmount = $surchargeCheckout * $room->price;
                $room->total = ($dateDiffRoom + $surchargeCheckin + $surchargeCheckout) * $room->price;

                $roomsTotal += ($dateDiffRoom + $surchargeCheckin + $surchargeCheckout) * $room->price;
            }
            $listServices = ServiceBill::findServicesByBillId($bill->bill_id);
            $servicesTotal = 0;
            foreach($listServices as $service){
                $serviceInfo = Service::findServiceById($service->service_id);
                foreach($serviceInfo as $key=>$value){
                    $service->$key = $value;
                }
                $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
                $service->room_name = Room::findRoomInfoById($service->room_id)->room_name;
                $servicesTotal += $service->service_price * $service->quantity;
            }
            $bill->cus_info = Customer::findCustomerById($bill->cus_id);
            $bill->user_info = User::findUserById($bill->user_id);
            $bill->rooms = $listRooms;
            $bill->services = $listServices;
            $bill->roomsTotal = $roomsTotal;

            return view('bill.show')->with([
                'bill'=>$bill,
                'servicesTotal'=>$servicesTotal,
                'roomsTotal'=>$roomsTotal,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {

        $listRooms = RoomBill::findRoomByBillId($bill->bill_id);

        foreach($listRooms as $room){
            $roomInfo = Room::findRoomInfoById($room->room_id);
            $roomTypeInfo = RoomType::findRoomTypeById($roomInfo->room_type_id);
            foreach($roomTypeInfo as $key=>$value){
                $room->$key = $value;
            }
            foreach($roomInfo as $key=>$value){
                $room->$key = $value;
            }
            $room->floor_name = Floor::getFloorById($room->floor_id)->floor_name;

        }
        $bill->rooms = $listRooms;

        $listServices = ServiceBill::findServicesByBillId($bill->bill_id);
        foreach($listServices as $service){
            $serviceInfo = Service::findServiceById($service->service_id);
            foreach($serviceInfo as $key=>$value){
                $service->$key = $value;
            }
            $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
            $service->room_name = Room::findRoomInfoById($service->room_id)->room_name;
        }

        $bill->services = $listServices;

        $bill->cus_info = Customer::findCustomerById($bill->cus_id);
        $roomTypes = RoomType::getAllRoomType();
        $serviceTypes = ServiceType::all();
        $services = Service::getAllService();
        return view('bill.edit')->with([
            'bill'=>$bill,
            'roomTypes'=>$roomTypes,
            'serviceTypes'=>$serviceTypes,
            'services'=>$services,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BillRequest $request, Bill $bill)
    {
        // return $request;
        $isRentedStatus = Constant::RENTED_ROOM_STATUS;
        $isBookedStatus = Constant::BOOKED_ROOM_STATUS;
        $isEmptyStatus = Constant::EMPTY_ROOM_STATUS;
        $rooms = $request->rooms;
        if($request->services){
            $services = $request->services;
        }else{
            $services = [];
        }


        $quantities = $request->quantities;
        $serviceRooms = $request->service_room;
        $checkinDateTimes = $request->datetime_checkin;
        $checkoutDateTimes = $request->datetime_checkout;

        for($i = 0; $i < count($rooms); $i++){
            $checkinDatetime = DateTime::createFromFormat('d/m/Y H:i', $checkinDateTimes[$i]);

            $checkoutDateTime = DateTime::createFromFormat('d/m/Y H:i', $checkoutDateTimes[$i]);

            if($checkinDatetime > $checkoutDateTime){
                return back()->with([
                    'error'=>'Ngày checkout phải lớn hơn ngày checkin'
                ]);
            }
        }
        $billId = $bill->bill_id;
        // $bill->user_id = auth()->user()->user_id;
        $bill->cus_id = $request->customer;
        $bill->note = $request->note;
        $bill->is_paid = $request->is_paid;
        $bill->deposit = (int)preg_replace("/([^0-9\\.])/i", "", $request->deposit);

        $bill->save();

        $listRoomBills = RoomBill::findRoomByBillId($billId);
        foreach($listRoomBills as $room){
            if(count(Room::checkRoomIsBooked($room->room_id)) > 0){
                Room::changeRoomStatus($room->room_id, $isBookedStatus);
            }else{
                Room::changeRoomStatus($room->room_id, $isEmptyStatus);
            }
        }
        RoomBill::dropRoomBillById($billId);
        ServiceBill::dropServiceBillById($billId);


        for($i = 0; $i < count($rooms); $i++){
            Room::changeRoomStatus($rooms[$i], $isRentedStatus);

            $roomBill = new RoomBill();
            $roomBill->room_id = $rooms[$i];
            $roomBill->bill_id = $billId;

            $checkinDatetime = DateTime::createFromFormat('d/m/Y H:i', $checkinDateTimes[$i]);
            $roomBill->date_checkin = $checkinDatetime->format('Y-m-d H:i:s');

            $checkoutDateTime = DateTime::createFromFormat('d/m/Y H:i', $checkoutDateTimes[$i]);
            $roomBill->date_checkout = $checkoutDateTime->format('Y-m-d H:i:s');
            $roomBill->save();
        }

        $now = date('Y-m-d H:i', strtotime(Carbon::now()));
        if(count($services) > 0){
            for($i = 0; $i < count($services); $i++){
                $serviceBill = new ServiceBill();
                $serviceBill->bill_id = $billId;
                $serviceBill->service_id = $services[$i];
                $serviceBill->room_id = $serviceRooms[$i];
                $serviceBill->quantity = $quantities[$i];
                $serviceBill->date_use_service = $now;
                $serviceBill->save();
            }

        }
        return redirect()->route('bill.show', $bill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        RoomBill::dropRoomBillById($bill->bill_id);
        ServiceBill::dropServiceBillById($bill->bill_id);
        $bill->delete();
        return redirect()->route('bill.index')->with([
            'msg'=>"Xóa thành công"
        ]);
    }
}
