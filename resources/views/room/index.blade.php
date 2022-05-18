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
            <div class="col-sm-6"><a class="btn btn-primary btn-sm"  href="{{ route('room.diagram') }}">Sơ đồ phòng</a></div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <table class="datatable display text-center cell-border">
            <thead>
                <tr>
                    <th>Tên phòng</th>
                    <th>Loại phòng</th>
                    <th>Giá thuê phòng</th>
                    <th>Tầng</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->room_name }}</td>
                    <td>{{ $room->type_name }}</td>
                    <td>{{ number_format($room->price) }}</td>
                    <td>{{ $room->floor_name }}</td>


                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('room.show',$room->room_id) }}">Chi tiết
                            <i class="far fa-detail"></i></i></a>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>

@endsection
