@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cập nhật thông tin hóa đơn</h1>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-primary" href="{{ route('bill.index') }}">Danh sách hóa đơn</a>
            </div>
            <div class="col d-flex justify-content-end ">

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
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
        </div>
        @endforeach
        <form action="{{ route('bill.update', $bill->bill_id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row py-3">
                <div classs="row form-group my-4 py-3" id="form">
                    <div class="row g-4 align-items-center" style="padding-left: 10px">

                        <div class="col-md-5">
                            <label for="date" class="col-form-label">Tìm khách hàng</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" id="search-cus" class="form-control" placeholder="Nhập SĐT hoặc CCCD" />
                            <input type="hidden" >
                        </div>

                    </div>
                </div>
            </div>
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
                                    <input type="text" name="deposit" value="{{ number_format($bill->deposit) }}"
                                        class="form-control" id="deposit" onkeyup="formatToMoney('deposit');">
                                </td>
                            </tr>


                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Trạng thái</label>
                                </th>
                                <td>
                                    <input type="hidden" name="is_paid" id="" class="form-select" value="{{ $bill->is_paid }}">
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
                        <div class="col-6">
                            <a class="btn btn-sm btn-primary float-end" data-bs-target="#addRoom"
                                data-bs-toggle="modal">Thêm phòng</a>
                        </div>
                    </div>
                    <div class="" id="listRooms"></div>
                    <div class="row">
                        @if ($error = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $error }}</strong>
                        </div>
                        @endif
                        <table class="order-column row-border hover cell-border dt-center text-center" id="list-room">
                            <thead>
                                <tr>
                                    <th>Tên phòng</th>
                                    <th>Loại phòng</th>
                                    <th>Số khách</th>
                                    <th>Giá(VND)</th>
                                    <th>Tầng</th>
                                    <th>Checkin</th>
                                    <th>Checkout</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="form-table-body">
                                @foreach ($bill->rooms as $room)

                                <tr>

                                    <td>{{ $room->room_name }} <input type="hidden" name="rooms[]"
                                            value="{{ $room->room_id }}"></td>
                                    <td>{{ $room->type_name }}</td>
                                    <td>{{ $room->guest_number }}</td>
                                    <td>{{ number_format($room->price) }}</td>
                                    <td>{{ $room->floor_name }}</td>
                                    <td>
                                        <input name="datetime_checkin[]" class="datetimepicker form-control" type="text"
                                            value="{{ date(" d/m/Y H:i", strtotime($room->date_checkin)); }}" >
                                    </td>
                                    <td>
                                        <input name="datetime_checkout[]" type="text"
                                            class="datetimepicker form-control" value="{{ date(" d/m/Y H:i",
                                            strtotime($room->date_checkout)) }}">
                                    </td>

                                    <td><button class="btn btn-danger btn-sm" type='button'><i
                                                class="fas fa-minus-square"></i></button></td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>

                    <div class="row  my-4">
                        <div class="col-6">
                            <h4 class="pb-3">Danh sách dịch vụ</h4>
                            <div></div>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-sm btn-primary float-end" data-bs-target="#addService"
                                data-bs-toggle="modal">Thêm dịch vụ</a>
                        </div>
                    </div>
                    <div class="row">
                        <table class="order-column row-border hover cell-border dt-center text-center"
                            id="list-service">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>Tên dịch vụ</th>
                                    <th>Loại dịch vụ</th>
                                    <th>Số lượng</th>
                                    <th>Giá(VND)</th>
                                    <th>Phòng sử dụng</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="form-service-body">
                                @foreach ($bill->services as $service)

                                <tr>

                                    <td>{{ $service->service_name }} <input type="hidden" name="services[]"
                                            value="{{ $service->service_id }}">
                                    </td>
                                    <td>{{ $service->service_type_name }}</td>
                                    <td><input class="form-control" min="1" type="number" name="quantities[]"
                                            value="{{ $service->quantity }}" required></td>
                                    <td>{{ number_format($service->service_price) }}</td>
                                    <td>
                                        <select class="form-select" name="service_room[]" id="">
                                            <option value="{{ $service->room_id }}">{{ $service->room_name }}</option>
                                            @foreach ($bill->rooms as $room)
                                            @if ($room->room_id == $service->room_id)
                                            @continue
                                            @endif
                                            <option value="{{ $room->room_id }}">{{ $room->room_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>


                                    <td><button class="btn btn-danger btn-sm" type='button'><i
                                                class="fas fa-minus-square"></i></button></td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>





            </div>

            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Cập nhật</button>
                </div>
                <div class="col"></div>
            </div>
        </form>
    </div>



    {{-- add room --}}
    <div class="modal fade " id="addRoom" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm phòng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col row">

                            <div class="col-md-4">
                                <label for="date" class="col-form-label">Checkin</label>
                            </div>
                            <div class="col-md-6" id="checkin-group">
                                <input class="form-control" type="text" name="datetime_checkin[]" id="checkin">

                            </div>

                        </div>


                        <div class="col row">
                            <div class="col-md-4">
                                <label for="date" class="col-form-label">Checkout</label>
                            </div>
                            <div class="col-md-6" id="checkout-group">
                                <input type="text" name="datetime_checkout[]" class="form-control" id="checkout">

                            </div>

                        </div>
                    </div>
                    {{-- <input type="text" class="name{{ $room->room_id }}">
                    <input type="text" class="name{{ $room->room_id }}"> --}}
                    <div class="row form-group">
                        <div class="row col">
                            <div class="col-md-4">
                                <label for="date" class="col-form-label">Loại phòng</label>
                            </div>
                            <div class="col-md-6 px-3">
                                <select class="form-select form-select-sm" name="" id="type">
                                    <option value="0">Tất cả</option>
                                    @foreach ($roomTypes as $roomType)
                                    <option value="{{ $roomType->room_type_id }}">{{ $roomType->type_name }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="row col"></div>
                    </div>
                    <div class="row justify-content-center py-3">
                        <div class="col-md-3 d-flex justify-content-center">
                            <button class="btn btn-primary" type="button" id="find-room">Tìm phòng</button>
                        </div>

                    </div>
                    <table class="display cell-border text-center" style="width:100%" id="modal-rooms">
                        <thead>
                            <tr>
                                <th>Tên phòng</th>
                                <th>Loại phòng</th>
                                <th>Số khách</th>
                                <th>Giá tiền(VND)</th>
                                <th>Tầng</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="save-btn" data-bs-dismiss="modal"
                        aria-label="Close">Lưu</button>
                    <button class="btn btn-disable" id="return" data-bs-dismiss="modal" aria-label="Close">Quay
                        lại</button>
                </div>
            </div>
        </div>
    </div>

    {{-- add service --}}
    <div class="modal fade" id="addService" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-4">
                        <div class="col row">
                            <div class="col-md-4">
                                <label for="date" class="col-form-label">Chọn phòng</label>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" name="" id="service-room-select">
                                    @foreach ($bill->rooms as $room)
                                    <option value='{{ $room->room_id }}'>{{ $room->room_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col row">
                            <div class="col-md-4">
                                <label for="date" class="col-form-label">Chọn loại dịch vụ</label>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" name="" id="service-type-select">
                                    <option value="">Tất cả</option>
                                    @foreach ($serviceTypes as $type)
                                    <option value='{{ $type->service_type_id }}'>{{ $type->service_type_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <table class="display text-center" id="modal-list-service" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Tên dịch vụ</th>
                                    <th>Loại dịch vụ</th>
                                    <th>Số lượng</th>
                                    <th>Giá(VND)</th>

                                </tr>
                            </thead>
                            <tbody class="" id="">
                                @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->service_name }} <input type="hidden" name="services[]"
                                            value="{{ $service->service_id }}">
                                    </td>
                                    <td data-search="{{ $service->service_type_id }}">{{ $service->service_type_name }}</td>
                                    <td><input class="form-control" type="number" name="quantities[]" value="1" min="1"
                                            onkeyup="if(this.value < 0) this.value = 1;"></td>
                                    <td>{{ number_format($service->service_price) }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <th></th>
                                <th>Loại dịch vụ</th>
                                <th></th>
                                <th>Giá</th>
                                <th></th>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-bs-dismiss="modal" id="submit-service">Lưu</button>
                    <button class="btn btn-primary" data-bs-dismiss="modal"
                        onclick="addServiceClickSetValue(,'addedService')">Quay
                        lại</button>
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



    var route = "{{ url('autocomplete-search') }}";
    $('#search-cus').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    var arr = [];
                    data.forEach(element => {
                        var id = element.cus_id;
                        var name = element.cus_name;
                        var phone = element.phone;
                        var citizenId = element.citizen_id;
                        var push = id + ' - ' + name + ' - ' +  phone + ' - ' + citizenId;
                        arr.push(push);
                    });
                    return process(arr);
                });
            },
            updater:function (item) {
                var customerInfo = item.split(" - ")

                document.getElementById('customerId').setAttribute('value',customerInfo[0]);

                document.getElementById('customerName').innerHTML = customerInfo[1];
                document.getElementById('customerPhone').innerHTML = customerInfo[2];
                // document.getElementById('customerCitizenId').innerHTML = customerInfo[3];
            }
        });



    // $(function () {
    //     $('.datepickerUnset').datepicker({
    //         format: "dd/mm/yyyy",
    //         todayBtn: "linked",
    //         clearBtn: true,
    //         language: "vi",
    //         autoclose: true,
    //         todayHighlight: true,
    //         immediateUpdates:true,
    //         weekStart:1
    //     });
    // });


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


        $('#list-service tbody').on( 'click', 'button', function () {
            var row = listServiceTable.row( $(this).parents('tr') );
            row.remove();
            listServiceTable.draw();
        } );


    });


    $(document).ready(function(){
        var listRoomTable = $('#list-room').DataTable({
            "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
            },
            responsive: true,
        });

        $('#list-room tbody').on( 'click', 'button', function () {
            var row = listRoomTable.row( $(this).parents('tr') );
            row.remove();
            listRoomTable.draw();
        } );
    });

    $(document).ready(function(){
        var listRoomTableModal = $('#modal-rooms').DataTable({
            "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
            },
        });

        $('#find-room').on('click', function (e) {
            getRooms();
        });

        $('#modal-rooms tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

        $('#save-btn').click( function () {
            // console.log( table.rows('.selected').data());
            // console.log( table.rows('.selected'));
            var data = listRoomTableModal.rows('.selected').data();
            if(data.length > 0){
                var checkin = $('#checkin').val();
                var checkout = $('#checkout').val();

                saveModalSelected(data, 'list-room', checkin, checkout);
            }
            listRoomTableModal.rows().remove().draw();
            $('#checkin').datetimepicker("setDate", new Date())
            $('#checkout').datetimepicker("setDate", new Date())


        } );

        $('#return').click(function(){
            listRoomTableModal.rows().remove().draw();
            $('#checkin').datepicker("setDate", new Date())
            $('#checkout').datepicker("setDate", new Date())

        });

    });



    $(document).ready(function(){
        var listServiceAddTable = $('#modal-list-service').DataTable({
            "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
            },
            dom: 'lrtip',
            // initComplete: function () {
            //     this.api().columns([1, 3]).every( function(){
            //         var column = this;
            //         var select = $('<select><option value=""></option></select>')
            //             .appendTo( $(column.footer()).empty() )
            //             .on( 'change', function () {
            //                 var val = $.fn.dataTable.util.escapeRegex(
            //                     $(this).val()
            //                 );
            //                 column
            //                     .search( val ? '^'+val+'$' : '', true, false )
            //                     .draw();
            //             } );

            //         column.data().unique().sort().each( function ( d, j ) {
            //                 select.append( '<option value="'+d+'">'+d+'</option>' )
            //         } );
            //     });
            // }
        });

        $('#service-type-select').on('change', function(){
            var value = $('#service-type-select option:selected').val();

            listServiceAddTable.columns(1).search(value).draw();

        });


        $('#modal-list-service tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );



        $('#submit-service').on('click', function(){

            var data = listServiceAddTable.rows('.selected').data();
            var listServiceForm = $('#list-service').DataTable();

            var listServiceIdForm = document.getElementById('list-service').querySelectorAll('input[type=hidden]')
            var listServiceRoomIdForm = document.getElementById('list-service').querySelectorAll('select')


            var select = document.getElementById('service-room-select')
            var optionSelectedValue = $('#service-room-select').val()



            var options = select.querySelectorAll('option');
            var optionUnselected = '';
            var optionSelected = '';
            var isExistServiceAndRoom = false;
            for(var j = 0; j < data.length; j++){
                var serviceId = data[0][0].split('value=')[1].split('\"')[1]
            }
            for(var i = 0; i < listServiceIdForm.length; i++){
                if(listServiceIdForm[i].value == 0){

                }
            }
            options.forEach(function(option){
                if(option.value == optionSelectedValue){
                    // console.log(option)
                    optionSelected = option.outerHTML
                }else{
                    optionUnselected += option.outerHTML
                }

            })


            var listServiceTable = $('#list-service').DataTable();
            if(data.length > 0){
                var selectHTML = select.outerHTML
                console.log(data);
                for(var i = 0; i < data.length; i++){
                    var serviceId = data[i][0].split('value=')[1].split('\"')[1];
                    for(var j = 0; j < listServiceIdForm.length; j++){
                        if(listServiceIdForm[j].value == serviceId && listServiceRoomIdForm[j].value == optionSelectedValue){
                            isExistServiceAndRoom = true;
                            break;
                        }
                    }
                    if(isExistServiceAndRoom == false){

                        listServiceTable.row.add([
                            data[i][0],
                            data[i][1].display,
                            data[i][2],
                            data[i][3],
                            `<select class="form-select" name="service_room[]">${optionSelected}${optionUnselected}</select>`,
                            `<button class="btn btn-danger btn-sm" type='button'><i class="fas fa-minus-square"></i></button>`
                        ]).draw();
                    }


                }
            }
            $('#modal-list-service tbody tr').removeClass('selected')

        });


    });

    function removeDuplicate(tbodyId){
        var rows = document.getElementById(tbodyId).querySelectorAll('tr')
    }

    function saveModalSelected(data, tableFormId, checkin, checkout){
        var tableForm = $('#list-room').DataTable();
        // console.log(tableForm)
        // console.log(data)

        for(var i = 0; i < data.length; i++){
            // console.log(data[i]);
            var rowId = 'rowForm' + data[i][0];
            console.log(data)



            tableForm.row.add([
                data[i][0],
                data[i][1],
                data[i][2],
                data[i][3],
                data[i][4],
                `<input name="datetime_checkin[]" class="form-control datetimepicker" value="${checkin}" >`,
                `<input name="datetime_checkout[]" class="form-control datetimepicker" value="${checkout}" >`,
                `<button class="btn btn-danger btn-sm" type='button'><i class="fas fa-minus-square"></i></button>`
            ]).draw();

            $('.datetimepicker').datetimepicker({
                    autoclose:true,
                    format: 'd/m/Y H:i',
                    step:15,
                });

        }


    }



    function getRooms() {
        var checkinStr = $('#checkin').val();
        var checkoutStr = $('#checkout').val();

        var checkinArr = checkinStr.split(' ')
        var checkoutArr = checkoutStr.split(' ')

        var checkinDateArr = checkinArr[0].split('/');
        var checkoutDateArr = checkoutArr[0].split('/');

        var checkin = checkinDateArr[2] + '-' + checkinDateArr[1] + '-' + checkinDateArr[0] + ' ' + checkinArr[1];

        var checkout = checkoutDateArr[2] + '-' + checkoutDateArr[1] + '-' + checkoutDateArr[0] + ' ' + checkoutArr[1];



        // console.log(checkin);

        var type = $("#type option:selected").val();
        if(new Date(checkout) > new Date(checkin)){
            $.ajax({
                type: "GET",
                data: {
                'checkin':checkin,
                'checkout': checkout,
                'type': type,
                },
                url: "{{ route('room.filter-select') }}" ,
                success:function(data) {
                    var table = $('#modal-rooms').DataTable();

                    table.rows().remove();
                    var tableForm = document.getElementById('form-table-body');
                    var listRoomForm = tableForm.querySelectorAll('input[type=hidden]');
                    // console.log(Object.keys (data).length);
                    if(Object.keys (data).length > 0){
                        // console.log(typeof(data))
                        // console.log(data[0].room_name)
                        // console.log(data)
                        data.forEach(function(room){
                            // console.log(room)
                            if(listRoomForm.length > 0){
                                var roomIsInForm = false;
                                for(var i = 0; i < listRoomForm.length; i++){
                                    if(listRoomForm[i].value == room.room_id){
                                        roomIsInForm = true;
                                        break;
                                    }
                                }

                                if(!roomIsInForm){
                                    table.row.add([
                                        // room.room_id,
                                        room.room_name + `<input type="hidden" name="rooms[]" value="${room.room_id}" />`,
                                        room.type_name,
                                        room.guest_number,
                                        new Intl.NumberFormat('vn-VN').format(room.price),
                                        room.floor_name
                                    ] ).draw();
                                }
                            }else{
                                table.row.add([
                                    room.room_name + `<input type="hidden" name="rooms[]" value="${room.room_id}" />`,
                                    room.type_name,
                                    room.guest_number,
                                    new Intl.NumberFormat('vn-VN').format(room.price),
                                    room.floor_name
                                ]).draw();

                            }
                        });

                    }
                    else
                    {
                        var table_body = document.getElementById('modal-rooms').querySelector('tbody');
                        table_body.innerHTML = '<td valign="top" colspan="5" class="dataTables_empty">Không có phòng phù hợp</td>';
                    }

                }
            });

        }else{
            var table_body = document.getElementById('modal-rooms').querySelector('tbody');
            // console.log(table_body);
            table_body.innerHTML = '<td valign="top" colspan="5" class="dataTables_empty">Không có dữ liệu. Ngày checkin phải lớn hơn ngày checkout</td>';

            // table.rows().remove();
            clickAlert('Lỗi', 'Thời gian checkout phải lớn hơn thời gian checkin', '#FF3333', 'error');

        }
    }

    function getServices() {
        var type = $('#service-type-select option:selected').val();
        var room = $('#service-room-select option:selected').val();



        // console.log(checkin);

            $.ajax({
                type: "GET",
                data: {
                'type':type,
                'room': room,
                },
                url: "{{ route('service.filter-service') }}" ,
                success:function(data) {
                    console.log(data);
                    var table = $('#modal-list-service').DataTable();
                    table.rows().remove();

                    var tableForm = document.getElementById('form-service-body');
                    var listServiceForm = tableForm.querySelectorAll('input[type=hidden]');
                    var listServiceRoomForm = tableForm.querySelectorAll('option:checked');

                    console.log(listServiceRoomForm[0].value);

                    if(listServiceForm.length > 0){
                        data[0].forEach(function(service){
                            for(var i = 0; i < listServiceForm.length; i++){
                                if(listServiceForm){}
                            }
                        })

                    }
                    //add modal to form
                    // // console.log(Object.keys (data).length);
                    // if(Object.keys (data).length > 0){
                    //     // console.log(typeof(data))
                    //     // console.log(data[0].room_name)
                    //     // console.log(data)
                    //     data.forEach(function(room){
                    //         // console.log(room)
                    //         if(listRoomForm.length > 0){
                    //             var roomIsInForm = false;
                    //             for(var i = 0; i < listRoomForm.length; i++){
                    //                 if(listRoomForm[i].value == room.room_id){
                    //                     roomIsInForm = true;
                    //                     break;
                    //                 }
                    //             }

                    //             if(!roomIsInForm){
                    //                 table.row.add([
                    //                     // room.room_id,
                    //                     room.room_name + `<input type="hidden" name="rooms" value="${room.room_id}" />`,
                    //                     room.type_name,
                    //                     room.guest_number,
                    //                     new Intl.NumberFormat('vn-VN').format(room.price),
                    //                     room.floor_name
                    //                 ] ).draw();
                    //             }
                    //         }else{
                    //             table.row.add([
                    //                 room.room_id,
                    //                 room.room_name,
                    //                 room.type_name,
                    //                 room.guest_number,
                    //                 new Intl.NumberFormat('vn-VN').format(room.price),
                    //                 room.floor_name
                    //             ]).draw();

                    //         }
                    //     });

                    // }
                    // else
                    // {
                    //     var table_body = document.getElementById('modal-rooms').querySelector('tbody');
                    //     table_body.innerHTML = '<td valign="top" colspan="5" class="dataTables_empty">Không có phòng phù hợp</td>';
                    // }

                }
            });


    }

    function totalRoom(){
        var rows = document.getElementById('form-table-body').querySelectorAll('tr');
        var total = 0
        rows.forEach(function(row){
            var totalCell = row.querySelectorAll('td')[7].textContent;
            var totalValue = parseInt(Number(totalCell.replace(/[^0-9.-]+/g,"")));
            total += totalValue;
        })
        document.querySelector('#list-room > tfoot').querySelectorAll('th')[7].innerHTML = new Intl.NumberFormat('vn-VN').format(total)
    }

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
