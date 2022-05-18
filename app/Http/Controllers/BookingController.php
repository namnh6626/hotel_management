<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomBill;
use App\Models\RoomBooking;
use App\Models\RoomType;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;


class BookingController extends Controller
{
    public function bookingToCheckin($bookingId){
        $isRentedStatus = Constant::RENTED_ROOM_STATUS;
        $listRooms = RoomBooking::findRoomsByBookingId($bookingId);
        foreach($listRooms as $room){
            Room::changeRoomStatus($room->room_id, $isRentedStatus);
        }
        Booking::bookingCheckin($bookingId);
        $isRentedStatus = Constant::RENTED_ROOM_STATUS;

        $rooms = $listRooms;
        $booking = Booking::findBookingById($bookingId);
        // return $booking;
        $bill = new Bill();
        $bill->cus_id = $booking->cus_id;
        $bill->user_id = auth()->user()->user_id;
        $bill->note = $booking->note;
        $bill->deposit = $booking->deposit;
        $bill->save();

        // return $bill;
		$billId = $bill->bill_id;
        $bill->bill_name = Constant::PRE_STR_BILL_NAME . (string)$billId;
        $bill->save();


        for($i = 0; $i < count($rooms); $i++){
            Room::changeRoomStatus($rooms[$i]->room_id, $isRentedStatus);

            $roomBill = new RoomBill();
            // return $room[$i];
            $roomBill->room_id = $rooms[$i]->room_id;
            $roomBill->bill_id = $billId;

            $roomBill->date_checkin =$rooms[$i]->checkin;

            $roomBill->date_checkout =  $rooms[$i]->checkout;
            $roomBill->save();
        }


        return redirect()->route('bill.show', $billId);

    }

    public function filterBooking(Request $request){
        $dateStart = $request->start;
        $dateFinish = $request->finish;
        // return $dateStart;
        // filter booking from x to y


        $data = Booking::filterBooking($dateStart, $dateFinish);
        if(count($data) > 0){
            foreach($data as $booking){
                unset($booking->password);
            }
        }
        return response()->json($data);
    }

    public function listBookingCheckinTomorrow(){
        $tomorrow = date('Y-m-d', strtotime(Carbon::tomorrow()));
        // return Booking::checkinTomorrow($tomorrow);
        return view('booking.tomorrow-checkin')->with([
            'bookings'=>Booking::checkinOnDate($tomorrow)
        ]);
    }

    public function listBookingCheckinToday(){
        $today = date('Y-m-d', strtotime(Carbon::now()));
        // return Booking::checkinTomorrow($tomorrow);
        return view('booking.today-checkin')->with([
            'bookings'=>Booking::checkinOnDate($today)
        ]);
    }

    public function cancelBooking($bookingId){
        Booking::cancelBooking($bookingId);
        return redirect()->route('booking.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookingOverDate = date('Y-m-d',strtotime(Carbon::now()->subDays(2)));
        Booking::cancelBookingOverDate($bookingOverDate);

        $bookings = Booking::getAllBookingNotCheckin();
        if(count($bookings) > 0){
            foreach($bookings as $booking) {
                $booking->rooms = RoomBooking::findRoomsByBookingId($booking->booking_id);
                unset($booking->password);
                $booking->user_info = User::findUserById($booking->user_id);
            }

        }
        // return $bookings;
        return view('booking.index')->with([
            'bookings'=>$bookings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roomTypes = RoomType::all();
        // return $rooms;
        return view('booking.create')->with([
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
        // return $request;
        $isBookedStatus = Constant::BOOKED_ROOM_STATUS;
        $isRentedStatus = Constant::RENTED_ROOM_STATUS;


        $rooms = $request->rooms;

        $checkinDates = $request->datetime_checkin;
        $checkoutDates = $request->datetime_checkout;

        for($i = 0; $i < count($rooms); $i++){
            $checkinDatetime = DateTime::createFromFormat('d/m/Y H:i', $checkinDates[$i]);

            $checkoutDateTime = DateTime::createFromFormat('d/m/Y H:i', $checkoutDates[$i]);

            if($checkinDatetime > $checkoutDateTime){
                return back()->with([
                    'error'=>'Ngày checkout phải lớn hơn ngày checkin'
                ]);
            }
        }
        $customer = $request->cus_id;

        $booking = new Booking();
        $booking->cus_id = $request->customer;
        $booking->is_checkin = 0;
        $booking->note = $request->note;
        $booking->deposit = (int)preg_replace("/([^0-9\\.])/i", "", $request->deposit);
        $booking->user_id = auth()->user()->user_id;
        $booking->date_booking = Carbon::now();
        $booking->save();
        $bookingId = $booking->booking_id;

        $i = 0;
        foreach ($rooms as $roomId) {
            if(Room::findRoomStatusId($roomId)->status_id != $isRentedStatus){
                Room::changeRoomStatus($roomId, $isBookedStatus);
            }

            $roomBooking = new RoomBooking();
            $checkin = DateTime::createFromFormat('d/m/Y H:i', $checkinDates[$i]);
            $roomBooking->checkin = $checkin->format('Y-m-d H:i:s');

            $checkout = DateTime::createFromFormat('d/m/Y H:i',$checkoutDates[$i]);
            $roomBooking->checkout = $checkout->format('Y-m-d H:i:s');

            $roomBooking->booking_id = $bookingId;
            $roomBooking->room_id = $roomId;
            Room::changeRoomStatus($roomId, $isBookedStatus);

            $roomBooking->save();


            $i++;

        }
        return redirect()->route('booking.show', $bookingId);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        if($booking->is_checkin == 1){
            return redirect()->route('booking.index');
        }
        $booking->cus_info = Customer::findCustomerById($booking->cus_id);
        $booking->user_info = User::findUserById($booking->user_id);
        $booking->rooms = RoomBooking::findRoomsByBookingId($booking->booking_id);
        // return $booking;
        return view('booking.show')->with([
            'booking'=>$booking
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        if($booking->is_checkin == 1){
            return redirect()->route('booking.index');
        }
        $booking->cus_info = Customer::findCustomerById($booking->cus_id);
        $booking->user_info = User::findUserById($booking->user_id);
        $booking->rooms = RoomBooking::findRoomsByBookingId($booking->booking_id);
        $customers = Customer::getAllCustomer();
        $rooms = Room::getAllRoom();
        $users = User::getAllUser();
        $roomTypes = RoomType::getAllRoomType();
        // return $booking;
        return view('booking.edit')->with([
            'booking'=> $booking,
            'customers'=> $customers,
            'rooms' => $rooms,
            'users' => $users,
            'roomTypes' => $roomTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BillRequest $request, Booking $booking)
    {
        $isBookedStatus = Constant::BOOKED_ROOM_STATUS;
        $isRentedStatus = Constant::RENTED_ROOM_STATUS;
        $isEmptyStatus = Constant::EMPTY_ROOM_STATUS;

        // return $request;
        $booking->user_id = auth()->user()->user_id;
        $booking->cus_id = $request->cus_id;
        $booking->note = $request->note;
        $booking->deposit = $request->deposit;

        $checkinDates = $request->datetime_checkin;
        $checkoutDates = $request->datetime_checkout;

        $rooms = $request->rooms;

        for($i = 0; $i < count($rooms); $i++){
            $checkinDatetime = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $checkinDates[$i])));
            // return $checkinDatetime;
            $checkoutDateTime = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $checkoutDates[$i])));

            if($checkinDatetime > $checkoutDateTime){
                return back()->with([
                    'error'=>'Ngày checkout phải lớn hơn ngày checkin'
                ]);
            }
        }

        $listRoomBookings = RoomBooking::findRoomsByBookingId($booking->booking_id);
        foreach($listRoomBookings as $room){

            if(Room::findRoomStatusId($room->room_id)->status_id == $isRentedStatus){
                continue;
            }else{
                if(count(Room::checkRoomIsBooked($room->room_id)) > 0){
                    Room::changeRoomStatus($room->room_id, $isBookedStatus);
                }else{
                    Room::changeRoomStatus($room->room_id, $isEmptyStatus);
                }

            }
        }
        RoomBooking::deleteRoomBooking($booking->booking_id);
        $bookingId = $booking->booking_id;

        for($i = 0; $i < count($checkinDates); $i++){
            if(Room::findRoomStatusId($rooms[$i])->status_id == $isEmptyStatus){
                Room::changeRoomStatus($rooms[$i], $isBookedStatus);
            }

            $roomBooking = new RoomBooking();

            $checkin = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $checkinDates[$i])));
            // return $checkin;
            $roomBooking->checkin = $checkin;
            $checkout = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $checkoutDates[$i])));
            $roomBooking->checkout = $checkout;

            $roomBooking->room_id = $rooms[$i];
            $roomBooking->booking_id = $bookingId;

            $roomBooking->save();
        }
        return redirect()->route('booking.show', $booking);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        RoomBooking::deleteRoomBooking($booking->booking_id);
        $booking->delete();
        return redirect()->route('booking.index');
    }
}
