@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách hóa đơn kho hàng</h1>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row mb-2 ">

            <div class="col-md-4">
                <a class="btn btn-primary btn-sm" href="{{ route('warehouse-receipt.create') }}" >Thêm
                    mới</a>
            </div>

        </div>
    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="datatable display cell-border text-center">
            <thead>
                <tr>
                    <th>Tên hóa đơn</th>
                    <th>Loại hóa đơn</th>
                    <th>Nhân viên</th>
                    <th>Ngày lập hóa đơn</th>
                    <th>Tổng số tiền(VND)</th>


                    <th></th>
                </tr>
            </thead>
            <tbody class="table-light text-center">

                @foreach ($warehouseReceipts as $warehouseReceipt)
                <tr class="">
                    <td data-sort="{{ $warehouseReceipt->warehouse_receipt_id }}">{{ $warehouseReceipt->warehouse_receipt_name }}</td>
                    <td>{{ $warehouseReceipt->warehouse_receipt_type_name }}</td>
                    <td>{{ $warehouseReceipt->user_info->user_name }}</td>
                    <td>{{ date('d/m/Y H:i:s',strtotime($warehouseReceipt->receipt_created_at)) }}</td>
                    <td>{{ number_format($warehouseReceipt->total) }}</td>

                    <td>
                        <a class="btn btn-success btn-sm"
                            href="{{ route('warehouse-receipt.show', $warehouseReceipt->warehouse_receipt_id) }}">Chi
                            tiết
                            <i class="fas fa-info"></i></a>
                    </td>
                    {{-- <th class="fs-6 fw-normal border">
                        <a class="btn btn-info btn-sm"
                            href="{{ route('warehouse-receipt.edit', $warehouseReceipt->warehouse_receipt_id) }}">Chỉnh
                            sửa
                            <i class="fas fa-edit"></i></a>
                    </th>

                    <th class="fs-6 fw-normal border">

                        <form action="{{ route('warehouse-receipt.destroy',$warehouseReceipt->warehouse_receipt_id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $warehouseReceipt->warehouse_receipt_id }}"
                                class="btn btn-danger btn-sm" type="submit">Xóa
                                <i class="far fa-trash-alt"></i></button>
                        </form>
                    </th> --}}
                </tr>

                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>



    {{-- Modal add --}}
    <div class="modal fade" id="add" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">
            <form action="{{ route('warehouse-receipt.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm hóa đơn
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên hóa đơn</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="name" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Nhân viên</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="email" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Loại hóa đơn</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="phone" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Sản phẩm</label>
                                </div>
                                <div class="col-sm-6">


                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Thêm mới</button>

                        <button type="button" class="btn btn-light" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Quay
                            lại</button>

                    </div>
                </div>
            </form>
        </div>
    </div>



</section>




@endsection

@section('script')

<script type="text/javascript">

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
                // toggleActive: true,
                immediateUpdates:true,
                startDate: date,
                weekStart:1

            });

            $('.datepicker').datepicker("setDate", new Date());
        });
</script>

@endsection
