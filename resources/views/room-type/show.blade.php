@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thông tin loại phòng</h1>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-6"><a class="btn btn-primary btn-sm"  href="{{ route('room-type.index') }}">Danh sách loại phòng</a></div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <table class="table table-hover border fs-6 fw-normal">
            <thead class="table-light text-center">
                <tr>
                    <th class="fs-6 fw-normal border">Tên loại phòng</th>
                    <th class="fs-6 fw-normal border">Giá(VND)</th>
                    <th class="fs-6 fw-normal border">Số khách</th>
                    <th class="fs-6 fw-normal border">Mô tả</th>
                    <th class="fs-6 fw-normal border"></th>
                    <th class="fs-6 fw-normal border"></th>

                </tr>
            </thead>
            <tbody class="table-light text-center">

                <tr class="">
                    <th class="fs-6 fw-normal border">{{ $roomType->type_name }}</th>
                    <th class="fs-6 fw-normal border">{{ number_format($roomType->price) }}</th>
                    <th class="fs-6 fw-normal border">{{ $roomType->guest_number }}</th>
                    <th class="fs-6 fw-normal border">{{ $roomType->room_des }}</th>



                    <th class="fs-6 fw-normal border">
                        <a class="btn btn-info btn-sm" href="{{ route('room-type.edit',$roomType->room_type_id) }}">Chỉnh sửa
                            <i class="fas fa-user-edit"></i></a>
                    </th>

                    <th class="fs-6 fw-normal border">

                        <form action="{{ route('room-type.destroy',$roomType->room_type_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $roomType->room_type_id }}" class="btn btn-danger btn-sm delete" type="submit">Xóa
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
