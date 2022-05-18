@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách đặt phòng</h1>
            </div>

        </div>
    </div>
    {{-- <div class="container-fluid">
        <form action="{{ route('customer.search') }}" method="GET">
            <div class="row mb-2 ">
                <div class="col-md-4">
                    <input class="form-control form-control-sm" name="search" type="text" placeholder="Search">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-sm" type="submit">Tìm kiếm</button>
                </div>

            </div>
            @csrf
        </form>
    </div> --}}

</div>

<section class="content">
    <div class="container-fluid">
        {{-- <div class="row py-3">
            <div class="row col-4 px-0 mx-0">

                <div class="col-md-4">
                    <label for="date" class="col-form-label">Từ ngày</label>
                </div>
                <div class="col-md-6" id="checkin-group">
                        <div class="row">
                            <div class="input-group date datepicker" id="start">
                                <input type="text" class="form-control form-control-sm">
                                <span class="input-group-append">
                                    <span class="input-group-text bg-white">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                            </div>

                        </div>

                </div>

            </div>


            <div class="row col-4 px-0 mx-0">
                <div class="col-md-4">
                    <label for="date" class="col-form-label">Đến ngày</label>
                </div>
                <div class="col-md-6" id="checkout-group">
                        <div class="row">
                            <div class="input-group date datepicker" id="finish">
                                <input type="text" class="form-control form-control-sm"> <span
                                    class="input-group-append">
                                    <span class="input-group-text bg-white">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                            </div>

                        </div>

                </div>

            </div>
            <div class="row col-4">
                <div class="col">
                    <button class="btn btn-primary btn-sm" style="height: 100%" id="find-booking">Tìm kiếm</button>

                </div>
                <div class="col">
                    <button class="btn btn-info btn-sm" style="height: 100%" id="all-booking">Hiển thị tất cả</button>
                </div>
            </div>
        </div> --}}
        <table class="display cell-border dt-center" id="list-booking">
            <thead >
                <tr>
                    <th>Thời gian checkin</th>
                    <th>Thời gian checkout</th>
                    <th>Tên phòng</th>
                    <th>Loại phòng</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Nhân viên</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-light text-center">

                @foreach ($bookings as $booking)

                @foreach ($booking->rooms as $bookingRoom)

                <tr class="">
                    <td data-sort="{{ $bookingRoom->checkin }}">{{ date_format(date_create($bookingRoom->checkin), 'd-m-Y H:i:s') }}</td>
                    <td data-sort="{{ $bookingRoom->checkout }}">{{ date_format(date_create($bookingRoom->checkout), 'd-m-Y H:i:s') }}</td>
                    <td>{{ $bookingRoom->room_name}}</td>
                    <td>{{ $bookingRoom->type_name }}</td>
                    <td>{{ $booking->cus_name }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->user_name }}</td>


                    <td>
                        <a class="btn btn-info btn-sm text-nowrap" href="{{ route('booking.show', $booking->booking_id) }}">Chi tiết
                            <i class="fas fa-info"></i></a>
                    </td>
                    {{-- <td>
                        <a class="btn btn-info btn-sm" href>Chỉnh sửa
                            <i class="fas fa-user-edit"></i></a>
                    </td>

                    <td>

                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $booking->booking_id }}" class="btn btn-danger btn-sm delete" type="submit">Xóa
                                <i class="far fa-trash-alt"></i></button>
                        </form>
                    </td> --}}
                </tr>

                @endforeach


                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>


@endsection

@section('script')

<script type="text/javascript">

    $(document).ready(function() {

        var table = $('#list-booking').DataTable({
            "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
            },
            responsive: true
        });

        $('#list-booking tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );
        $('#find-booking').on('click', function (e) {
            var startStr = $('#start > input').val();
            var finishStr = $('#finish > input').val();
            var startArr = startStr.split('/')
            var finishArr = finishStr.split('/')


            var start = startArr[2]+ '-' + (startArr[1]).toString() + '-' + startArr[0];
            var finish = finishArr[2] + '-' + (finishArr[1]).toString() + '-' + finishArr[0];
        // console.log(start);
            getBookings(start, finish);
        });



    });




</script>

@endsection
