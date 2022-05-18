@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thông tin phòng</h1>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-6"><a class="btn btn-primary btn-sm"  href="{{ route('room.index') }}">Danh sách phòng</a></div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <table class="table table-hover border fs-6 fw-normal">
            <thead class="table-light text-center">
                <tr>
                    <th class="fs-6 fw-normal border">Tên phòng</th>
                    <th class="fs-6 fw-normal border">Loại phòng</th>
                    <th class="fs-6 fw-normal border">Trạng thái</th>
                    <th class="fs-6 fw-normal border">Số lượng khách</th>
                    <th class="fs-6 fw-normal border">Giá thuê phòng</th>
                    <th class="fs-6 fw-normal border">Tầng</th>
                    <th class="fs-6 fw-normal border"></th>
                    <th class="fs-6 fw-normal border"></th>

                </tr>
            </thead>
            <tbody class="table-light text-center">

                <tr class="">
                    <th class="fs-6 fw-normal border">{{ $room->room_name }}</th>
                    <th class="fs-6 fw-normal border">{{ $room->room_type_info->type_name }}</th>
                    <th class="fs-6 fw-normal border">{{ $room->status_name }}</th>
                    <th class="fs-6 fw-normal border">{{ $room->room_type_info->guest_number }}</th>
                    <th class="fs-6 fw-normal border">{{ number_format($room->room_type_info->price) }}</th>
                    <th class="fs-6 fw-normal border">{{ $room->floor_name }}</th>


                    <th class="fs-6 fw-normal border">
                        <a class="btn btn-info btn-sm" href="{{ route('room.edit',$room->room_id) }}">Chỉnh sửa
                            <i class="far fa-edit"></i></i></a>
                    </th>

                    <th class="fs-6 fw-normal border">

                        <form action="{{ route('room.destroy',$room->room_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $room->room_id }}" class="btn btn-danger btn-sm" type="submit">Xóa
                                <i class="far fa-trash-alt"></i></button>
                        </form>
                    </th>
                </tr>

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>

@endsection
