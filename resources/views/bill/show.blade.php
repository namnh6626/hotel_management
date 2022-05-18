@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thông tin hóa đơn</h1>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-primary" href="{{ route('bill.index') }}">Danh sách hóa đơn</a>
            </div>
            <div class="col d-flex justify-content-end ">
                <a href="{{ route('bill.edit', $bill->bill_id) }}" class="btn btn-info btn-sm mr-2">Chỉnh sửa <i
                        class="fas fa-edit"></i></a>
                <a id="delete-link" href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                <form class="d-none" action="{{ route('bill.destroy', $bill->bill_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="delete" type="submit"></button>
                </form>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">

        <div class="row py-4">

            <div class="container-fluid">

                <table class="row-border cell-border hover" id="bill-info">
                    <thead>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>

                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Tên khách hàng</label>
                            </th>
                            <td>
                                {{ $bill->cus_info->cus_name }}
                                <input type="hidden" name="customer" value="{{ $bill->cus_id }}">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Số điện thoại</label>
                            </th>
                            <td>
                                {{ $bill->cus_info->phone }}
                            </td>
                        </tr>
                        {{-- <div classs="row form-group my-4" id="form">
                            <div class="row g-4 align-items-center">

                                <div class="col-md-4">
                                    <label for="date" class="col-form-label">Tìm khách hàng</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" id="search" class="form-control form-control-sm" style="width: 228px;
                                                        margin-left: -2.5px; height:31px"
                                        placeholder="Nhập SĐT hoặc CCCD" />
                                    <input type="hidden" id="customerId">
                                </div>

                            </div>
                        </div> --}}
                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Nhân viên</label>
                            </th>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('user.show', $bill->user_id) }}">{{
                                    $bill->user_info->user_name }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Ghi chú</label>
                            </th>
                            <td>
                                {{ $bill->note }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="total" class="col-form-label">Tổng số tiền</label>
                            </th>
                            <td>
                                {{ number_format($bill->roomsTotal + $servicesTotal) }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Trả trước</label>
                            </th>
                            <td>
                                {{ number_format($bill->deposit) }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Trạng thái</label>
                            </th>
                            <td>
                                @if ($bill->is_paid)
                                {{ 'Đã thanh toán' }}
                                @else
                                {{ 'Chưa thanh toán' }}
                                @endif
                            </td>

                        </tr>

                    </tbody>
                </table>


                {{-- <div class="row my-4">
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
                </div> --}}

                <div class="row  my-4">
                    <div class="col-6">
                        <h4 class="pb-3">Danh sách phòng</h4>
                        <div></div>
                    </div>

                </div>
                <div class="" id="listRooms"></div>
                <table class="order-column row-border hover cell-border text-center" id="list-room">
                    <thead>
                        <tr>
                            <th>Tên phòng</th>
                            <th>Loại phòng</th>
                            <th>Giá(VND)</th>
                            <th>Checkin</th>
                            <th>Checkout</th>
                            <th>Tiền phòng</th>
                            <th>Phụ thu checkin sớm</th>
                            <th>Phụ thu checkout muộn</th>

                            <th>Thành tiền</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        @foreach ($bill->rooms as $room)
                        <tr>
                            <input type="hidden" name="rooms[]" value="{{ $room->room_id }}">
                            <td>{{ $room->room_name }}</td>
                            <td>{{ $room->type_name }}</td>
                            <td>{{ number_format($room->price) }}</td>
                            <td>
                                {{ date(" d/m/Y H:i", strtotime($room->date_checkin)); }}

                            </td>
                            <td>
                                {{ date(" d/m/Y H:i", strtotime($room->date_checkout)); }}
                            </td>
                            <td>
                                {{ number_format($room->roomRentAmount) }}
                            </td>
                            <td>
                                {{ number_format($room->surchargeCheckinAmount) }}
                            </td>
                            <td>
                                {{ number_format($room->surchargeCheckoutAmount) }}
                            </td>
                            <td>{{ number_format($room->total) }}</td>

                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot class="border fs-6 fw-normal text-center">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Tổng tiền phòng</th>
                            <th>{{ number_format($bill->roomsTotal) }}</th>

                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="row  my-4">
                <div class="col-6">
                    <h4 class="pb-3">Danh sách dịch vụ</h4>
                    <div></div>
                </div>

            </div>
            <div class="row">
                <table class="row-border cell-border hover" id="list-service">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Tên dịch vụ</th>
                            <th>Loại dịch vụ</th>
                            <th>Số lượng</th>
                            <th>Giá(VND)</th>
                            <th>Phòng sử dụng</th>
                            <th>Thành tiền</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        <?php $servicesTotal = 0 ?>
                        @foreach ($bill->services as $service)
                        <?php
                                    $serviceIntoMoney = $service->service_price * $service->quantity;
                                    $servicesTotal += $serviceIntoMoney;
                                    ?>
                        <tr>
                            <input type="hidden" name="services[]" value="{{ $service->service_id }}">
                            <input type="hidden" name="quantities[]" value="{{ $service->quantity }}">

                            <th class="border fs-6 fw-normal text-center">{{ $service->service_name }}</th>
                            <th class="border fs-6 fw-normal text-center">{{ $service->service_type_name }}
                            </th>
                            <th class="border fs-6 fw-normal text-center">{{ $service->quantity }}</th>
                            <th class="border fs-6 fw-normal text-center">{{
                                number_format($service->service_price) }}</th>
                            <th class="border fs-6 fw-normal text-center">{{ $service->room_name }}</th>


                            <th class="border fs-6 fw-normal text-center">{{
                                number_format($serviceIntoMoney) }}</th>

                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th class=""></th>
                            <th class=""></th>
                            <th class=""></th>
                            <th class=""></th>
                            <th class=" text-center">Tổng tiền dịch vụ</th>
                            <th class=" text-center">{{ number_format($servicesTotal)
                                }}</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <input type="hidden" id="billTotal" value="{{ $servicesTotal + $roomsTotal }}">





    </div>
    </div>


</section>

@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        var billTable = $('#bill-info').DataTable({
            "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
            },
            ordering:false,
            searching:false,
            info:false,
            "drawCallback": function( settings ) {
                $("#bill-info thead").remove();
            },
            paging:false,

        });
    });

    $(document).ready(function(){
        var listServiceTable = $('#list-service').DataTable({
            "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
            },
        });
    });


    $(document).ready(function(){
        var listRoomTable = $('#list-room').DataTable({
            "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
            },
        });
    });


</script>

@endsection
