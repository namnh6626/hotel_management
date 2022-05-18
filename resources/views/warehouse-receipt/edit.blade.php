@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cập nhật hóa đơn kho hàng</h1>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-primary" href="{{ route('warehouse-receipt.index') }}">Danh sách hóa đơn</a>
            </div>

        </div>


    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('warehouse-receipt.update', $warehouseReceipt->warehouse_receipt_id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row py-4">

                <div class="container-fluid">

                    <table style="border-top: 1px solid black" class="display cell-border" id="bill-info">
                        <thead >
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody >
                            <tr >
                                <th>
                                    <label for="date" class="col-form-label">Nhân viên</label>
                                </th>
                                <td>
                                    {{ $warehouseReceipt->user_info->user_name }}
                                </td>
                            </tr>
                            <tr >
                                <th>
                                    <label for="date" class="col-form-label">Loại hóa đơn</label>
                                </th>
                                <td>
                                        {{ $warehouseReceipt->warehouse_receipt_type_name }}
                                        {{-- @foreach ($warehouseReceiptTypes as $type)
                                        @if ($type->warehouse_receipt_type_id == $warehouseReceipt->warehouse_receipt_type_id)
                                            @continue
                                        @endif
                                            <option value="{{ $type->warehouse_receipt_type_id }}">{{ $type->warehouse_receipt_type_name }}</option>
                                        @endforeach --}}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Ghi chú</label>
                                </th>
                                <td >
                                    <input class="form-control" type="text" name="note" value="{{ $warehouseReceipt->note }}" placeholder="Ghi chú">
                                </td>
                            </tr>

                        </tbody>
                    </table>




                </div>





            </div>
            <div class="row  my-4">
                <div class="col-6">
                    <h4 class="pb-3">Danh sách sản phẩm</h4>
                    <div></div>
                </div>
                <div class="col-6">
                    <a class="btn btn-sm btn-primary float-end" data-bs-target="#addService"
                        data-bs-toggle="modal">Thêm sản phẩm</a>
                </div>
            </div>
            <div class="row">
                <table class="display datatable text-center cell-border"
                    id="list-service">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Nhà cung cấp</th>
                            <th>Số lượng</th>
                            <th>Giá(VND)</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody id="form-service-body">
                        @foreach ($warehouseReceipt->products as $product)
                            <tr>
                                <td>{{ $product->product_name }} <input type="hidden" name="products[]" value="{{ $product->product_id }}" ></td>
                                <td>{{ $product->product_type_name }}</td>
                                <td>{{ $product->supplier_name }}</td>
                                <td><input class="form-control" name="quantities[]" type="number" min="1" value="{{ $product->quantity }}" onkeyup="if(this.value < 0) this.value = 1;" ></td>
                                <td>{{ number_format($product->import_price) }}</td>
                                <td><button class="btn btn-danger btn-sm" type='button'><i class="fas fa-minus-square"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Cập nhật hóa đơn</button>
                </div>
                <div class="col"></div>
            </div>
        </form>
    </div>


    {{-- add service --}}
    <div class="modal fade" id="addService" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-4">

                        <div class="col row">
                            <div class="col-md-4">
                                <label for="date" class="col-form-label">Chọn loại sản phẩm</label>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" name="" id="service-type-select">
                                    <option value="">Tất cả</option>
                                    @foreach ($productTypes as $type)
                                    <option value='{{ $type->product_type_id }}'>{{ $type->product_type_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col row">
                            <div class="col-md-4">
                                <label for="date" class="col-form-label">Chọn nhà cung cấp</label>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" name="" id="supplier-select">
                                    <option value="">Tất cả</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value='{{ $supplier->supplier_id }}'>{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <table class="display text-center" id="modal-list-service" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Loại sản phẩm</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Giá(VND)</th>
                                </tr>
                            </thead>
                            <tbody class="" id="">
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->product_name }} <input type="hidden" name="products[]"
                                            value="{{ $product->product_id }}">
                                    </td>
                                    <td data-search="{{ $product->product_type_id }}">{{ $product->product_type_name }}</td>
                                    <td data-search="{{ $product->supplier_id }}">{{ $product->supplier_name }}</td>
                                    <td>{{ number_format($product->import_price) }}</td>


                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                {{-- <th></th>
                                <th>Loại dịch vụ</th>
                                <th></th>
                                <th>Giá</th>
                                <th></th> --}}
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-bs-dismiss="modal" id="submit-service">Lưu</button>
                    <button class="btn btn-primary" data-bs-dismiss="modal">Quay lại</button>
                </div>
            </div>
        </div>
    </div>




</section>

@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function(){
    $.datetimepicker.setLocale('vi');

    var date = new Date().setHours(12,0,0);

    $('#checkin').datetimepicker({
        value: new Date(date),
        autoclose:true,
        format: 'd/m/Y H:i',
        step:15,
    });

    $('#checkout').datetimepicker({
        value: new Date(date),
        autoclose:true,
        format: 'd/m/Y H:i',
        step:15,
    });

})



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
        var listProductAddTable = $('#modal-list-service').DataTable({
            "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
            },
            dom: 'lrtip',

        });

        $('#service-type-select').on('change', function(){
            var type = $('#service-type-select option:selected').val();
            // console.log(value)
            var supplier = $('#supplier-select option:selected').val();
            listProductAddTable.columns(1).search(type).draw();
            listProductAddTable.columns(2).search(supplier).draw();


        });

        $('#supplier-select').on('change', function(){
            var type = $('#service-type-select option:selected').val();
            var supplier = $('#supplier-select option:selected').val();

            listProductAddTable.columns(1).search(type).draw();
            listProductAddTable.columns(2).search(supplier).draw();

        });


        $('#modal-list-service tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );



        $('#submit-service').on('click', function(){

            var data = listProductAddTable.rows('.selected').data();
            var listProductForm = $('#list-service').DataTable();

            var listProductIdForm = document.getElementById('list-service').querySelectorAll('input[type=hidden]')

            console.log(data[0])

            var listProductTable = $('#list-service').DataTable();
            if(data.length > 0){
                for(var i = 0; i < data.length; i++){
                    var productId = data[i][0].split('value=')[1].split('\"')[1];

                    var isExistServiceAndRoom = false;
                    if(listProductIdForm.length > 0){
                        for(var j = 0; j < listProductIdForm.length; j++){
                            if(listProductIdForm[j].value == productId){
                                isExistServiceAndRoom = true;
                                break;
                            }
                        }
                        if(isExistServiceAndRoom == false){
                            listProductTable.row.add([
                                data[i][0],
                                data[i][1].display,
                                data[i][2].display,
                                `<input class="form-control" type="number" name="quantities[]" value="1" min="1"
                                            onkeyup="if(this.value < 0) this.value = 1;">`,
                                data[i][3],
                                `<button class="btn btn-danger btn-sm" type='button'><i class="fas fa-minus-square"></i></button>`
                            ]).draw();
                        }
                    }else{
                        listProductTable.row.add([
                                data[i][0],
                                data[i][1].display,
                                data[i][2].display,
                                `<input class="form-control" type="number" name="quantities[]" value="1" min="1"
                                            onkeyup="if(this.value < 0) this.value = 1;">`,
                                data[i][3],
                                `<button class="btn btn-danger btn-sm" type='button'><i class="fas fa-minus-square"></i></button>`
                            ]).draw();
                    }

                }

            }
            $('#modal-list-service tbody tr').removeClass('selected')

        });

        $('#find-service').on('click', function(){
            getServices();
        })

    });






    function intoMoneyService(element){
        var row = element.parentElement.parentElement;
        var priceStr = row.querySelectorAll('td')[3].textContent;
        var price = Number(priceStr.replace(/[^0-9.-]+/g,""))
        row.querySelectorAll('td')[5].innerHTML = new Intl.NumberFormat('vn-VN').format(price * element.value);
    }

    function totalService(){
        var rows = document.querySelector('#list-service > tbody').querySelectorAll('tr');
        var total = 0;
        rows.forEach(function(row){
            var rowTotalStr = row.querySelectorAll('td')[5].textContent
            var rowTotal = Number(rowTotalStr.replace(/[^0-9.-]+/g,""))
            total += rowTotal
        })
        document.querySelector('#list-service > tfoot').querySelectorAll('th')[5].innerHTML = new Intl.NumberFormat('vn-VN').format(total);
    }



</script>

@endsection
