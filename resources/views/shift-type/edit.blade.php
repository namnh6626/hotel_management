@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cập nhật thông tin loại ca làm việc</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('shift-type.update',$shiftType->shift_type_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên loại ca làm việc</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" value="{{ $shiftType->shift_type_name }}" type="text" name="name"
                            required />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Thời gian bắt đầu</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control timedatetimepicker" id="time_start" type="text" name="time_start"
                            value="{{ date('H:i', strtotime($shiftType->time_start)) }}" required />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Thời gian kết thúc</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control timedatetimepicker" id="time_finish" type="text" name="time_finish"
                            value="{{ date('H:i',strtotime($shiftType->time_finish)) }}" required />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Ngày hôm sau</label>
                    </div>
                    <div class="col-sm-6">
                        @if ($shiftType->is_tomorrow)
                        <input class="form-check-input" style="margin: 0px 20px;
                        top: -10px;" type="checkbox" name="is_tomorrow" checked />
                        @else
                        <input class="form-check-input " style="margin: 0px 20px;
                        top: -10px;" type="checkbox" name="is_tomorrow" />
                        @endif
                    </div>

                </div>

                <div class="row py-3">
                    <div class="col"></div>
                    <div class="col d-flex">
                        <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Cập nhật</button>
                    </div>
                    <div class="col"></div>
        </form>
    </div>
    </div>


</section>

@endsection
