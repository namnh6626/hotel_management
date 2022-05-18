@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Trả phòng</h1>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-primary" href="{{ route('bill.index') }}">Danh sách hóa đơn</a>
            </div>
            <div class="col d-flex justify-content-end ">

                <a href="{{ route('bill.edit', $bill->bill_id) }}" class="btn btn-info btn-sm mr-2">Chỉnh sửa <i
                        class="fas fa-edit"></i></a>
            </div>
        </div>

    </div>
</div>
<section class="content">
    <div class="container-fluid">



        <form action="{{ route('bill.success-bill',$bill->bill_id) }}" method="POST">
            @method('put')
            @csrf


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
                                    <div id="customerName">

                                        {{ $bill->cus_info->cus_name }}
                                    </div>
                                    <input type="hidden" id="customerId" name="customer" value="{{ $bill->cus_id }}">
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Số điện thoại</label>
                                </th>
                                <td id="customerPhone">
                                    {{ $bill->cus_info->phone }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Ghi chú</label>
                                </th>
                                <td>
                                    <input class="form-control" type="text" name="note" value="{{ $bill->note }}">
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



                        </tbody>
                    </table>

                    <div class="row  my-4">
                        <div class="col-6">
                            <strong class="pb-3">Danh sách phòng</strong>
                            <div></div>
                        </div>

                    </div>
                    <div class="" id="listRooms"></div>
                    <div class="row">
                        <table class="display cell-border datatable text-center">
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
                                        {{date("d/m/Y H:i", strtotime($room->date_checkin)) }}
                                    </td>
                                    <td>
                                        {{date("d/m/Y H:i", strtotime($room->date_checkout)) }}

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
                            <tfoot>
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
                            <strong class="pb-3">Danh sách dịch vụ</strong>
                            <div></div>
                        </div>

                    </div>
                    <div class="row">
                        <table class="display datatable text-center cell-border">
                            <thead>
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

                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->service_type_name }}</td>
                                    <td>{{ $service->quantity }}</td>
                                    <td>{{ number_format($service->service_price) }}</td>
                                    <td>{{ $service->room_name }}</td>


                                    <td>{{ number_format($serviceIntoMoney) }}</td>

                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Tổng tiền dịch vụ</th>
                                    <th>{{ number_format($servicesTotal) }}</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>


            <input type="hidden" id="billTotal" value="{{ $servicesTotal + $bill->roomsTotal }}">

            <div classs="row form-group my-4">
                <div class="row g-3 align-items-center">

                    <div class="col-md-4">
                        <label for="date" class="col-form-label">Tổng số tiền</label>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control my-2" type="text"
                            value="{{ number_format($servicesTotal + $bill->roomsTotal - $bill->deposit) }} VND" readonly>
                    </div>

                </div>
            </div>

            <div classs="row form-group my-4">
                <div class="row g-3 align-items-center">

                    <div class="col-md-4">
                        <label for="date" class="col-form-label">Khách đưa</label>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control my-2" type="text" min="0" placeholder="Nhập số tiền"
                            id="customer_pay"
                            onkeyup="repayMoney('billTotal','customer_pay','repay');formatToMoney('customer_pay')" />
                    </div>

                </div>
            </div>

            <div classs="row form-group my-4">
                <div class="row g-3 align-items-center">

                    <div class="col-md-4">
                        <label for="date" class="col-form-label">Trả lại</label>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control my-2" type="text" value="0" min="0" placeholder="Nhập số tiền"
                            id="repay" readonly>
                    </div>

                </div>
            </div>

            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Trả phòng</button>
                </div>
                <div class="col"></div>
            </div>


        </form>




    </div>


</section>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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








</script>

@endsection
