@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm dịch vụ phòng {{ $room->room_name }}</h1>
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
        <form action="{{ route('room.store-service', $room->room_id)}}" method="POST">
            @csrf

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

                                        {{ $room->billInfo->cus_name }}
                                    </div>
                                    <input type="hidden" id="customerId" name="bill" value="{{ $room->billInfo->bill_id }}">
                                    <input type="hidden" id="" name="room" value="{{ $room->room_id }}">

                                </td>
                            </tr>

                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Số điện thoại</label>
                                </th>
                                <td id="customerPhone">
                                    {{$room->billInfo->phone }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

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
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="form-service-body">
                                {{-- @foreach ($room->services as $service)

                                <tr>

                                    <td>{{ $service->service_name }}
                                        <input type="hidden" name="services[]" value="{{ $service->service_id }}">
                                    </td>
                                    <td>{{ $service->service_type_name }}</td>
                                    <td><input class="form-control" min="1" type="number" name="quantities[]"
                                            value="{{ $service->quantity }}" required></td>
                                    <td>{{ number_format($service->service_price) }}</td>



                                    <td><button type="button" disabled class="btn btn-danger btn-sm" type='button'><i
                                                class="fas fa-minus-square"></i></button></td>
                                </tr>
                                @endforeach --}}

                            </tbody>

                        </table>
                    </div>
                </div>





            </div>

            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Thêm mới</button>
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
                                    <option value='{{ $room->room_id }}'>{{ $room->room_name }}</option>
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

            console.log(listServiceIdForm);

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

                for(var i = 0; i < data.length; i++){
                    var serviceId = data[i][0].split('value=')[1].split('\"')[1];
                    for(var j = 0; j < listServiceIdForm.length; j++){
                        if(listServiceIdForm[j].value == serviceId){
                            isExistServiceAndRoom = true;
                            break;
                        }
                    }
                    if(isExistServiceAndRoom == false){
                        console.log(data);
                        listServiceTable.row.add([
                            data[i][0],
                            data[i][1].display,
                            data[i][2],
                            data[i][3],
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
