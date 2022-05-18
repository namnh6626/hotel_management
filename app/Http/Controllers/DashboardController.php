<?php

namespace App\Http\Controllers;

use App\Constant;
use App\Models\Bill;
use App\Models\BudgetInvoice;
use App\Models\Product;
use App\Models\ProductWarehouseReceipt;
use App\Models\Room;
use App\Models\RoomBill;
use App\Models\RoomType;
use App\Models\ServiceBill;
use App\Models\WarehouseReceipt;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.room-performance');
    }

    public function export()
    {
        $products = Product::all();
        return view('dashboard.export')->with([
            'products'=>$products
        ]);
    }

      // chia dashboard
    //hs phong
    //hs phong + lượt dung dv
    //hs phong + sl xuất kho
    public function roomPerformance(Request $request)
    {
        if (!$request->type) {
            $type = 30;
        } else {
            $type = $request->type;
        }

        // if($type == 7){
        //     $stepDate = 1;
        // }elseif($type == 14){
        //     $stepDate = 2;
        // }elseif($type == 30){
        //     $stepDate = 3;
        // }



        $oneDateTime = 3600 * 24;
        $roomCount = Room::getCountRoom();

        $currentTimeStr = Carbon::now()->toDateString();
        $currentTime = strtotime($currentTimeStr);
        // SELECT DISTINCT* FROM `room_bills` WHERE date_checkin <= '2022-01-06' AND date_checkout >= '2022-01-06'
        $listPerformance = [];
        // $listTime = [];
        $listStartTime = [];
        $startTime = $currentTime - ($type * 3600 * 24);

        $listCountRoomRented = [];

        $listCountServiceUse = [];

        $listRevenue = [];

        $listProductExport = [];
        $arr = [];

        // array_push($listStartTime, date('d-m-Y', $startTime));
        for ($i = 0; $i <= $type; $i++) {
            $newStartTime = $startTime;
            $countService = 0;

            $time = date('Y-m-d', $newStartTime);
            // room count and room performance
            $roomCountRented = RoomBill::getCountRoomIsRentedBetweenDate($time);

            $performance = $roomCountRented / $roomCount;


            // array_push($listTime, date('d-m-Y', $newStartTime));
            // list service
            $listServiceUse = ServiceBill::getListUseService($time);
            // return $listServiceUse;

            // get count service
            foreach ($listServiceUse as $serviceBill) {
                $countService += $serviceBill->quantity;
            }
            // time + 1 day
            $newStartTime += $oneDateTime;

            array_push($listPerformance, $performance);

            array_push($listCountServiceUse, $countService);

            array_push($listCountRoomRented, $roomCountRented);

            array_push($listStartTime, date('d-m-Y', $startTime));

            $dateRevenueTotal = 0;
            $bills = Bill::filterBill($time);
            foreach ($bills as $bill) {
                $listRoom = RoomBill::findRoomByBillId($bill->bill_id);
                $billRoomTotal = 0;
                foreach ($listRoom as $room) {
                    $roomInfo = Room::findRoomInfoById($room->room_id);
                    $roomTypeInfo = RoomType::findRoomTypeById($roomInfo->room_type_id);
                    foreach ($roomTypeInfo as $key => $value) {
                        $room->$key = $value;
                    }
                    foreach ($roomInfo as $key => $value) {
                        $room->$key = $value;
                    }

                    //calculate room rent amount
                    $dateCheckin = date('Y-m-d', strtotime($room->date_checkin));
                    $dateCheckout = date('Y-m-d', strtotime($room->date_checkout));

                    $timeCheckinRoom = strtotime($room->date_checkin);
                    $timeCheckoutRoom = strtotime($room->date_checkout);

                    $timeCheckinRegulation = strtotime($dateCheckin . Constant::TIME_CHECKIN);

                    $timeCheckoutRegulation = strtotime($dateCheckout . Constant::TIME_CHECKOUT);
                    $dateDiffRoom = ceil(($timeCheckoutRegulation - $timeCheckinRegulation) / (3600 * 24));

                    //surcharge checkin early
                    if ($timeCheckinRoom < $timeCheckinRegulation) {
                        $countHourDiff = ($timeCheckinRegulation - $timeCheckinRoom) / 3600;
                        if ($countHourDiff <= Constant::TIME_EARLY_CHECKIN_1_HOURS) {
                            $surchargeCheckin = Constant::TIME_CHECKIN_1_RATIO;
                        } else if ($countHourDiff > Constant::TIME_EARLY_CHECKIN_1_HOURS && $countHourDiff <= Constant::TIME_EARLY_CHECKIN_2_HOURS) {
                            $surchargeCheckin = Constant::TIME_CHECKIN_2_RATIO;
                        } else if ($countHourDiff > Constant::TIME_EARLY_CHECKIN_2_HOURS && $countHourDiff <= Constant::TIME_EARLY_CHECKIN_3_HOURS) {
                            $surchargeCheckin = Constant::TIME_CHECKIN_2_RATIO;
                        } else {
                            $surchargeCheckin = 1;
                        }
                    } else {
                        $surchargeCheckin = 0;
                    }

                    //surcharge checkout late
                    if ($timeCheckoutRoom > $timeCheckoutRegulation) {
                        $countHourDiff = ($timeCheckoutRoom - $timeCheckoutRegulation) / 3600;
                        if ($countHourDiff <= Constant::TIME_LATE_CHECKOUT_1_HOURS) {
                            $surchargeCheckout = Constant::TIME_CHECKOUT_1_RATIO;
                        } else if ($countHourDiff > Constant::TIME_LATE_CHECKOUT_1_HOURS && $countHourDiff <= Constant::TIME_LATE_CHECKOUT_2_HOURS) {
                            $surchargeCheckout = Constant::TIME_CHECKOUT_2_RATIO;
                        } else {
                            $surchargeCheckout = 1;
                        }
                    } else {
                        $surchargeCheckout = 0;
                    }

                    // $room->roomRentAmount = $dateDiffRoom * $room->price;
                    // $room->surchargeCheckinAmount = $surchargeCheckin * $room->price;
                    // $room->surchargeCheckoutAmount = $surchargeCheckout * $room->price;
                    $total = ($dateDiffRoom + $surchargeCheckin + $surchargeCheckout) * $room->price;
                    $billRoomTotal += $total;
                }
                $dateRevenueTotal += $billRoomTotal;
            }

            if($request->product){
                // get product export
                $productBills = ProductWarehouseReceipt::filterProductBill($time, $request->product);
                $countProductExport = 0;
                if(count($productBills) > 0){
                    foreach($productBills as $product){
                        $countProductExport += $product->quantity;
                    }
                }
                array_push($listProductExport, $countProductExport);

                // array_push($arr, $productBills);

            }
            // else{
            //     $countProductExport = 0;
            //     $productBills = ProductWarehouseReceipt::filterProductBill($time, 2);
            //     if(count($productBills) > 0){
            //         foreach($productBills as $product){
            //             $countProductExport += $product->quantity;
            //         }
            //     }
            //     array_push($listProductExport, $countProductExport);


            //     array_push($arr, $productBills);

            // }

            $startTime += $oneDateTime;
        }
        $listServicePerRoom = [];
        for ($i = 0; $i < count($listCountRoomRented); $i++) {
            if ($listCountRoomRented[$i] == 0) {
                array_push($listServicePerRoom, 0);
            } else {
                array_push($listServicePerRoom, $listCountServiceUse[$i] / $listCountRoomRented[$i]);
            }
        }

        // return $arr;


        // get more revenue

        return response()->json([
            'listPerformance' => $listPerformance,
            'listStartTime' => $listStartTime,
            'roomCount' => $roomCount,
            'listCountRoomRented' => $listCountRoomRented,
            'listCountServiceUse' => $listCountServiceUse,
            'listServicePerRoom' => $listServicePerRoom,
            'listProductExport' => $listProductExport
        ]);
    }

    public function useService(Request $request)
    {
        if (!$request->type) {
            $type = 30;
        } else {
            $type = $request->type;
        }

        if ($type == 7) {
            $step = 1;
        } elseif ($type == 14) {
            $step = 2;
        } elseif ($type == 30) {
            $step = 3;
        }
    }

    public function exportProduct()
    {
    }

    public function revenue()
    {
        //SELECT DISTINCT * FROM `room_bills`
        // INNER JOIN rooms ON room_bills.room_id = rooms.room_id
        // WHERE date_checkin <= '2021-12-06 23:59:59'
        // AND date_checkout >= '2021-12-06 12:00:00' ???
        return view('dashboard.revenue');
    }

    public function filterBudgetInvoice(Request $request)
    {
        $start = $request->start;
        $finish = $request->finish;
        $filterResult = BudgetInvoice::filterBudgetInvoice($start, $finish);
        return response()->json($filterResult);
    }

    public function filterBill(Request $request)
    {
        $start = $request->start;
        $finish = $request->finish;
        // return $start;
        $filterResult = Bill::filterListBill($start, $finish);
        if (count($filterResult) > 0) {
            foreach ($filterResult as $bill) {
                $bill->date_payment = date('d/m/Y H:i', strtotime($bill->date_payment));
            }
        }
        return response()->json($filterResult);
    }

    public function filterWarehouseReceipt(Request $request)
    {
        $start = $request->start;
        $finish = $request->finish;
        $filterResult = WarehouseReceipt::filterWarehouseReceipt($start, $finish);
        if (count($filterResult) > 0) {
            foreach ($filterResult as $receipt) {
                $receipt->receipt_created_at = date('d/m/Y H:i', strtotime($receipt->receipt_created_at));
            }
        }
        return response()->json($filterResult);
    }

    public function filterBillView()
    {
        return view('dashboard.filter-bill');
    }

    public function filterBudgetInvoiceView()
    {
        return view('dashboard.filter-budget-invoice');
    }

    public function warehouseReceiptView()
    {
        return view('dashboard.filter-warehouse-receipt');
    }
}
