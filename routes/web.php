<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetInvoiceController;
use App\Http\Controllers\BudgetInvoiceTypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerServiceBillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftTypeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeaheadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\WarehouseReceiptController;
use App\Http\Controllers\WarehouseReceiptTypeController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//route auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/store', [AuthController::class, 'store'])->name('store');

Route::group(['middleware' => 'authMiddleware'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user-info', [AuthController::class, 'userInfo'])->name('user-info');

    //route booking
    Route::group(['middleware' => 'receptionistMiddleware'], function () {
        Route::resource('booking', BookingController::class);
        Route::get('filter-booking', [BookingController::class, 'filterBooking'])->name('booking.filter-booking');
        Route::get('booking/{id}/checkin', [BookingController::class, 'bookingToCheckin'])->name('booking.checkin');
        Route::get('booking/not-checkin', [BookingController::class, 'listNotCheckin'])->name('booking.not-checkin');
        Route::get('tomorrow-checkin', [BookingController::class, 'listBookingCheckinTomorrow'])->name('booking.tomorrow-checkin');
        Route::post('booking/{id}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
        Route::get('today-checkin', [BookingController::class, 'listBookingCheckinToday'])->name('booking.today-checkin');

        //route bill
        Route::resource('bill', BillController::class);
        Route::get('/pay-bill/{id}', [BillController::class, 'payBill'])->name('bill.pay-bill');
        Route::put('/payment-success/{id}', [BillController::class, 'paymentSuccess'])->name('bill.success-bill');


        //route customer
        Route::resource('customer', CustomerController::class);
        Route::get('/search/customer', [CustomerController::class, 'searchCustomer'])->name('customer.search');
    });







    // route dashboard
    Route::get('dashboard/room-performance', [DashboardController::class, 'roomPerformance'])->name('dashboard.room-performance');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');

    Route::get('dashboard/revenue', [DashboardController::class, 'revenue'])->name('dashboard.revenue');
    Route::get('filter-budget-invoice', [DashboardController::class, 'filterBudgetInvoice'])->name('dashboard.filter-budget-invoice');
    Route::get('filter-bill', [DashboardController::class, 'filterBill'])->name('dashboard.filter-bill');
    Route::get('filter-warehouse-receipt', [DashboardController::class, 'filterWarehouseReceipt'])->name('dashboard.filter-warehouse-receipt');

    // view
    Route::get('bill-list', [DashboardController::class, 'filterBillView'])->name('dashboard.bill-list');
    Route::get('budget-invoice-list', [DashboardController::class, 'filterBudgetInvoiceView'])->name('dashboard.budget-invoice-list');
    Route::get('warehouse-receipt-list', [DashboardController::class, 'warehouseReceiptView'])->name('dashboard.warehouse-receipt-list');


    Route::group(['middleware' => 'managerMiddleware'], function () {
        //route room
        Route::resource('room', RoomController::class);

        //route user-role
        Route::resource('role', UserRoleController::class);

        //route room type
        Route::resource('room-type', RoomTypeController::class);

        //route measure
        Route::resource('measure', MeasureController::class);

        //route status
        Route::resource('status', StatusController::class);

        //route services
        Route::resource('service', ServiceController::class);

        //service types
        Route::resource('service-type', ServiceTypeController::class);
        Route::get('filter-service', [ServiceController::class, 'filterService'])->name('service.filter-service');

        //route budget invoice type
        Route::resource('budget-invoice-type', BudgetInvoiceTypeController::class);

        // route floor
        Route::resource('floor', FloorController::class);
        // route user
        Route::resource('user', UserController::class);

        // route warehouse-receipt-type
        Route::resource('warehouse-receipt-type', WarehouseReceiptTypeController::class);

        //route shift-type
        Route::resource('shift-type', ShiftTypeController::class);

        //route shift
        Route::resource('shift', ShiftController::class);
        Route::get('finish-shift', [ShiftController::class, 'finishShift'])->name('shift.finish');

        //route budget
        Route::resource('budget', BudgetController::class)->except('index');
    });


    Route::group(['middleware' => 'receptionistMiddleware'], function () {
        //route room
        Route::get('room-rented', [RoomController::class, 'getRoomsBeingRented'])->name('room.room-rented');
        Route::get('checkin-room', [RoomController::class, 'checkinRoom'])->name('room.checkin');
        Route::get('room/{id}/add-service', [RoomController::class, 'roomRentedAddService'])->name('room.add-service');
        Route::post('room/{id}/store-add-service', [RoomController::class, 'storeRoomService'])->name('room.store-service');
        Route::get('room/{id}/update-status', [RoomController::class, 'updateStatus'])->name('room.update-status');
        Route::get('room-rented', [RoomController::class, 'getRoomsBeingRented'])->name('room.room-rented');
    });

    Route::get('room-diagram', [RoomController::class, 'diagram'])->name('room.diagram');
    Route::get('filter', [RoomController::class, 'filterRoom'])->name('room.filter');
    Route::get('filter-select', [RoomController::class, 'filterSelect'])->name('room.filter-select');


    Route::get('/', [RoomController::class, 'diagram'])->name('index');




    Route::group(['middleware' => 'stockkeeperMiddleware'], function () {
        //route supplier
        Route::resource('supplier', SupplierController::class);

        //route product
        Route::resource('product', ProductController::class);

        //route product-type
        Route::resource('product-type', ProductTypeController::class);

        //route warehouse-receipt
        Route::resource('warehouse-receipt', WarehouseReceiptController::class);
    });


    Route::group(['middleware' => 'cashierMiddleware'], function () {
        //route budget invoice
        Route::resource('budget-invoice', BudgetInvoiceController::class);
        Route::get('/search/budget-invoice', [BudgetInvoiceController::class, 'searchBudgetInvoice'])->name('budget-invoice.search');

        //route budget
        Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');
    });


    //route customer service bill
    Route::resource('customer-service-bill', CustomerServiceBillController::class);
});




Route::get('a', [RoomController::class, 'test']);
Route::get('json', [RoomController::class, 'getJson']);

Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);
Route::get('/autocomplete', [TypeaheadController::class, 'searchUser']);


Route::delete('/delete', [RoomController::class, 'deleteServiceBill']);
