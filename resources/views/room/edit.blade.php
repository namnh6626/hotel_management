@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cập nhật thông tin phòng</h1>
            </div>

        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">


        <form action="{{ route('room.update',$room->room_id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên phòng</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="name" value="{{ $room->room_name }}"
                            required />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Loại phòng</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="type" id="">
                            <option value="{{ $room->room_type_id }}">{{ $room->room_type_info->type_name }}</option>
                            @foreach ($roomTypes as $type)
                                @if ($type->room_type_id == $room->room_type_id)
                                    @continue;
                                @endif
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
                            @if ($room->floor_id)
                            <option value="{{ $room->floor_id }}">{{ $room->floor_name }}</option>
                            @endif
                            @foreach ($floors as $floor)
                            @if ($floor->floor_id == $room->floor_id)
                            @continue;
                            @endif
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
                            @if ($room->status_id)
                            <option value="{{ $room->status_id }}">{{ $room->status_name }}</option>
                            @endif
                            @foreach ($statuses as $status)
                            @if ($status->status_id == $room->status_id)
                            @continue;
                            @endif
                            <option value="{{$status->status_id }}">{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>

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
