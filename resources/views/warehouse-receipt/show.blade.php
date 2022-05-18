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
                <a class="btn btn-sm btn-primary" href="{{ route('warehouse-receipt.index') }}">Danh sách hóa đơn</a>
            </div>
            <div class="col d-flex justify-content-end ">
                <a href="{{ route('warehouse-receipt.edit', $warehouseReceipt->warehouse_receipt_id) }}" class="btn btn-info btn-sm mr-2">Chỉnh sửa <i
                        class="fas fa-edit"></i></a>
                <a id="delete-link" href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                <form class="d-none" action="{{ route('warehouse-receipt.destroy', $warehouseReceipt->warehouse_receipt_id) }}" method="POST">
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
                                <label for="date" class="col-form-label">Tên hoá đơn</label>
                            </th>
                            <td>
                                {{ $warehouseReceipt->warehouse_receipt_name }}
                                <input type="hidden" name="customer" value="{{ $warehouseReceipt->warehouse_receipt_name }}">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Loại hóa đơn</label>
                            </th>
                            <td>
                                {{ $warehouseReceipt->warehouse_receipt_type_name }}
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
                                <label for="date" class="col-form-label">Ngày lập hóa đơn</label>
                            </th>
                            <td>
                                {{ date('d/m/Y H:i',strtotime($warehouseReceipt->receipt_created_at)) }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Nhân viên</label>
                            </th>
                            <td>
                                <a class="btn btn-success" href="{{ route('user.show', $warehouseReceipt->user_id) }}">{{ $warehouseReceipt->user_info->user_name }}</a>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="date" class="col-form-label">Ghi chú</label>
                            </th>
                            <td>
                                {{ $warehouseReceipt->note }}
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

            </div>

            <div class="row  my-4">
                <div class="col-6">
                    <h4 class="pb-3">Danh sách sản phẩm</h4>
                    <div></div>
                </div>

            </div>
            <div class="row">
                <table class="datatable cell-border text-center" id="list-service">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá(VND)</th>
                            <th>Thành tiền</th>

                        </tr>
                    </thead>
                    <tbody id="">
                        @php
                            $total = 0
                        @endphp
                        @foreach ($warehouseReceipt->products as $product)

                        <tr>
                            <input type="hidden" name="products[]" value="{{ $product->product_id }}">
                            <input type="hidden" name="quantities[]" value="{{ $product->quantity }}">

                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_type_name }}
                            </td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{
                                number_format($product->import_price) }}</td>


                            <td>{{ number_format($product->import_price * $product->quantity) }}</td>

                        </tr>
                        @php
                            $total += $product->import_price * $product->quantity
                        @endphp
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Tổng tiền</th>
                            <th>{{ number_format($total) }}</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <input type="hidden" id="billTotal" value="">





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







</script>

@endsection
