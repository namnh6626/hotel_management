<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Http\Controllers\Controller;
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
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function updateStatus($roomId){
        Room::changeRoomStatus($roomId, Constant::EMPTY_ROOM_STATUS);
        return redirect()->route('room.diagram');
    }

    public function roomRentedAddService($roomId){
        $services = Service::getAllService();
        // foreach ($services as $service) {
        //     // return $service;
        //     $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
        // }
        $isRentedStatus = Constant::RENTED_ROOM_STATUS;
        $roomStatus = Room::findRoomInfoById($roomId)->status_id;
        if($roomStatus != $isRentedStatus){
            return redirect()->route('room.diagram');
        }
        $room = Room::findRoomInfoById($roomId);
        $room->services = Room::getListServiceRoomRented($roomId);
        // $bill = Room::getRoomInfoIsRented($roomId);
        // $bill = Bill::findBillById($roomId);
        foreach($room->services as $service){
            // return $service;
        }
        $room->billInfo = Room::getBillInfoRoomRented($roomId);
        // return $room;
        return view('room.add-service')->with([
            'services'=>$services,
            'room'=>$room,
            'serviceTypes'=>ServiceType::all()
        ]);
    }

    public function storeRoomService(Request $request)
    {
        $roomId = $request->room;
        $billId = $request->bill;
        $services = $request->services;
        $quantities = $request->quantities;
        for($i=0; $i < count($services); $i++){
            // return ServiceBill::findServiceIsUsedByRoomIdAndBillId($services[$i], $billId, $roomId);
            $serviceIsExist = count(ServiceBill::findServiceIsUsedByRoomIdAndBillId($services[$i], $billId, $roomId));
            if($serviceIsExist > 0){
                ServiceBill::increaseServiceQuantity($services[$i], $roomId, $billId, $quantities[$i]);
            }else{
                $serviceBill = new ServiceBill();
                $serviceBill->room_id = $roomId;
                $serviceBill->service_id = $services[$i];
                $serviceBill->bill_id = $billId;
                $serviceBill->quantity = $quantities[$i];
                $serviceBill->date_use_service = date('Y-m-d H:i', strtotime(Carbon::now()));
                $serviceBill->save();
            }
        }
        return redirect()->route('room.diagram');
    }


    public function checkinRoom()
    {
        $users = User::getAllUser();
        $isEmptyStatus = 1;
        $isRentedStatus = 2;
        $isBookedStatus = 3;
        $isDirtyStatus = 4;
        $isRepairStatus = 5;
        // $isCustomerGetOut = 6;

        //get all rooms
        $rooms = Room::all()->sortBy('room_name');
        foreach ($rooms as $room) {
            //get info room is rented
            if ($room->status_id == $isRentedStatus) {
                //get list service
                $roomServices = Room::getRoomInfoIsRented($room->room_id);
                $services = [];

                foreach ($roomServices as $service) {
                    $room->cus_info = Customer::findCustomerById($service->cus_id);
                    unset($service->cus_id);
                    unset($service->room_id);
                    $service->service_name = Service::findServiceById($service->service_id)->service_name;
                    $service->service_price = Service::findServiceById($service->service_id)->service_price;
                }
                $room->services = $roomServices;

                $listBillUnPaid = Bill::getAllUnpaidBill();
                foreach ($listBillUnPaid as $bill) {
                    if (RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)) {
                        $room->date_checkin = RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)->date_checkin;
                        $room->date_checkout = RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)->date_checkout;
                        $room->bill_info = $bill;
                    }
                }
            }
            //get booking room info
            if (Booking::findRoomIsReservedById($room->room_id)) {
                $bookingRoomInfo = Booking::findRoomIsReservedById($room->room_id);
                // $room->cus_id = $bookingRoomInfo->cus_id;
                // $room->checkin = $bookingRoomInfo->checkin;
                // $room->checkout = $bookingRoomInfo->checkout;
                // $room->cus_info = Customer::findCustomerById($room->cus_id);
                $room->bookings = $bookingRoomInfo;
            }

            $room->room_type_info = RoomType::findRoomTypeById($room->room_type_id);
            $room->status_name = Status::findStatusById($room->status_id)->status_name;
        }

        $roomTypes = RoomType::getAllRoomType();
        $services = Service::all();
        foreach ($services as $service) {
            $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
        }
        $serviceTypes = ServiceType::all();
        // return $rooms;
        return view('room.checkin')->with([
            'roomTypes' => $roomTypes,
            'rooms' => $rooms,
            'users' => $users,
            'services' => $services,
            'serviceTypes' => $serviceTypes,
            'isEmptyStatus' => $isEmptyStatus,
            'isRentedStatus' => $isRentedStatus,
            'isDirtyStatus' => $isDirtyStatus,
            'isBookedStatus' => $isBookedStatus,
            'isRepairStatus' => $isRepairStatus

        ]);
    }



    //get rooms valid to booking or checkin
    public function filterSelect(Request $request)
    {
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $type = $request->type;
        // return $request;
        $listAllRoomIdCollection = Room::getAllRoomId($type);
        $listAllRoomId = [];
        foreach($listAllRoomIdCollection as $room){
            // return $room;
            array_push($listAllRoomId, $room->room_id);
        }

        if ($request->ajax()) {
            $roomsBooked     = Room::findRoomIsBookedToBookOrCheckin($checkin, $checkout, $type);
            $roomsRented     = Room::findRoomIsRentedToBook($checkin, $checkout, $type);
            $roomsEmptyAndDirty = Room::getRoomEmpty($type);
            // return $roomsRented;

            $listRoom = [];
            if (count($roomsBooked) > 0) {
                foreach ($roomsBooked as $room) {
                    array_push($listRoom, $room->room_id);
                }
            }

            if (count($roomsRented) > 0) {
                foreach ($roomsRented as $room) {
                    array_push($listRoom, $room->room_id);
                }
            }


            $rooms = array_diff($listAllRoomId, $listRoom);
            // return $rooms;
            // foreach($listRoom as $roomNotAvail){
            //     foreach($listAllRoomId as $room){
            //         if($room->room_id == $roomNotAvail->room_id){
            //             break;
            //         }else{
            //             array_push($rooms, $room->room_id);

            //         }
            //     }
            // }


            if (count($rooms) > 0) {
                // $collection = collect($listRoom);
                // $newListRoom = $collection->unique();
                // $rooms = $newListRoom->values()->all(); // object $key->$value to array $value


                // return $results;
                $results = [];
                foreach($rooms as $room){
                    $roomInfo = Room::findRoomInfoById($room);
                    array_push($results, $roomInfo);
                }
                return response()->json($results);
            }
            return response()->json(false);
        }
    }



    public function getRoomsBeingRented()
    {
        $isRentedStatus = 2;
        $rentedRooms = Room::getListRoomIdByStatusId($isRentedStatus, ['*']);
        foreach ($rentedRooms as $room) {
            //get list service
            $roomServices = Room::getRoomInfoIsRented($room->room_id);
            $services = [];

            foreach ($roomServices as $service) {
                $room->cus_info = Customer::findCustomerById($service->cus_id);
                unset($service->cus_id);
                unset($service->room_id);
                $service->service_name = Service::findServiceById($service->service_id)->service_name;
                $service->service_price = Service::findServiceById($service->service_id)->service_price;
            }
            $room->services = $roomServices;

            $listBillUnPaid = Bill::getAllUnpaidBill();
            foreach ($listBillUnPaid as $bill) {
                if (RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)) {
                    $room->cus_info = Customer::findCustomerById($bill->cus_id);
                    $room->date_checkin = RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)->date_checkin;
                    $room->date_checkout = RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)->date_checkout;
                    $room->bill_info = $bill;
                    $room->listSameRoom = Room::getRoomSameCustomerAndBill($room->bill_info->bill_id, ['rooms.room_id', 'customers.cus_id', 'bills.bill_id', 'rooms.room_name', 'room_bills.date_checkin', 'room_bills.date_checkout']);
                }
            }
            $room->room_type_info = RoomType::findRoomTypeById($room->room_type_id);
            $room->status_name = Status::findStatusById($room->status_id)->status_name;
            $room->floor_name = Floor::getFloorById($room->floor_id);
        }
        // return $rentedRooms;
        return view('room.room-rented')->with([
            'rentedRooms' => $rentedRooms,
        ]);
    }

    public function diagram()
    {
        $isEmptyStatus = Constant::EMPTY_ROOM_STATUS;
        $isRentedStatus = Constant::RENTED_ROOM_STATUS;
        $isBookedStatus = Constant::BOOKED_ROOM_STATUS;
        $isDirtyStatus = Constant::DIRTY_ROOM_STATUS;
        $isRepairStatus = Constant::REPAIRED_ROOM_STATUS;
        // $isCustomerGetOut = 6;

        //get all rooms
        $rooms = Room::all()->sortBy('room_name');
        foreach ($rooms as $room) {
            //get info room is rented
            if ($room->status_id == $isRentedStatus) {
                //get list service
                $roomServices = Room::getRoomInfoIsRented($room->room_id);
                $services = [];

                foreach ($roomServices as $service) {
                    unset($service->cus_id);
                    unset($service->room_id);
                    $service->service_name = Service::findServiceById($service->service_id)->service_name;
                    $service->service_price = Service::findServiceById($service->service_id)->service_price;
                }
                $room->services = $roomServices;

                $listBillUnPaid = Bill::getAllUnpaidBill();
                foreach ($listBillUnPaid as $bill) {

                    if (RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)) {
                        $room->cus_info = Customer::findCustomerById($bill->cus_id);
                        $room->date_checkin = RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)->date_checkin;
                        $room->date_checkout = RoomBill::findRoomBillByRoomIdAndBillId($room->room_id, $bill->bill_id)->date_checkout;
                        $room->bill_info = $bill;
                        $room->listSameRoom = Room::getRoomSameCustomerAndBill($room->bill_info->bill_id, ['rooms.room_id', 'customers.cus_id', 'bills.bill_id', 'rooms.room_name', 'room_bills.date_checkin', 'room_bills.date_checkout']);
                    }
                }
            }
            //get booking room info
            if (Booking::findRoomIsReservedById($room->room_id)) {
                $bookingRoomInfo = Booking::findRoomIsReservedById($room->room_id);
                // $room->cus_id = $bookingRoomInfo->cus_id;
                // $room->checkin = $bookingRoomInfo->checkin;
                // $room->checkout = $bookingRoomInfo->checkout;
                // $room->cus_info = Customer::findCustomerById($room->cus_id);
                $room->bookings = $bookingRoomInfo;
            }

            $room->room_type_info = RoomType::findRoomTypeById($room->room_type_id);
            $room->status_name = Status::findStatusById($room->status_id)->status_name;
            $room->floor_name = Floor::getFloorById($room->floor_id)->floor_name;
        }



        $services = Service::all();
        foreach ($services as $service) {
            $service->service_type_name = ServiceType::findServiceTypeById($service->service_type_id)->service_type_name;
        }
        $serviceTypes = ServiceType::all();
        // return $rooms;
        return view('room.diagram')->with([
            'rooms' => $rooms,
            'services' => $services,
            'serviceTypes' => $serviceTypes,
            'isEmptyStatus' => $isEmptyStatus,
            'isRentedStatus' => $isRentedStatus,
            'isDirtyStatus' => $isDirtyStatus,
            'isBookedStatus' => $isBookedStatus,
            'isRepairStatus' => $isRepairStatus

        ]);
    }



    public function index()
    {
        $rooms = Room::getAllRoom();
        // return $rooms;
        return view('room.index')->with([
            'rooms'=>$rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $floors = Floor::all();
        $statuses = Status::all();
        $roomTypes = RoomType::all();
        return view('room.create')->with([
            'statuses' => $statuses,
            'roomTypes' => $roomTypes,
            'floors' => $floors
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
        $room = new Room();
        $room->room_name = $request->name;
        $room->room_type_id = $request->type;
        $room->status_id = $request->status;
        // $room->date_checkin = $request->checkin;
        // $room->date_checkout = $request->checkout;
        $room->floor_id = $request->floor;
        $room->save();
        return redirect()->route('room.show', $room);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $room->room_type_info = RoomType::findRoomTypeById($room->room_type_id);
        $room->status_name = Status::findStatusById($room->status_id)->status_name;
        $room->floor_name = Floor::getFloorById($room->floor_id)->floor_name;
        // return $room;
        return view('room.show')->with([
            'room' => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $room->room_type_info = RoomType::findRoomTypeById($room->room_type_id);
        $room->status_name = Status::findStatusById($room->status_id)->status_name;
        $room->floor_name = Floor::getFloorById($room->floor_id)->floor_name;
        $statuses = Status::all();
        $roomTypes = RoomType::all();
        $floors = Floor::all();
        // return $room;
        return view('room.edit')->with([
            'room' => $room,
            'statuses' => $statuses,
            'roomTypes' => $roomTypes,
            'floors' => $floors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $room->room_name = $request->name;
        $room->room_type_id = $request->type;
        $room->status_id = $request->status;
        $room->floor_id = $request->floor;
        // $room->date_checkin = $request->checkin;
        // $room->date_checkout = $request->checkout;
        $room->save();
        return redirect()->route('room.show', $room);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('room.index')->with([
            'msg' => 'Success'
        ]);
    }

    public function transferRoom(Request $request)
    {
    }
}
