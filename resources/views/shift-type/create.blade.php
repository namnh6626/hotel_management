@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm mới loại ca làm việc</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('shift-type.store') }}" method="POST">
            @csrf
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên loại ca làm việc</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="name" required />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Thời gian bắt đầu</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control timedatetimepicker" id="time_start" type="text" name="time_start"
                            value="07:00" required />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Thời gian kết thúc</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control timedatetimepicker" id="time_finish" type="text" value="07:00" name="time_finish"
                             required />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Ngày hôm sau</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="checkbox" name="is_tomorrow" />
                    </div>

                </div>

                <div class="row py-3">
                    <div class="col"></div>
                    <div class="col d-flex">
                        <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Thêm mới</button>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection


@section('script')
<script src="//cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>


<script type="text/javascript">

    var timepicker = new TimePicker('.timepicker', {
        theme: 'dark',
        lang: 'vi',
    });
    timepicker.on('change', function(evt) {
        var value = (evt.hour || '00') + ':' + (evt.minute || '00');
        evt.element.value = value;
    });


    function checkTime(startId, finishId){
        let start = document.getElementById(startId).value;

        let finish = document.getElementById(finishId).value;
        console.log(start);
        if(finish - start < 0){
            clickAlert('Lỗi', 'Thời gian bắt đầu phải lớn hơn thời gian kết thúc', 'red', 'error');
        }
    }
</script>

@endsection
