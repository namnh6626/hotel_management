@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách loại ca làm việc</h1>
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
                    <th>Tên trạng thái</th>
                    {{-- <th></th> --}}
                </tr>
            </thead>
            <tbody>

                @foreach ($statuses as $status)
                <tr class="">

                    <td>{{ $status->status_name }}</td>

                    {{-- <td class="d-flex justify-content-center">
                        <a class="btn btn-info btn-sm mr-2" href="{{ route('status.edit',$status->status_id) }}">Chỉnh sửa
                            <i class="fas fa-edit"></i></a>
                            <form action="{{ route('status.destroy', $status->status_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button id="delete{{ $status->status_id }}" class="btn btn-danger btn-sm delete" type="submit">
                                    <i class="far fa-trash-alt"></i></button>
                            </form>
                    </td > --}}


                </tr>

                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>


@endsection
