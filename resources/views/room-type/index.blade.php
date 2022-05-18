@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách loại phòng</h1>
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
        <table class="datatable display text-center cell-border">
            <thead>
                <tr>
                    <th>Tên loại phòng</th>
                    <th>Giá(VND)</th>
                    <th>Số khách</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($roomTypes as $roomType)
                <tr class="">
                    <td>{{ $roomType->type_name }}</td>
                    <td>{{ number_format($roomType->price) }}</td>
                    <td>{{ $roomType->guest_number }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('room-type.show',$roomType->room_type_id) }}">Chi tiết
                            <i class="fas fa-info"></i></a>
                    </td>

                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('room-type.edit',$roomType->room_type_id) }}">Chỉnh sửa
                            <i class="fas fa-user-edit"></i></a>
                            <form action="{{ route('room-type.destroy',$roomType->room_type_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button id="delete{{ $roomType->room_type_id }}" class="btn btn-danger btn-sm delete" type="submit">Xóa
                                    <i class="far fa-trash-alt"></i></button>
                            </form>
                    </td>


                </tr>

                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>

{{-- <div class="d-flex justify-content-center">
    {{ $roomTypes->appends([])->links('pagination::bootstrap-4') }}
</div> --}}
@endsection
