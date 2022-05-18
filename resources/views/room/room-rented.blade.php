@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách phòng đang thuê</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-primary" href="{{ route('room.diagram') }}">Sơ đồ phòng</a>
            </div>

        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row py-4 px-2">
            <table class="datatable display text-center cell-border">
                <thead>
                    <tr>
                        <th>Tên phòng</th>
                        <th>Tên khách hàng</th>
                        <th>Loại phòng</th>
                        <th>Ngày checkin</th>
                        <th>Ngày checkout</th>
                        <th>Thanh toán</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentedRooms as $room)
                        <tr>
                            <td>{{ $room->room_name }}</td>
                            <td>{{ $room->cus_info->cus_name }}</td>
                            <td>{{ $room->room_type_info->type_name }}</td>
                            <td>{{date("d/m/Y", strtotime($room->date_checkin)); }}</td>
                            <td>{{date("d/m/Y", strtotime($room->date_checkout)); }}</td>
                            <td><a href="{{ route('bill.show',$room->bill_info->bill_id) }}" class="btn btn-primary btn-sm">Thanh toán</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</section>


@endsection
