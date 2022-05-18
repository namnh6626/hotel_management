@extends('main')


@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sơ đồ phòng</h1>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">

        <a href="{{ route('booking.today-checkin') }}" class="btn btn-info btn-sm text-white"><i class="fas fa-list"></i> Danh sách đặt phòng hôm nay</a>
        <a href="{{ route('booking.create') }}" class="btn btn-primary btn-sm" style="background-color: #800080"><i class="fas fa-bed"></i> Đặt phòng</a>
        <a href="{{ route('bill.create') }}" class="btn btn-success btn-sm"><i class="fas fa-arrow-down"></i> Nhận phòng</a>
        <a href="{{ route('room.room-rented') }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-right"></i> Trả phòng</a>

        {{-- <a href="{{ route('bill.pay-bill') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Trả phòng</a> --}}


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
                                    <div class=" col-8 border">
                                        @if ($room->cus_info)
                                            {{ $room->cus_info->cus_name }}
                                        @endif
                                    </div>
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
                                    <div class="col-lg-4 col-6 border">Thời gian nhận phòng:</div>
                                    <div class="col-8 border">
                                        @if ($room->date_checkin)
                                            {{date("d/m/Y H:i", strtotime($room->date_checkin)); }}
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-6 border">Trạng thái phòng:</div>
                                    <div class="col-8 border">{{ $room->status_name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($room->status_id == $isRentedStatus)
                        <div class="modal-footer">
                            {{-- <a class="btn btn-primary btn-sm " data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" onclick="bookRoom({{ $room->room_id }},'addRoom'); defaultValueDatePicker();"><i
                                    class="fas fa-bed"></i> Đặt
                                phòng</a>
                            <a href="" class="btn btn-info btn-sm text-white"
                                data-bs-target="#tranferRoom{{ $room->room_id }}" data-bs-toggle="modal"><i
                                    class="fas fa-random"></i> Chuyển phòng</a> --}}
                            {{-- <a href="{{ route('room.room-rented') }}" class="btn btn-danger btn-sm" ><i
                                    class="far fa-arrow-alt-circle-right"></i> Trả
                                phòng</a> --}}
                            @if ($room->bill_info->bill_id)
                            <a href="{{ route('room.add-service', $room->room_id) }}" class="btn btn-info btn-sm mr-4" style="color: white"><i
                                    class="fas fa-coffee" style="color: white"></i> Dịch vụ</a>

                            @endif
                        </div>
                        @elseif ($room->status_id == $isEmptyStatus)
                        <div class="modal-footer">
                            {{-- <a class="btn btn-primary btn-sm " data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" onclick="bookRoom({{ $room->room_id }},'addRoom');defaultValueDatePicker()"><i
                                    class="fas fa-bed"></i> Đặt
                                phòng</a>
                            <a onclick="bookRoom({{ $room->room_id }},'addRoomCheckin');defaultValueDatePicker()" href=""
                                class="btn btn-info btn-sm text-white" data-bs-target="#checkin{{ $room->room_id }}"
                                data-bs-toggle="modal"><i class="far fa-arrow-alt-circle-down"></i> Nhận phòng</a> --}}


                        </div>
                        @elseif ($room->status_id == $isBookedStatus)
                        <div class="modal-footer">
                            {{-- <a class="btn btn-primary btn-sm " data-bs-target="#bookRoom{{ $room->room_id }}"
                                data-bs-toggle="modal" onclick="bookRoom({{ $room->room_id }},'addRoom');defaultValueDatePicker()"><i
                                    class="fas fa-bed"></i> Đặt
                                phòng</a>
                            <a onclick="bookRoom({{ $room->room_id }},'addRoomCheckin');defaultValueDatePicker()" href=""
                                class="btn btn-info btn-sm text-white" data-bs-target="#checkin{{ $room->room_id }}"
                                data-bs-toggle="modal"><i class="far fa-arrow-alt-circle-down"></i> Nhận phòng</a> --}}

                        </div>
                        @elseif ($room->status_id == $isDirtyStatus)
                        <div class="modal-footer">
                            <a href="{{ route('room.update-status', $room->room_id) }}" class="btn btn-success btn-sm mr-4" style="color: white; float: right;">
                                <i class="fas fa-check"></i> Sẵn sàng
                                        </a>

                        </div>
                        @endif

                    </div>
                </div>
            </div>


            @endforeach


        </div>
    </div>
</section>

@endsection
