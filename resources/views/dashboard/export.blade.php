@extends('main')
@section('content')

<div class="container-fluid">
    <div class="row">
        <h2>Biểu đồ hiệu suất phòng</h2>
    </div>
    <div class="row justify-content-center py-2">
        <div class="col-md-10 d-flex">
            <div class="col-md-2">
                <label for="">Chọn thời gian</label>
            </div>
            <div class="col-md-3">
                <select name="" id="type" class="form-select form-select-sm">
                    <option value="7">7 ngày qua</option>
                    <option value="14">14 ngày qua</option>
                    <option value="30">30 ngày qua</option>
                </select>
            </div>

        </div>

        <div class="col-md-10 d-flex">
            <div class="col-md-2">
                <label for="">Chọn mặt hàng</label>
            </div>
            <div class="col-md-3">
                <select name="" id="product" class="form-select form-select-sm">
                    @foreach ($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                    @endforeach

                </select>
            </div>

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10" id="chart-div">
            <canvas id="chart" class="chartjs-render-monitor" height="200"
                style="display: block; width: 484px; height: 200px;"></canvas>
        </div>

    </div>
</div>

@endsection


@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js"></script> --}}

<script type="text/javascript">
    $(document).ready(function(){
    getChart();

    $('#type').on('change', function(){
        var data = getChart();
    });
    $('#product').on('change', function(){
        var data = getChart();
    });
});

function getChart(){
    let type = $('#type').val()
    let product = $('#product').val()
    $.ajax({
        type:"GET",
        data:{
            'type':type,
            'product':product,
        },
        url :"{{ route('dashboard.room-performance') }}",
        success: function(listData){
            $('#chart').remove();
            $('#chart-div').append('<canvas id="chart"></canvas>');
            let chart = $('#chart');

            let labels = listData.listStartTime;

            let data = {
                labels: labels,
                datasets: [
                    {
                        label: 'Lượng hàng xuất kho',
                        data: listData.listProductExport,
                        borderColor: 'red',
                        backgroundColor: 'red',
                        yAxisID: 'y',
                    },
                    // {
                    //     label: 'Số lượt sử dụng dịch vụ',
                    //     data: listData.listCountServiceUse,
                    //     borderColor: 'blue',
                    //     backgroundColor: 'blue',
                    //     yAxisID: 'y1',
                    // }

                ]
            };

            var arr1 = listData.listProductExport;
            var arr2 = listData.listCountServiceUse;

            var max1 = Math.max(...arr1);
            var max2 = Math.max(...arr2);

            const config = {
                type: 'line',
                data: data,
                options: {
                    locale:'vi-VN',
                    responsive: true,
                    plugins: {
                    title: {
                        display: true,
                        text: 'Lượng hàng xuất kho'
                        }
                    },
                    tension:0.4,
                    scales: {
                    y:  {
                        title:{
                            display: true,
                            text: 'Lượng hàng xuất kho',
                            color: 'red'
                        },
                        type: 'linear',
                        display: true,
                        position: 'left',
                        min:0,
                        max:max1
                        },
                    // y1: {
                    //     title:{
                    //         display:true,
                    //         text: 'Số lượt sử dụng dịch vụ',
                    //         color: 'blue'
                    //     },
                    //     type: 'linear',
                    //     display:true,
                    //     position: 'right',
                    //     min:0,
                    //     max:max2
                    //     },
                    }
                },
            };

                var myChart = new Chart(chart, config);
            }
    })
}

// var chart = $('#chart');

// const DATA_COUNT = 7;
// const NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};

// const labels =[1, 2, 3, 4, 5, 6, 7];
// const data = {
//   labels: labels,
//   datasets: [
//     {
//       label: 'Dataset 1',
//       data: [10, 30, 50, 20, 25, 44, -10],
//       borderColor: 'red',
//       backgroundColor: 'red',
//       yAxisID: 'y',
//     },
//     {
//       label: 'Dataset 2',
//       data: [102, 33, 22, 19, 11, 49, 30],
//       borderColor: 'blue',
//       backgroundColor: 'blue',
//       yAxisID: 'y1',
//     }
//   ]
// };
// const config = {
//   type: 'line',
//   data: data,
//   options: {
//     responsive: true,
//     plugins: {
//       title: {
//         display: true,
//         text: 'Min and Max Settings'
//       }
//     },
//     scales: {
//       y: {
//         type: 'linear',
//         display: true,
//         position: 'left',
//         min:-20,
//         max:100
//       },
//       y1:{
//         type: 'linear',
//         display: true,
//         position: 'right',
//         min:0,
//         max:200
//       }
//     }
//   },
// };

// var myChart = new Chart(chart, config);

</script>

@endsection
