@extends('main')
@section('links')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script> --}}


<meta name="csrf-token" content="{{ csrf_token() }}">


@endsection
@section('content')

{{-- <form>
    <div class="row form-group">
        <label for="date" class="col-sm-1 col-form-label">Date</label>
        <div class="col-sm-4">
            <div class="input-group date datepicker" id="datepicker">
                <input type="text" class="form-control" onchange="onChange(event)" value="">
                <span class="input-group-append">
                    <span class="input-group-text bg-white">
                        <i class="fa fa-calendar"></i>
                    </span>
                </span>
            </div>
            <div class="timepicker">
                <label for="email" class="col-sm-2 control-label">From Time</label>
                <input type="text" id="from_time" class="form-control timepicker" style="width: 30%;">
                <label for="email" class="col-sm-2 control-label">To Time</label>
                <input type="text" id="to_time" class="form-control timepicker" style="width: 30%;">
            </div>
            <div class="input-group date datepicker" id="datepicker1">
                <input type="text" class="form-control" onchange="onChange(event)">
                <span class="input-group-append">
                    <span class="input-group-text bg-white">
                        <i class="fa fa-calendar"></i>
                    </span>
                </span>
            </div>
        </div>
    </div>
</form> --}}


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sơ đồ phòng</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">

        <a href="{{ route('room.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm phòng mới</a>
        <a href="{{ route('room.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Đặt phòng</a>
        <a href="{{ route('room.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nhận phòng</a>


        <br>
        <br>
        <div class="row">
            @foreach ($rooms as $room)

            <div class="col-lg-3 col-6">
                <div role="button" data-bs-toggle="modal" href="#roomInfo{{ $room->room_id }}" class="small-box
                    @switch($room->status_id)
                        @case($isEmptyStatus)
                            {{ " bg-success bg-gradient text-white" }} @break @case($isRentedStatus)
                    {{ "bg-danger bg-gradient text-white" }} @break @case($isDirtyStatus)
                    {{ "bg-warning bg-gradient text-white" }} @break @case($isBookedStatus)
                    {{ "bg-primary bg-gradient text-white" }} @break @default {{ "bg-secondary bg-gradient text-white"
                    }} @endswitch">
                    <div class="inner">
                        <h3 style="text-align: center;">{{ $room->room_name }}</h3>
                        <p>{{ $room->room_type_info->type_name }}</p>
                        <p>{{ $room->status_name }}</p>

                    </div>

                </div>
            </div>

            {{-- Modal room info --}}
            <div class="modal fade" id="roomInfo{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel{{ $room->room_id }}"> {{
                                $room->room_name
                                }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4 col-6 border" ">Khách hàng:</div>
                                    <div class=" col-8 border">{{ $room->room_type_info->type_name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-6 border">Loại phòng:</div>
                                    <div class="col-8 border">{{ $room->room_type_info->type_name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-6 border">Giá phòng(VND):</div>
                                    <div class="col-8 border">{{ number_format($room->room_type_info->price) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-6 border">Ngày nhận phòng:</div>
                                    <div class="col-8 border">{{ $room->room_type_info->type_name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-6 border">Trạng thái phòng:</div>
                                    <div class="col-8 border">{{ $room->status_name }}<a href=""
                                            class="btn btn-success btn-sm" style="color: white; float: right;"
                                            data-bs-target="#changeStatus{{ $room->room_id }}" data-bs-toggle="modal"><i
                                                class="fas fa-exchange-alt"></i> Đổi trạng thái</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($room->status_id == $isRentedStatus)
                        <div class="modal-footer">
                            <a class="btn btn-primary btn-sm " data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" onclick="bookRoom({{ $room->room_id }},'addRoom'); defaultValueDatePicker();"><i
                                    class="fas fa-bed"></i> Đặt
                                phòng</a>
                            <a href="" class="btn btn-info btn-sm text-white"
                                data-bs-target="#tranferRoom{{ $room->room_id }}" data-bs-toggle="modal"><i
                                    class="fas fa-random"></i> Chuyển phòng</a>
                            <a href="" class="btn btn-danger btn-sm" data-bs-target="#checkout{{ $room->room_id }}"
                                data-bs-toggle="modal"
                                onclick="getPresentTime('roomCheckout{{ $room->room_id }}');getRoomRentAmount('roomCheckin'+{{ $room->room_id }}, 'roomCheckout'+{{ $room->room_id }}, 'roomPrice' + {{ $room->room_id }}, 'roomTotal' + {{ $room->room_id }},'total'+{{ $room->room_id }},'inputServiceTotal' + {{ $room->room_id }})"><i
                                    class="far fa-arrow-alt-circle-right"></i> Trả
                                phòng</a>
                            <a href="" class="btn btn-warning btn-sm" style="color: white"
                                data-bs-target="#services{{ $room->room_id }}" data-bs-toggle="modal"><i
                                    class="fas fa-coffee" style="color: white"></i> Dịch vụ</a>
                        </div>
                        @elseif ($room->status_id == $isEmptyStatus)
                        <div class="modal-footer">
                            <a class="btn btn-primary btn-sm " data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" onclick="bookRoom({{ $room->room_id }},'addRoom');defaultValueDatePicker()"><i
                                    class="fas fa-bed"></i> Đặt
                                phòng</a>
                            <a onclick="bookRoom({{ $room->room_id }},'addRoomCheckin');defaultValueDatePicker()" href=""
                                class="btn btn-info btn-sm text-white" data-bs-target="#checkin{{ $room->room_id }}"
                                data-bs-toggle="modal"><i class="far fa-arrow-alt-circle-down"></i> Nhận phòng</a>


                        </div>
                        @elseif ($room->status_id == $isBookedStatus)
                        <div class="modal-footer">
                            <a class="btn btn-primary btn-sm " data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" onclick="bookRoom({{ $room->room_id }},'addRoom');defaultValueDatePicker()"><i
                                    class="fas fa-bed"></i> Đặt
                                phòng</a>
                            <a onclick="bookRoom({{ $room->room_id }},'addRoomCheckin');defaultValueDatePicker()" href=""
                                class="btn btn-info btn-sm text-white" data-bs-target="#checkin{{ $room->room_id }}"
                                data-bs-toggle="modal"><i class="far fa-arrow-alt-circle-down"></i> Nhận phòng</a>

                        </div>
                        @elseif ($room->status_id == $isDirtyStatus)
                        <div class="modal-footer">
                            <a class="btn btn-primary btn-sm " data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" onclick="bookRoom({{ $room->room_id }},'addRoom');defaultValueDatePicker()"><i
                                    class="fas fa-bed"></i> Đặt
                                phòng</a>

                        </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Modal tranfer room --}}
            <div class="modal fade" id="tranferRoom{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Chuyển phòng {{ $room->room_name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Hide this modal and show the first with the button below.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-target="#roomInfo{{ $room->room_id }}"
                                data-bs-toggle="modal" onclick="exitClick(`tranferRoom{{ $room->room_id }}`)">Quay
                                lại</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal room services --}}
            <div class="modal fade" id="services{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Dich vu phong {{ $room->room_name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Hide this modal and show the first with the button below.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-target="#roomInfo{{ $room->room_id }}"
                                data-bs-toggle="modal">Quay lại</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal book room --}}
            <div class="modal fade" id="bookRoom{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Đặt phòng {{ $room->room_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action= method="POST">
                            <div class="modal-body">
                                <div class="container-fluid">

                                    <div class="row form-group" id="bookRoomDate{{ $room->room_id }}">
                                        <div class="col row">

                                            <div class="col-md-3">
                                                <label for="date" class="col-form-label">Checkin</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group date datepicker" id="bookRoomCheckin{{ $room->room_id }}">
                                                    <input type="text" class="form-control form-control-sm"
                                                        onchange="onChangeDate(event,{{ $room->room_id }},'checkin','bookRoomCheckin{{ $room->room_id }}','bookRoomCheckout{{ $room->room_id }}')" value="" min="0">
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col row">
                                            <div class="col-md-3">
                                                <label for="date" class="col-form-label">Checkout</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group date datepicker" id="bookRoomCheckout{{ $room->room_id }}">
                                                    <input type="text" class="form-control form-control-sm"
                                                        onchange="onChangeDate(event,{{ $room->room_id }},'checkout','bookRoomCheckin{{ $room->room_id }}','bookRoomCheckout{{ $room->room_id }}')" value="">
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div classs="row form-group my-4" id="form">
                                        <div class="row g-4 align-items-center">

                                            <div class="col-md-4">
                                                <label for="date" class="col-form-label">Tìm khách hàng</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" id="search" class="form-control form-control-sm"
                                                    style="width: 228px;
                                                    margin-left: -2.5px; height:31px" name="search"
                                                    placeholder="Nhập SĐT hoặc CCCD" />
                                                <input type="hidden" id="customerId" name="id">
                                            </div>

                                        </div>
                                    </div>
                                    <div classs="row form-group my-4">
                                        <div class="row g-3 align-items-center">

                                            <div class="col-md-4">
                                                <label for="date" class="col-form-label">Ghi chú</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control form-control-sm " type="text" name="note"
                                                    placeholder="Ghi chú" />
                                            </div>

                                        </div>
                                    </div>
                                    <div classs="row form-group my-4">
                                        <div class="row g-3 align-items-center">

                                            <div class="col-md-4">
                                                <label for="date" class="col-form-label">Trả trước</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control form-control-sm" type="number" name="deposit"
                                                    placeholder="Nhập số tiền" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <strong class="pb-3">Thông tin khách hàng</strong class="pb-3">
                                        <table class="table table-hover border fs-6 fw-normal">
                                            <thead class="table-light text-center">
                                                <tr>
                                                    <th class="fs-6 fw-normal border">Tên khách hàng</th>
                                                    <th class="fs-6 fw-normal border">Số điện thoại</th>
                                                    <th class="fs-6 fw-normal border">Số CMT/CCCD</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <th class="fs-6 fw-normal border" id="customerName"></th>
                                                    <th class="fs-6 fw-normal border" id="customerPhone"></th>
                                                    <th class="fs-6 fw-normal border" id="customerCitizenId"></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row  my-4">
                                            <div class="col-6">
                                                <strong class="pb-3">Danh sách đặt phòng</strong>
                                                <div id="modal_bodyaddRoom{{ $room->room_id }}"></div>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-sm btn-primary float-end"
                                                    data-bs-target="#addRoom{{ $room->room_id }}"
                                                    data-bs-toggle="modal">Thêm phòng</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table table-hover border fs-6 fw-normal small">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th class="border fs-6 fw-normal">Tên phòng</th>
                                                        <th class="border fs-6 fw-normal">Loại phòng</th>
                                                        <th class="border fs-6 fw-normal">Số khách</th>
                                                        <th class="border fs-6 fw-normal">Giá(VND)</th>
                                                        <th class="border fs-6 fw-normal">Checkin</th>
                                                        <th class="border fs-6 fw-normal">Checkout</th>
                                                        <th class="border fs-6 fw-normal">Xóa</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="addRoomList{{ $room->room_id }}">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row  my-4">
                                            <div class="col-6">
                                                <strong class="pb-3">Danh sách dịch vụ</strong>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-sm btn-primary float-end"
                                                    data-bs-target="#addService{{ $room->room_id }}"
                                                    data-bs-toggle="modal">Thêm dịch vụ</a>
                                            </div>
                                        </div>
                                        <div class="row my-4 fs-6">
                                            <table class="table table-hover border fs-6 fw-normal small">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th class="border fs-6 fw-normal">Tên sản phẩm</th>
                                                        <th class="border fs-6 fw-normal">Đơn giá</th>
                                                        <th class="border fs-6 fw-normal">Số lượng(VND)</th>
                                                        <th class="border fs-6 fw-normal">Thành tiền(VND)</th>
                                                        <th class="border fs-6 fw-normal">Tùy chọn</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="addedServiceListForm{{ $room->room_id }}">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success bookRoom-submit">Đặt phòng</button>
                                <button type="button" class="btn btn-primary"
                                    data-bs-target="#roomInfo{{ $room->room_id }}" data-bs-toggle="modal">Quay
                                    lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            {{-- Modal room checkout --}}
            @if($room->status_id == $isRentedStatus)
            <div class="modal fade" id="checkout{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Trả phòng {{ $room->room_name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="POST">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row my-4">
                                        <strong class="pb-3">Thông tin khách hàng</strong>
                                        <table class="table table-hover border fs-6 fw-normal">
                                            <thead class="table-light text-center">
                                                <tr>
                                                    <th class="fs-6 fw-normal border">Tên khách hàng</th>
                                                    <th class="fs-6 fw-normal border">Số điện thoại</th>
                                                    <th class="fs-6 fw-normal border">Số CMT/CCCD</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <input type="hidden" value="{{ $room->cus_info->cus_id }}"
                                                        name="customerId">
                                                    <th class="fs-6 fw-normal border">{{ $room->cus_info->cus_name }}
                                                    </th>
                                                    <th class="fs-6 fw-normal border">{{ $room->cus_info->phone }}</th>
                                                    <th class="fs-6 fw-normal border">{{ $room->cus_info->citizen_id }}
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row my-4">
                                        <strong class="pb-3">Thông tin thuê phòng</strong>
                                        <table class="table table-hover border fs-6 fw-normal">
                                            <thead class="table-light text-center">
                                                <tr>
                                                    <th class="fs-6 fw-normal border">Phòng</th>
                                                    <th class="fs-6 fw-normal border">Checkin</th>
                                                    <th class="fs-6 fw-normal border">Checkout</th>
                                                    <th class="fs-6 fw-normal border">Giá phòng(VND)</th>
                                                    {{-- <th class="fs-6 fw-normal border">Tiền dịch vụ</th> --}}
                                                    <th class="fs-6 fw-normal border">Thành tiền(VND)</th>

                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <input type="hidden" value="{{ $room->room_id }}" name="roomId">
                                                    <th class="fs-6 fw-normal border">{{ $room->room_name }}</th>

                                                    <th class="fs-6 fw-normal border"><input
                                                            class="form-control form-control-sm"
                                                            id="roomCheckin{{ $room->room_id }}" type="text"
                                                            name="checkin" class="form-control form-control-sm"
                                                            value="{{ date('d/m/Y',strtotime($room->date_checkin)) }}"
                                                            readonly></th>
                                                    <th class="fs-6 fw-normal border"><input
                                                            class="form-control form-control-sm" type="text"
                                                            name="checkout" id="roomCheckout{{ $room->room_id }}"
                                                            class="form-control form-control-sm" value="" readonly></th>
                                                    <th class="fs-6 fw-normal border">{{number_format(
                                                        $room->room_type_info->price) }} <input
                                                            id="roomPrice{{ $room->room_id }}"
                                                            value="{{ $room->room_type_info->price }}" type="hidden">
                                                    </th>

                                                    <th class="fs-6 fw-normal border"
                                                        id="roomTotal{{ $room->room_id }}">
                                                        Thành tiền(VND)</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    @if(count($room->services) > 0)
                                    <div class="row my-4">
                                        <div class="col-6">
                                            <strong class="pb-3">Danh sách dịch vụ</strong>
                                        </div>
                                    </div>
                                    <div class="row my-4 fs-6">
                                        <table class="table table-hover border fs-6 fw-normal small">
                                            <thead class="table-light text-center">
                                                <tr>
                                                    <th class="border fs-6 fw-normal">Tên sản phẩm</th>
                                                    <th class="border fs-6 fw-normal">Đơn giá(VND)</< /th>
                                                    <th class="border fs-6 fw-normal">Số lượng</th>
                                                    <th class="border fs-6 fw-normal">Thành tiền(VND)</th>

                                                </tr>
                                            </thead>
                                            <tbody id="addedServiceListForm{{ $room->room_id }}">
                                                <?php $total = 0 ?>
                                                @foreach ($room->services as $roomService)
                                                <tr class="text-center">
                                                    <input type="hidden" value="{{ $roomService->service_id }}"
                                                        name="services" />
                                                    <th class="border fs-6 fw-normal"> {{ $roomService->service_name }}
                                                    </th>
                                                    <th class="border fs-6 fw-normal"> {{
                                                        number_format($roomService->service_price) }} </th>
                                                    <th class="border fs-6 fw-normal"><input
                                                            class="form-control form-control-sm" type="number"
                                                            value="{{ $roomService->quantity }}" name="quantities"
                                                            readonly /></th>
                                                    <th class="border fs-6 fw-normal"
                                                        id="roomTotal{{ $room->room_id }}">{{
                                                        number_format($roomService->service_price*$roomService->quantity)
                                                        }}
                                                    </th>
                                                </tr>
                                                <?php $total += $roomService->service_price*$roomService->quantity; ?>
                                                @endforeach
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th><input type="hidden" value="{{ $total }}"
                                                            id="inputServiceTotal{{ $room->room_id }}" /></th>
                                                    <th class="border fs-6 fw-normal">Tổng</th>
                                                    <th class="border fs-6 fw-normal">{{ number_format($total) }} VND
                                                    </th>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <strong>Tổng số tiền</strong>
                                        <strong id="total{{ $room->room_id }}"></strong>
                                    </div>
                                    @endif
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Lưu</button>

                                <button type="button" class="btn btn-primary"
                                    data-bs-target="#roomInfo{{ $room->room_id }}" data-bs-toggle="modal">Quay
                                    lại</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            @endif


            {{-- Modal change room status --}}
            <div class="modal fade" id="changeStatus{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Đổi trạng thái phòng {{
                                $room->room_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Doi trang thai phong
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-target="#roomInfo{{ $room->room_id }}"
                                data-bs-toggle="modal">Quay lại</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal checkin --}}
            @if ($room->status_id == $isEmptyStatus || $room->status_id == $isBookedStatus)

            <div class="modal fade" id="checkin{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Nhận phòng {{ $room->room_name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="POST">
                            <div class="modal-body">
                                <div class="container-fluid">

                                    <div class="row form-group">
                                        <div class="col row">

                                            <div class="col-md-3">
                                                <label for="date" class="col-form-label">Checkin</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" id="" class="form-control form-control-sm">
                                            </div>

                                        </div>

                                        <div class="col row">
                                            <div class="col-md-3">
                                                <label for="date" class="col-form-label">Checkout</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" id="" class="form-control form-control-sm">
                                            </div>

                                        </div>
                                    </div>
                                    <div classs="row form-group my-4" id="form">
                                        <div class="row g-4 align-items-center">

                                            <div class="col-md-4">
                                                <label for="date" class="col-form-label">Tìm khách hàng</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" id="search-checkin"
                                                    class="form-control form-control-sm" style="width: 228px;
                                                    margin-left: -2.5px; height:31px" name="search"
                                                    placeholder="Nhập SĐT hoặc CCCD" />
                                                <input type="hidden" id="customerIdCheckin" name="id">
                                            </div>

                                        </div>
                                    </div>
                                    <div classs="row form-group my-4">
                                        <div class="row g-3 align-items-center">

                                            <div class="col-md-4">
                                                <label for="date" class="col-form-label">Ghi chú</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control form-control-sm " type="text" name="note"
                                                    placeholder="Ghi chú" />
                                            </div>

                                        </div>
                                    </div>
                                    <div classs="row form-group my-4">
                                        <div class="row g-3 align-items-center">

                                            <div class="col-md-4">
                                                <label for="date" class="col-form-label">Trả trước</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control form-control-sm" type="number" name="deposit"
                                                    placeholder="Nhập số tiền" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <strong class="pb-3">Thông tin khách hàng</strong class="pb-3">
                                        <table class="table table-hover border fs-6 fw-normal">
                                            <thead class="table-light text-center">
                                                <tr>
                                                    <th class="fs-6 fw-normal border">Tên khách hàng</th>
                                                    <th class="fs-6 fw-normal border">Số điện thoại</th>
                                                    <th class="fs-6 fw-normal border">Số CMT/CCCD</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <th class="fs-6 fw-normal border" id="customerNameCheckin"></th>
                                                    <th class="fs-6 fw-normal border" id="customerPhoneCheckin"></th>
                                                    <th class="fs-6 fw-normal border" id="customerCitizenIdCheckin">
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row  my-4">
                                            <div class="col-6">
                                                <strong class="pb-3">Danh sách đặt phòng</strong>
                                                <div id="modal_bodyaddRoomCheckin{{ $room->room_id }}"></div>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-sm btn-primary float-end"
                                                    data-bs-target="#addRoomCheckin{{ $room->room_id }}"
                                                    data-bs-toggle="modal">Thêm phòng</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table table-hover border fs-6 fw-normal small">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th class="border fs-6 fw-normal">Tên phòng</th>
                                                        <th class="border fs-6 fw-normal">Loại phòng</th>
                                                        <th class="border fs-6 fw-normal">Số khách</th>
                                                        <th class="border fs-6 fw-normal">Giá(VND)</th>
                                                        <th class="border fs-6 fw-normal">Checkin</th>
                                                        <th class="border fs-6 fw-normal">Checkout</th>
                                                        <th class="border fs-6 fw-normal">Xóa</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="addRoomCheckinList{{ $room->room_id }}">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row  my-4">
                                            <div class="col-6">
                                                <strong class="pb-3">Danh sách dịch vụ</strong>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-sm btn-primary float-end"
                                                    data-bs-target="#addServiceCheckin{{ $room->room_id }}"
                                                    data-bs-toggle="modal">Thêm dịch vụ</a>
                                            </div>
                                        </div>
                                        <div class="row my-4 fs-6">
                                            <table class="table table-hover border fs-6 fw-normal small">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th class="border fs-6 fw-normal">Tên sản phẩm</th>
                                                        <th class="border fs-6 fw-normal">Đơn giá</th>
                                                        <th class="border fs-6 fw-normal">Số lượng(VND)</th>
                                                        <th class="border fs-6 fw-normal">Thành tiền(VND)</th>
                                                        <th class="border fs-6 fw-normal">Tùy chọn</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="addedServiceCheckinListForm{{ $room->room_id }}">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success bookRoom-submit">Lưu</button>
                                <button type="button" class="btn btn-primary"
                                    data-bs-target="#roomInfo{{ $room->room_id }}" data-bs-toggle="modal">Quay
                                    lại</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            @endif

            {{-- Modal add room --}}
            @if ($room->status_id == $isEmptyStatus || $room->status_id == $isBookedStatus || $room->status_id == $isRentedStatus)

            <div class="modal fade " id="addRoom{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm phòng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="row form-group" >
                                    <div class="col row">

                                        <div class="col-md-3">
                                            <label for="date" class="col-form-label">Checkin</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group date datepicker" id="addRoomDatepickerCheckin{{ $room->room_id }}">
                                                <input type="text" class="form-control form-control-sm"
                                                    onchange="onChangeAddRoomDate(event,{{ $room->room_id }},'checkin','addRoomDatepickerCheckin{{ $room->room_id }}','addRoomDatepickerCheckout{{ $room->room_id }}','bookRoomaddRoomRow{{ $room->room_id }}')" >
                                                <span class="input-group-append">
                                                    <span class="input-group-text bg-white">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col row">
                                        <div class="col-md-3">
                                            <label for="date" class="col-form-label">Checkout</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group date datepicker" id="addRoomDatepickerCheckout{{ $room->room_id }}">
                                                <input type="text" class="form-control form-control-sm"
                                                    onchange="onChangeAddRoomDate(event,{{ $room->room_id }},'checkout','addRoomDatepickerCheckin{{ $room->room_id }}','addRoomDatepickerCheckout{{ $room->room_id }}','bookRoomaddRoomRow{{ $room->room_id }}')" value="">
                                                <span class="input-group-append">
                                                    <span class="input-group-text bg-white">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- <input type="text" class="name{{ $room->room_id }}">
                                <input type="text" class="name{{ $room->room_id }}"> --}}
                                <table class="center table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="border fs-6 fw-normal p-2">Tên phòng</th>
                                            <th class="border fs-6 fw-normal p-2">Loại phòng</th>
                                            <th class="border fs-6 fw-normal p-2">Trạng thái</th>
                                            <th class="border fs-6 fw-normal p-2">Đặt phòng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rooms as $newRoom)
                                        <tr id="bookRoomaddRoomRow{{ $room->room_id }}{{ $newRoom->room_id }}">
                                            <th class="border fs-6 fw-normal p-2">{{$newRoom->room_name }}</th>
                                            <th class="border fs-6 fw-normal p-2">{{$newRoom->room_type_info->type_name }}
                                            </th>
                                            <th class="border fs-6 fw-normal p-2">{{$newRoom->status_name }}</th>
                                            <th class="border fs-6 fw-normal p-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        onclick="if(this.checked){setValueChecked({{ $room->room_id }},{{$newRoom->room_id }},'addRoom')}else{setValueUnchecked({{ $room->room_id }},{{$newRoom->room_id }},'addRoom')}" />
                                                    <input id="addRoom{{ $room->room_id }}{{ $newRoom->room_id }}"
                                                        type="hidden" />
                                                </div>
                                            </th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" id="submit{{ $room->room_id }}"
                                onclick="addRoomClick({{ $room->room_id }}, 'addRoom');addRoomClickSetValue({{ $room->room_id }},'addRoom')">Lưu</button>
                            <button class="btn btn-primary" data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal"
                                onclick="addRoomClickSetValue({{ $room->room_id }},'addRoom')">Quay
                                lại</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            {{-- Modal add service --}}

            @if ($room->status_id == $isEmptyStatus || $room->status_id == $isBookedStatus)

            <div class="modal fade" id="addService{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm dịch vụ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-4 fs-6 border-end border-dark pt-3">

                                    <table class="table table-hover small text-center">
                                        <thead>
                                            <tr>
                                                <th class="border  fw-normal">Tên dịch vụ</th>
                                                <th class="border  fw-normal">Giá(VND)</th>
                                                <th class="border  fw-normal">Tùy chọn</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($services as $service)
                                            <tr id="addedServiceItem{{ $room->room_id }}{{ $service->service_id }}">
                                                <th class="border fw-normal">{{$service->service_name }}</th>
                                                <th class="border fw-normal">{{number_format($service->service_price) }}
                                                </th>
                                                <th class="border fw-normal d-flex justify-content-center"><button
                                                        class="btn btn-success btn-sm center"
                                                        onclick="addServiceRow({{ $room->room_id }}, {{ $service->service_id }}, 'addedService')"><i
                                                            class="fas fa-plus"></i></button></th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-8 fs-6 pt-3">
                                    <table class="table table-hover small text-center">
                                        <thead>
                                            <tr>
                                                <th class="border  fw-normal">STT</th>
                                                <th class="border  fw-normal">Tên dịch vụ</th>
                                                <th class="border  fw-normal">Giá(VND)</th>
                                                <th class="border  fw-normal">Số lượng</th>
                                                <th class="border  fw-normal">Thành tiền(VND)</th>
                                                <th class="border  fw-normal">Tùy chọn</th>

                                            </tr>
                                        </thead>
                                        <tbody class="" id="addedServiceList{{ $room->room_id }}">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" id="submit{{ $room->room_id }}"
                                onclick="addServiceClick({{ $room->room_id }},'addedService');addServiceClickSetValue({{ $room->room_id }},'addedService')">Lưu</button>
                            <button class="btn btn-primary" data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal"
                                onclick="addServiceClickSetValue({{ $room->room_id }},'addedService')">Quay
                                lại</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($room->status_id == $isEmptyStatus || $room->status_id == $isBookedStatus)

            {{-- Modal add room checkin--}}
            <div class="modal fade " id="addRoomCheckin{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm phòng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row form-group" >
                                <div class="col row">

                                    <div class="col-md-3">
                                        <label for="date" class="col-form-label">Checkin</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group date datepicker" id="addRoomDatepickerCheckinCheckin{{ $room->room_id }}">
                                            <input type="text" class="form-control form-control-sm"
                                                onchange="onChangeAddRoomDate(event,{{ $room->room_id }},'checkin','addRoomDatepickerCheckinCheckin{{ $room->room_id }}','addRoomDatepickerCheckinCheckout{{ $room->room_id }}','bookRoomaddRoomRow{{ $room->room_id }}')" >
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col row">
                                    <div class="col-md-3">
                                        <label for="date" class="col-form-label">Checkout</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group date datepicker" id="addRoomDatepickerCheckinCheckout{{ $room->room_id }}">
                                            <input type="text" class="form-control form-control-sm"
                                                onchange="onChangeAddRoomDate(event,{{ $room->room_id }},'checkout','addRoomDatepickerCheckin{{ $room->room_id }}','addRoomDatepickerCheckout{{ $room->room_id }}','bookRoomaddRoomRow{{ $room->room_id }}')" value="">
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- <input type="text" class="name{{ $room->room_id }}">
                            <input type="text" class="name{{ $room->room_id }}"> --}}
                            <table class="center table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="border fs-6 fw-normal p-2">Tên phòng</th>
                                        <th class="border fs-6 fw-normal p-2">Loại phòng</th>
                                        <th class="border fs-6 fw-normal p-2">Trạng thái</th>
                                        <th class="border fs-6 fw-normal p-2">Đặt phòng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $newRoom)
                                    <tr id="checkinAddRoomRow{{ $room->room_id }}{{ $newRoom->room_id }}">
                                        <th class="border fs-6 fw-normal p-2">{{$newRoom->room_name }}</th>
                                        <th class="border fs-6 fw-normal p-2">{{$newRoom->room_type_info->type_name }}
                                        </th>
                                        <th class="border fs-6 fw-normal p-2">{{$newRoom->status_name }}</th>
                                        <th class="border fs-6 fw-normal p-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                    onclick="if(this.checked){setValueChecked({{ $room->room_id }},{{$newRoom->room_id }},'addRoomCheckin')}else{setValueUnchecked({{ $room->room_id }},{{$newRoom->room_id }},'addRoomCheckin')}" />
                                                <input id="addRoomCheckin{{ $room->room_id }}{{ $newRoom->room_id }}"
                                                    type="hidden" />
                                            </div>
                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" data-bs-target="#checkin{{ $room->room_id }}"
                                data-bs-toggle="modal" id="submitCheckin{{ $room->room_id }}"
                                onclick="addRoomClick({{ $room->room_id }}, 'addRoomCheckin');addRoomClickSetValue({{ $room->room_id }},'addRoomCheckin')">Lưu</button>
                            <button class="btn btn-primary" data-bs-target="#checkin{{ $room->room_id }}"
                                data-bs-toggle="modal"
                                onclick="addRoomClickSetValue({{ $room->room_id }},'addRoomCheckin')">Quay
                                lại</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Modal add service checkin--}}
            @if ($room->status_id == $isEmptyStatus || $room->status_id == $isBookedStatus)

            <div class="modal fade" id="addServiceCheckin{{ $room->room_id }}" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm dịch vụ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-4 fs-6 border-end border-dark pt-3">

                                    <table class="table table-hover small text-center">
                                        <thead>
                                            <tr>
                                                <th class="border  fw-normal">Tên dịch vụ</th>
                                                <th class="border  fw-normal">Giá(VND)</th>
                                                <th class="border  fw-normal">Tùy chọn</th>

                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($services as $service)
                                            <tr
                                                id="addedServiceCheckinItem{{ $room->room_id }}{{ $service->service_id }}">
                                                <th class="border fw-normal">{{$service->service_name }}</th>
                                                <th class="border fw-normal">{{number_format($service->service_price) }}
                                                </th>
                                                <th class="border fw-normal d-flex justify-content-center"><button
                                                        class="btn btn-success btn-sm center"
                                                        onclick="addServiceRow({{ $room->room_id }}, {{ $service->service_id }},'addedServiceCheckin')"><i
                                                            class="fas fa-plus"></i></button></th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-8 fs-6 pt-3">
                                    <table class="table table-hover small text-center">
                                        <thead>
                                            <tr>
                                                <th class="border  fw-normal">STT</th>
                                                <th class="border  fw-normal">Tên dịch vụ</th>
                                                <th class="border  fw-normal">Giá(VND)</th>
                                                <th class="border  fw-normal">Số lượng</th>
                                                <th class="border  fw-normal">Thành tiền(VND)</th>
                                                <th class="border  fw-normal">Tùy chọn</th>

                                            </tr>
                                        </thead>
                                        <tbody class="" id="addedServiceCheckinList{{ $room->room_id }}">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" data-bs-target="#checkin{{ $room->room_id }}"
                                data-bs-toggle="modal" id="submitServiceCheckin{{ $room->room_id }}"
                                onclick="addServiceClick({{ $room->room_id }},'addedServiceCheckin');addServiceClickSetValue({{ $room->room_id }},'addedServiceCheckin')">Lưu</button>
                            <button class="btn btn-primary" data-bs-target="#checkin{{ $room->room_id }}"
                                data-bs-toggle="modal"
                                onclick="addServiceClickSetValue({{ $room->room_id }},'addedServiceCheckin')">Quay
                                lại</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            @endforeach


        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>

<script type="text/javascript">
    var route = "{{ url('autocomplete-search') }}";
    // class search
        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    var arr = [];
                    data.forEach(element => {
                        var id = element.cus_id;
                        var name = element.cus_name;
                        var phone = element.phone;
                        var citizenId = element.citizen_id;
                        var push = id + ' - ' + name + ' - ' +  phone + ' - ' + citizenId;
                        arr.push(push);
                    });
                    return process(arr);
                });
            },
            updater:function (item) {
                var customerInfo = item.split(" - ")
                // console.log(customerInfo)

                // console.log(customerInfo)
                document.getElementById('customerId').setAttribute('value',customerInfo[0]);

                document.getElementById('customerName').innerHTML = customerInfo[1];
                document.getElementById('customerPhone').innerHTML = customerInfo[2];
                document.getElementById('customerCitizenId').innerHTML = customerInfo[3];

                // console.log(document.getElementById('customerPhone').value);
                // return item;
            }
        });

        $('#search-checkin').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    var arr = [];
                    data.forEach(element => {
                        var id = element.cus_id;
                        var name = element.cus_name;
                        var phone = element.phone;
                        var citizenId = element.citizen_id;
                        var push = id + ' - ' + name + ' - ' +  phone + ' - ' + citizenId;
                        arr.push(push);
                    });
                    return process(arr);
                });
            },
            updater:function (item) {
                var customerInfo = item.split(" - ")
                // console.log(customerInfo)

                // console.log(customerInfo)
                document.getElementById('customerIdCheckin').setAttribute('value',customerInfo[0]);

                document.getElementById('customerNameCheckin').innerHTML = customerInfo[1];
                document.getElementById('customerPhoneCheckin').innerHTML = customerInfo[2];
                document.getElementById('customerCitizenIdCheckin').innerHTML = customerInfo[3];

                // console.log(document.getElementById('customerPhone').value);
                // return item;
            }
        });

        function addRoomClick(id,preStr){

                //get list room data
                var roomsObj = {!! json_encode($rooms->toArray()) !!};
                var rooms = Object.values(roomsObj);


                var addRoom = document.getElementById(preStr + id.toString())

                //get list input id add room
                var values = addRoom.querySelectorAll("input[type=hidden]")

                var rowOrder = 1;
                values.forEach(function(element){
                    if(element.value){
                        rooms.forEach(function(room){
                            if(room.room_id == element.value){

                                if(!document.getElementById(preStr + "InputValue" + element.value.toString())){

                                    var roomInputIdValue = document.createElement("INPUT");
                                    roomInputIdValue.setAttribute("type", "hidden");
                                    roomInputIdValue.setAttribute("value", element.value);
                                    var inputId = preStr + "InputValue" + element.value.toString();
                                    roomInputIdValue.setAttribute("id",inputId);
                                    roomInputIdValue.setAttribute("name", "rooms");
                                    document.getElementById("modal_body" + preStr + id.toString()).appendChild(roomInputIdValue);



                                    var addRoomList = document.getElementById( preStr + 'List' + id.toString());
                                    var row = addRoomList.insertRow(-1);
                                    row.setAttribute('id', preStr + 'Row' + element.value.toString());

                                    var rowId = preStr + "Row" + element.value.toString();

                                    var roomName = row.insertCell(0);
                                    var roomTypeName = row.insertCell(1);
                                    var guest = row.insertCell(2);
                                    var price = row.insertCell(3);
                                    var checkin = row.insertCell(4);
                                    var checkout = row.insertCell(5);
                                    var deleteRow = row.insertCell(6);

                                    // var stt = row.insertCell(7);
                                    // stt.innerHTML = rowOrder;
                                    //làm lại giao diện, mỗi chức năng 1 route()

                                    roomName.innerHTML = room.room_name;
                                    roomTypeName.innerHTML = room.room_type_info.type_name;
                                    guest.innerHTML = room.room_type_info.guest_number;
                                    price.innerHTML = new Intl.NumberFormat('vn-VN').format(room.room_type_info.price);
                                    checkin.innerHTML = `<div class="input-group date datepicker checkin" id='addRoomRowCheckin${preStr}${id}${room.room_id}'>
                                                    <input type="text" class="form-control form-control-sm"
                                                    onchange="onChangeDate(event,${id},'checkin','addRoomRowCheckin${preStr}${id}${room.room_id}','addRoomRowCheckout${preStr}${id}${room.room_id}')"   >
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>`;
                                    checkout.innerHTML = `<div class="input-group date datepicker checkout" id='addRoomRowCheckout${preStr}${id}${room.room_id}'>
                                                    <input type="text" class="form-control form-control-sm"
                                                    onchange="onChangeDate(event,${id},'checkout','addRoomRowCheckin${preStr}${id}${room.room_id}','addRoomRowCheckout${preStr}${id}${room.room_id}')"   >
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>`;
                                    deleteRow.innerHTML = `<button class="btn btn-danger btn-sm" type="button" onclick="deleteElement('${rowId}','${inputId}')"><i class="fas fa-times"></i></button>`;

                                    roomName.setAttribute("class",'border fs-6 fw-normal text-center');
                                    roomTypeName.setAttribute("class",'border fs-6 fw-normal text-center');
                                    guest.setAttribute("class",'border fs-6 fw-normal text-center');
                                    price.setAttribute("class",'border fs-6 fw-normal text-center');
                                    checkin.setAttribute("class",'border fs-6 fw-normal text-center');
                                    checkout.setAttribute("class",'border fs-6 fw-normal text-center');
                                    deleteRow.setAttribute("class",'border fs-6 fw-normal text-center');
                                    ++rowOrder;
                                }

                            }
                        })
                    }


                })
        }




        function deleteElement(rowId, inputId) {
            document.getElementById(inputId).remove();
            document.getElementById(rowId).remove();

        }

        function addRoomClickSetValue(id, preStr){
            var inputs = document.getElementById(preStr + id.toString()).querySelectorAll('input[type=hidden]');
            inputs.forEach(function(input){
                input.value = null;
            })
            var checkboxes = document.getElementById(preStr + id.toString()).querySelectorAll('input[type=checkbox]');
            checkboxes.forEach(function(element){
                element.checked = false;
            })

        }

        function bookRoom(roomId, preStr){
            var roomsObj = {!! json_encode($rooms->toArray()) !!};
            var rooms = Object.values(roomsObj);

            rooms.forEach(function(room){
                if(!document.getElementById(preStr + "InputValue" + roomId.toString())){

                    if(roomId == room.room_id){
                        var roomInputIdValue = document.createElement("INPUT");
                        roomInputIdValue.setAttribute("type", "hidden");
                        roomInputIdValue.setAttribute("value", roomId);
                        var inputId = preStr + "InputValue" + roomId.toString();
                        roomInputIdValue.setAttribute("id",inputId);
                        roomInputIdValue.setAttribute("name", "rooms");
                        document.getElementById("modal_body" + preStr + roomId.toString()).appendChild(roomInputIdValue);

                        var addRoomList = document.getElementById(preStr + 'List' + roomId.toString());
                        var row = addRoomList.insertRow(0);
                        var rowId = preStr + "Row" + roomId.toString();
                        row.setAttribute('id',rowId);


                        var roomName = row.insertCell(0);
                        var roomTypeName = row.insertCell(1);
                        var guest = row.insertCell(2);
                        var price = row.insertCell(3);
                        var checkin = row.insertCell(4);
                        var checkout = row.insertCell(5);
                        var deleteRow = row.insertCell(6);

                        // var stt = row.insertCell(7);
                        // stt.innerHTML = rowOrder;


                        roomName.innerHTML = room.room_name;
                        roomTypeName.innerHTML = room.room_type_info.type_name;
                        guest.innerHTML = room.room_type_info.guest_number;
                        price.innerHTML = new Intl.NumberFormat('vn-VN').format(room.room_type_info.price);
                        checkin.innerHTML = `<div class="input-group date datepicker checkin" id="bookRoomCheckin${preStr}${roomId}${roomId}">
                                                    <input type="text" class="form-control form-control-sm"
                                                    onchange = "onChangeDate(event,${roomId},'checkin','bookRoomCheckin${preStr}${roomId}${roomId}','bookRoomCheckout${preStr}${roomId}${roomId}')"   />
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>`
                        checkout.innerHTML = `<div class="input-group date datepicker checkout" id="bookRoomCheckout${preStr}${roomId}${roomId}">
                                                    <input type="text" class="form-control form-control-sm"
                                                    onchange = "onChangeDate(event,${roomId},'checkout','bookRoomCheckin${preStr}${roomId}${roomId}','bookRoomCheckout${preStr}${roomId}${roomId}')"   />
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>`
                        deleteRow.innerHTML = `<button class="btn btn-danger btn-sm" type="button" onclick="deleteElement('${rowId}','${inputId}')"><i class="fas fa-times"></i></button>`;

                        roomName.setAttribute("class",'border fs-6 fw-normal text-center');
                        roomTypeName.setAttribute("class",'border fs-6 fw-normal text-center');
                        guest.setAttribute("class",'border fs-6 fw-normal text-center');
                        price.setAttribute("class",'border fs-6 fw-normal text-center');
                        checkin.setAttribute("class",'border fs-6 fw-normal text-center');
                        checkout.setAttribute("class",'border fs-6 fw-normal text-center');
                        deleteRow.setAttribute("class",'border fs-6 fw-normal text-center');
                    }
                }
            })

        }

        function exitClick(id){
            var listInput = document.getElementById(id).querySelectorAll("input");
            listInput.forEach(function(input){
                input.checked = false;
                input.value = null;
            })
        }

        function setValueChecked(id1, id2, preStr){
            var id = preStr.toString() + id1.toString() + id2.toString();

            // console.log(id)
            document.getElementById(id).value = id2;


        }

        //Set value input when check, uncheck
        function setValueUnchecked(id1,id2, preStr){
            var id = preStr.toString() + id1.toString() + id2.toString();
            document.getElementById(id).value = null;
        }



        function addServiceClickSetValue(id, preStr){
            var inputs = document.getElementById(preStr + 'List' + id.toString()).querySelectorAll('input[type=hidden]');
            inputs.forEach(function(input){
                input.value = null;
            })
            var rows = document.getElementById(preStr + 'List' + id.toString()).querySelectorAll('tr');
            rows.forEach(function(row){
                row.remove();
            })
        }
        //addedService, addedServiceCheckin
        function addServiceRow(roomId, serviceId, preStr){
            var servicesObj = {!! json_encode($services->toArray()) !!};
            var service = document.getElementById(preStr + "List" + roomId.toString());

                if(!document.getElementById(preStr + 'IdInput' + roomId.toString() + serviceId.toString())){
                    var row = service.insertRow(-1);
                    rowId = preStr + roomId.toString() + serviceId.toString();
                    row.setAttribute('id', rowId);
                    row.setAttribute('class','mw-100 small');

                    var order = row.insertCell(0);
                    var serviceName = row.insertCell(1);
                    var price = row.insertCell(2);
                    var quantity = row.insertCell(3);
                    var amount = row.insertCell(4)
                    var deleteRow = row.insertCell(5);
                    var serviceInputValue = row.insertCell(6)

                    order.innerHTML = document.getElementById(preStr + 'List' + roomId.toString()).children.length;
                    serviceName.innerHTML = document.querySelectorAll('#'+ preStr +'Item' + roomId.toString() + serviceId.toString() + ' > th')[0].textContent;
                    priceStr = document.querySelectorAll('#'+ preStr +'Item' + roomId.toString() + serviceId.toString() + ' > th')[1].textContent;
                    var priceNumber = Number(priceStr.replace(/[^0-9.-]+/g,""))
                    price.innerHTML = new Intl.NumberFormat('vn-VN').format(priceNumber);
                    amount.innerHTML = new Intl.NumberFormat('vn-VN').format(priceNumber);

                    quantity.setAttribute("id", preStr + 'IdInput' + roomId.toString() + serviceId.toString());
                    quantity.innerHTML = `<input class='form-control' type='number' min=1 value=1 />`;
                    serviceInputValue.innerHTML =  `<input type='hidden' value=${serviceId} />`;
                    var inputId = "inputServiceValue" + roomId.toString() + serviceId.toString();
                    serviceInputValue.setAttribute('id', inputId)
                    deleteRow.innerHTML = `<button class="btn btn-danger btn-sm" type="button" onclick="deleteElement('${rowId}','${inputId}')"><i class="fas fa-times"></i></button>`;

                    order.setAttribute("class",'small border fs-6 fw-normal text-center');
                    serviceName.setAttribute("class",'small border fs-6 fw-normal text-center');
                    price.setAttribute("class",'border fs-6 fw-normal text-center small');
                    deleteRow.setAttribute("class",'border fs-6 fw-normal text-center');
                    quantity.setAttribute("class",'border fs-6 fw-normal text-center');
                    amount.setAttribute("class",'border fs-6 fw-normal text-center');

                    serviceName.setAttribute( 'style','font-size:0.85rem !important');
                    price.setAttribute( 'style','font-size:0.85rem !important');
                    deleteRow.setAttribute( 'style','font-size:0.85rem !important');;
                    quantity.setAttribute( 'style','font-size:0.85rem !important');;
                    amount.setAttribute( 'style','font-size:0.85rem !important');;
            }

        }


        //addedService addedServiceCheckin
        function addServiceClick(id, preStr){
            var rows = document.getElementById(preStr + 'List' + id.toString()).querySelectorAll('tr');
            var listServiceForm = document.getElementById(preStr + 'ListForm' + id.toString());
            rows.forEach(function(element){
                var serviceRow = element.querySelectorAll('td')
                var serviceId = serviceRow[6].querySelector('input').value;
                if(!document.getElementById(preStr + 'Row' + id.toString() + serviceId.toString())){

                    var row = listServiceForm.insertRow(-1);
                    var quantityVal = serviceRow[3].querySelector('input').value
                    rowId = preStr + 'Row' + id.toString() + serviceId.toString();
                    row.setAttribute('id', rowId);
                    row.setAttribute('class','mw-100 small');

                    var serviceName = row.insertCell(0);
                    var price = row.insertCell(1);
                    var quantity = row.insertCell(2);
                    var amount = row.insertCell(3)
                    var deleteRow = row.insertCell(4);
                    var serviceInputValue = row.insertCell(5)

                    serviceName.innerHTML = serviceRow[1].textContent;
                    priceStr = serviceRow[2].textContent;
                    var priceNumber = Number(priceStr.replace(/[^0-9.-]+/g,""))
                    price.innerHTML = new Intl.NumberFormat('vn-VN').format(priceNumber);
                    amount.innerHTML = new Intl.NumberFormat('vn-VN').format(priceNumber);

                    quantity.innerHTML = `<input class='form-control' type='number' min=1 value=${quantityVal} />`;
                    var inputId = "input" + preStr + id.toString() + serviceId.toString();
                    serviceInputValue.innerHTML =  `<input id=${inputId}  name='services' type='hidden' value=${serviceId} />`;
                    // serviceInputValue.setAttribute('id', inputId)
                    deleteRow.innerHTML = `<button class="btn btn-danger btn-sm" type="button" onclick="deleteElement('${rowId}','${inputId}')"><i class="fas fa-times"></i></button>`;

                    serviceName.setAttribute("class",'small border fs-6 fw-normal text-center');
                    price.setAttribute("class",'border fs-6 fw-normal text-center small');
                    deleteRow.setAttribute("class",'border fs-6 fw-normal text-center');
                    quantity.setAttribute("class",'border fs-6 fw-normal text-center');
                    amount.setAttribute("class",'border fs-6 fw-normal text-center');

                    serviceName.setAttribute( 'style','font-size:0.85rem !important');
                    price.setAttribute( 'style','font-size:0.85rem !important');
                    deleteRow.setAttribute( 'style','font-size:0.85rem !important');;
                    quantity.setAttribute( 'style','font-size:0.85rem !important');;
                    amount.setAttribute( 'style','font-size:0.85rem !important');;
                }
            })
        }

        function addRoomClickCheckin(id){

            //get list room data
            var roomsObj = {!! json_encode($rooms->toArray()) !!};
            var rooms = Object.values(roomsObj);


            var addRoom = document.getElementById("addRoomCheckin" + id.toString())

            //get list input id add room
            var values = addRoom.querySelectorAll("input[type=hidden]")

            var rowOrder = 1;
            values.forEach(function(element){
                if(element.value){
                    rooms.forEach(function(room){
                        if(room.room_id == element.value){

                            if(!document.getElementById("addRoomInputValueCheckin" + element.value.toString())){

                                var roomInputIdValue = document.createElement("INPUT");
                                roomInputIdValue.setAttribute("type", "hidden");
                                roomInputIdValue.setAttribute("value", element.value);
                                roomInputIdValue.setAttribute("id", "addRoomInputValueCheckin" + element.value.toString());
                                roomInputIdValue.setAttribute("name", "rooms");
                                var inputId = "addRoomInputValueCheckin" + element.value.toString();
                                document.getElementById("modal_bodyaddRoomCheckin" + id.toString()).appendChild(roomInputIdValue);



                                var addRoomList = document.getElementById('addRoomCheckinList' + id.toString());
                                var row = addRoomList.insertRow(-1);
                                row.setAttribute('id','addRoomRowCheckin' + element.value.toString());

                                var rowId = "addRoomRowCheckin" + element.value.toString();

                                var roomName = row.insertCell(0);
                                var roomTypeName = row.insertCell(1);
                                var guest = row.insertCell(2);
                                var price = row.insertCell(3);
                                var checkin = row.insertCell(4);
                                var checkout = row.insertCell(5);
                                var deleteRow = row.insertCell(6);

                                // var stt = row.insertCell(7);
                                // stt.innerHTML = rowOrder;


                                roomName.innerHTML = room.room_name;
                                roomTypeName.innerHTML = room.room_type_info.type_name;
                                guest.innerHTML = room.room_type_info.guest_number;
                                price.innerHTML = new Intl.NumberFormat('vn-VN').format(room.room_type_info.price);
                                checkin.innerHTML = `<div class="input-group date datepicker checkin">
                                                    <input type="text" class="form-control form-control-sm"
                                                       >
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>`;
                                checkout.innerHTML = `<div class="input-group date datepicker checkout">
                                                    <input type="text" class="form-control form-control-sm"
                                                       >
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>`;
                                deleteRow.innerHTML = `<button class="btn btn-danger btn-sm" type="button" onclick="deleteElement('${rowId}','${inputId}')"><i class="fas fa-times"></i></button>`;

                                roomName.setAttribute("class",'border fs-6 fw-normal text-center');
                                roomTypeName.setAttribute("class",'border fs-6 fw-normal text-center');
                                guest.setAttribute("class",'border fs-6 fw-normal text-center');
                                price.setAttribute("class",'border fs-6 fw-normal text-center');
                                checkin.setAttribute("class",'border fs-6 fw-normal text-center');
                                checkout.setAttribute("class",'border fs-6 fw-normal text-center');
                                deleteRow.setAttribute("class",'border fs-6 fw-normal text-center');
                                ++rowOrder;
                            }

                        }
                    })
                }


            })
        }

        function clickAddRoom(preIdStr,id){
            var addRoomId = preIdStr + id.toString();
            console.log(document.getElementById('addRoom1'))
            var modalId = 'addRoom' + id;
        }


        function getPresentTime(inputId){
            var dateTime = new Date();
            var date = dateTime.getDate().toString();
            var month = (dateTime.getMonth()+1).toString();
            var year = dateTime.getFullYear().toString();
            var dateValue = date + '//' + month + '//' + year;
            document.getElementById(inputId).setAttribute('value', dateValue)
        }

        function getRoomRentAmount(checkinId, checkoutId, roomPrice, roomTotal, total, inputServiceTotal){
            var checkin = document.getElementById(checkinId).value
            var checkoutTime

            checkoutTime = new Date()
            var [checkinDate, checkinMonth, checkinYear] = checkin.split('/');
            var checkinTime = new Date(checkinYear, checkinMonth -1, checkinDate)
            var timeDiff = checkoutTime - checkinTime;
            var dateDiff = Math.floor(timeDiff/(24*3600*1000))
            var hourDiff = Math.floor((timeDiff-(dateDiff*24*3600*1000))/(3600*1000))
            var price = document.getElementById(roomPrice).value
            var totalRoom = dateDiff*price
            document.getElementById(roomTotal).innerHTML = new Intl.NumberFormat('vn-VN').format(totalRoom);
            var totalService = document.getElementById(inputServiceTotal).value
            document.getElementById(total).innerHTML = new Intl.NumberFormat('vn-VN').format(totalRoom + totalService);
        }
        // var date1 = '27/12/2021';
        // var [day, month, year ] = date1.split('/');

        // console.log(new Date(year, month-1, day));




        $(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                clearBtn: true,
                language: "vi",
                autoclose: true,
                todayHighlight: true,
                toggleActive: true,
                immediateUpdates:true,
                startDate: date,
                weekStart:1

            });

            $('.datepicker').datepicker("setDate", new Date());
        });

        function defaultValueDatePicker(){
            var date = new Date();
            date.setDate(date.getDate());
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                clearBtn: true,
                language: "vi",
                autoclose: true,
                todayHighlight: true,
                toggleActive: true,
                immediateUpdates:true,
                startDate: date,
                weekStart:1
            });
            // $('.datepicker').datepicker("setDate", new Date());

        }
        //Lỗi: addRoom, checkin input

        function onChangeDate(event,roomId,actionStr, checkinId, checkoutId) {
            // var dateTimeSelect = event.target.value;
            // var dateTimeArr = dateTimeSelect.split('/');
            // var date = dateTimeArr[0];
            // var month = dateTimeArr[1];
            // var year = dateTimeArr[2];
            // var dateSelect = new Date(year + '-' + month + '-' + date);
            // var dateNow = new Date().setHours(0,0,0,0);

            var roomsObj = {!! json_encode($rooms->toArray()) !!};
            var rooms = Object.values(roomsObj);

            var checkin, checkout
            if(actionStr == 'checkout'){
                checkin = $('#' + checkinId).datepicker('getDate');
                checkout = $('#' + checkoutId).datepicker('getDate');
                // console.log(new Date(checkin))
                if(checkout <= checkin){
                    clickAlert('Lỗi','Ngày checkout phải lớn hơn ngày checkin!!','red','error')
                    // $('.datepicker').datepicker("setDate", new Date());

                }
            }
            // else if(actionStr == 'checkin'){
            //     $('.checkin').datepicker("setDate", new Date(checkin));

            // }
            rooms.forEach(function(room){
                if(room.room_id == roomId){
                    var bookings = room.bookings;
                    bookings.forEach(function(booking){
                        // console.log(booking)
                        //.replace(/-/g,"/")
                        var roomCheckinNumber = new Date(booking.checkin);
                        var roomCheckoutNumber = new Date(booking.checkout);
                        var roomCheckin = new Date(roomCheckinNumber)
                        var roomCheckout = new Date(roomCheckoutNumber)
                        // console.log(typeof(checkin))
                        // console.log(checkin >= roomCheckin && checkin <= roomCheckout)
                        if((checkin >= roomCheckin && checkin <= roomCheckout) || (checkout >= roomCheckin && checkout <= roomCheckout) || (checkin <= roomCheckin && checkout >= roomCheckout)){
                            var roomCheckinStr = roomCheckin.getDate() + '/' + (roomCheckin.getMonth() + 1) + '/' + roomCheckin.getFullYear();
                            var roomCheckoutStr = roomCheckout.getDate() + '/' + (roomCheckout.getMonth() + 1) + '/' + roomCheckout.getFullYear();
                            clickAlert('Ngày đã được đặt',`Phòng này đã được đặt từ ${roomCheckinStr} đến ${roomCheckoutStr}, vui lòng chọn ngày khác`,'red','error')
                            // $('.datepicker').datepicker("setDate", new Date());
                        }else{
                            $('.checkin').datepicker("setDate", new Date(checkin));
                            $('.checkout').datepicker("setDate", new Date(checkout));

                        }
                    })
                }

            })



            // console.log(checkin)
            // console.log(checkout)

        }

        function onChangeAddRoomDate(event,roomId,actionStr, checkinId, checkoutId, rowPreId) {
            var roomsObj = {!! json_encode($rooms->toArray()) !!};
            var rooms = Object.values(roomsObj);

            var checkin, checkout
            if(actionStr == 'checkout'){
                checkin = $('#' + checkinId).datepicker('getDate');
                checkout = $('#' + checkoutId).datepicker('getDate');
                // console.log(new Date(checkin))
                if(checkout <= checkin){
                    clickAlert('Lỗi','Ngày checkout phải lớn hơn ngày checkin!!','red','error')
                    $('.datepicker').datepicker("setDate", new Date());

                }else{
                    rooms.forEach(function(room){
                        if(room.bookings.length > 0){
                            var bookings = room.bookings;
                            // console.log(bookings)
                            for(var i = 0; i< room.bookings.length;i++){
                                var roomCheckinNumber = new Date(bookings[i].checkin).setHours(0,0,0,0);
                                var roomCheckoutNumber = new Date(bookings[i].checkout).setHours(0,0,0,0);
                                var roomCheckin = new Date(roomCheckinNumber);
                                // console.log(checkin)
                                var roomCheckout = new Date(roomCheckoutNumber)
                                // console.log(checkin-roomCheckout)
                                if((checkin >= roomCheckin && checkin <= roomCheckout) || (checkout >= roomCheckin && checkout <= roomCheckout) || (checkin <= roomCheckin && checkout >= roomCheckout)){
                                    console.log(room.room_name,'none')
                                    document.getElementById(rowPreId + room.room_id).setAttribute('style','display:none');
                                    continue;
                                }else{
                                    console.log(document.getElementById(rowPreId + room.room_id))
                                    document.getElementById(rowPreId + room.room_id).removeAttribute('style')
                                }


                            }
                        }
                    })

                }


            }

        }
        // let dateTime = new Date();
        // let date = dateTime.getDate().toString();
        // let month = (dateTime.getMonth()+1).toString();
        // let year = dateTime.getFullYear().toString();
        // let dateValue = date + '/' + month + '/' + year;
        // let divDates = document.querySelectorAll('.datepicker');
        // divDates.forEach(function(dateDiv){
        //     dateDiv.querySelector('input').setAttribute('value', dateValue)
        // });

        function clickAlert(title, text, background, icon){
            Swal.fire({
            title: title,
            toast:true,
            showConfirmButton:false,
            text: text,
            // type: 'error',
            position:'top',
            showCloseButton: true,
            background:background,
            icon:icon,
            timer:10000,
        })
        }


</script>



@endsection
