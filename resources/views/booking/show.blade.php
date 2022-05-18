@extends('main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thông tin đặt phòng</h1>
                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col"> <a href="{{ route('booking.index') }}" class="btn btn-primary btn-sm">Danh sách
                        đặt phòng</a></div>
                <div class="col">
                </div>
                <div class="col d-flex justify-content-end">
                    <a class="btn btn-info btn-sm mr-2" href="{{ route('booking.edit', $booking->booking_id) }}">Chỉnh sửa
                        <i class="fas fa-edit"></i></a>

                    @if ($booking->is_cancel == 0)
                    <a id="cancel-link" href="#" class="btn btn-warning text-white btn-sm mr-2">Hủy đặt phòng <i class="fa-solid fa-rotate-left"></i></a>
                    <form style="display: none" action="{{ route('booking.cancel', $booking->booking_id) }}"
                        method="POST">
                        @csrf
                        <button id="cancel" class="btn btn-danger btn-sm delete" type="submit"></button>
                    </form>
                    @endif


                    <a id="delete-link" href="#" class="btn btn-danger btn-sm delete"><i class="far fa-trash-alt"></i></a>
                    <form style="display: none" action="{{ route('booking.destroy', $booking->booking_id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="delete" class="btn btn-danger btn-sm delete" type="submit"></button>
                    </form>
                </div>

            </div>



        </div>

    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row py-4">
                <div class="col-4">
                    <label for="">Tình trạng đặt phòng</label>
                </div>
                <div class="col-8">
                    <strong>
                        @if ($booking->is_checkin)
                            {{ 'Đã nhận phòng' }}
                        @else
                            {{ 'Chưa nhận phòng' }}
                        @endif

                    </strong>
                </div>

            </div>
            <table class="display cell-border" id="list-booking">
                <thead class="table-light text-center">
                    <tr>
                        <th>Tên phòng</th>
                        <th>Trạng thái</th>
                        <th>Loại phòng</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Nhân viên</th>
                        <th>Thời gian checkin</th>
                        <th>Thời gian checkout</th>
                    </tr>
                </thead>
                <tbody class="table-light text-center">
                    @foreach ($booking->rooms as $bookingRoom)
                        <tr class="">
                            <td>{{ $bookingRoom->room_name }}</td>
                            <td>{{ $bookingRoom->status_name }}</td>
                            <td>{{ $bookingRoom->type_name }}</td>
                            <td>{{ $booking->cus_info->cus_name }}</td>
                            <td>{{ $booking->cus_info->phone }}</td>
                            <td>{{ $booking->user_info->user_name }}</td>
                            <td data-sort="{{ $bookingRoom->checkin }}">
                                {{                                 date_format(date_create($bookingRoom->checkin), 'd-m-Y H:i:s') }}
                            </td>
                            <td data-sort="{{ $bookingRoom->checkout }}">
                                {{                                 date_format(date_create($bookingRoom->checkout), 'd-m-Y H:i:s') }}
                            </td>

                        </tr>
                    @endforeach


                </tbody>

            </table>

            @if (!$booking->is_checkin)
                <div class="row py-3">
                    <div class="col"></div>
                    <div class="col d-flex">
                        <a href="{{ route('booking.checkin', $booking->booking_id) }}" style="margin: 0 auto"
                            class="btn btn-primary ">Nhận phòng</a>
                    </div>
                    <div class="col"></div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#list-booking').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
                },
                responsive: true,
                paging: false,
                searching: false,
                // ordering:false
            });

            $('#list-booking tbody').on('click', 'tr', function() {
                $(this).toggleClass('selected');
            });




        });
    </script>
@endsection
