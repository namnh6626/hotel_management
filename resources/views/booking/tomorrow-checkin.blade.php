@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách đặt phòng</h1>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-primary" href="{{ route('booking.create') }}">Đặt phòng</a>
            </div>

        </div>
    </div>



</div>

<section class="content">
    <div class="container-fluid">
        <table class="display cell-border dt-center" id="list-booking">
            <thead >
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Tên nhân viên</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-light text-center">

                @foreach ($bookings as $booking)
                <tr class="">
                    <td>{{ $booking->cus_name }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->cus_email}}</td>
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
