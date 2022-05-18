@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách hóa đơn</h1>
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
        <div class="row">
            <div class="col-md-3">
                <label style="margin-top: 8px"  for="">Chọn thời gian</label>
            </div>
                <div class="col-md-3">
                        <input id="start" type="text" class="form-control form-control-sm"
                         required  >


                </div>

                <div class="col-md-3">
                        <input id="finish" type="text" class="form-control form-control-sm"
                         required  >

                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary" id="filter">Tải lại</button>
                </div>
        </div>

        <div class="row py-4">
            <table class="display datatable cell-border text-center" id="datatable">
                <thead>
                    <tr>
                        <th>Tên hóa đơn</th>
                        <th>Loại hóa đơn</th>
                        <th>Nhân viên</th>
                        <th>Ngày lập hóa đơn</th>
                        {{-- <th>Tên quỹ</th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>

        <div class="row py-4">
        </div>
    </div>
</section>

@endsection





@section('script')

<script type="text/javascript">

$(document).ready(function(){

    var date = new Date();

    $('#start').datetimepicker({
        value: new Date(date),
        autoclose:true,
        format: 'd/m/Y',
        step:15,
        timepicker:false,
    });

    $('#finish').datetimepicker({
        value: new Date(date),
        autoclose:true,
        format: 'd/m/Y',
        timepicker:false,
        step:15,
    });

    getBills();

    $('#filter').click(function(){
        getBills();
    })
})

function getBills(){
    let startStr = $('#start').val()
    let finishStr = $('#finish').val()

    var startArr = startStr.split('/')
    var finishArr = finishStr.split('/')

    var start = startArr[2] + '-' + startArr[1] + '-' + startArr[0];
    var finish = finishArr[2] + '-' + finishArr[1] + '-' + finishArr[0];

    // console.log(start)

    $.ajax({
        type:"GET",
        data:{
            'finish':finish,
            'start':start
        },
        url :"{{ route('dashboard.filter-warehouse-receipt') }}",
        success: function(listData){
            var table = $('#datatable').DataTable();
            table.rows().remove();

            // console.log(listData);

            if(listData.length > 0){
                listData.forEach(function(receipt){
                    var url = '{{ route("warehouse-receipt.show", ":id") }}';
                    url = url.replace(':id', receipt.warehouse_receipt_id);
                    var row = table.row.add([
                        receipt.warehouse_receipt_name,
                        receipt.warehouse_receipt_type_name,
                        receipt.user_name,
                        receipt.receipt_created_at,
                        '<a class="btn btn-success btn-sm text-nowrap" href="' + url + '">' + 'Chi tiết <i class="fas fa-info"></i>' + ' </a>'
                    ]).draw();

                })
            }
        }
    })
}
</script>

@endsection
