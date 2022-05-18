@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm mới phòng</h1>
            </div>

        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">


        <form action="{{ route('room.store')}}" method="POST">
            @csrf
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên phòng</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="name" value="" required />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Loại phòng</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="type" id="">
                            @foreach ($roomTypes as $type)
                            <option value="{{$type->room_type_id }}">{{ $type->type_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tầng</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="floor" id="">
                            @foreach ($floors as $floor)
                            <option value="{{$floor->floor_id }}">{{ $floor->floor_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Trạng thái</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="status" id="">
                            @foreach ($statuses as $status)
                            <option value="{{$status->status_id }}">{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>



            </div>


            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Tạo phòng</button>
                </div>
                <div class="col"></div>
            </div>
        </form>
    </div>


</section>
@endsection
