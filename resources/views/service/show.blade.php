@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thông tin dịch vụ</h1>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-6"><a class="btn btn-primary btn-sm"  href="{{ route('service.index') }}">Danh sách sản phẩm</a></div>
        </div>


    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <table class="table table-hover border fs-6 fw-normal">
            <thead class="table-light text-center">
                <tr>
                    <th class="fs-6 fw-normal border">Tên sản phẩm</th>
                    <th class="fs-6 fw-normal border">Giá(VND)</th>
                    <th class="fs-6 fw-normal border">Loại dịch vụ</th>
                    <th class="fs-6 fw-normal border"></th>
                    <th class="fs-6 fw-normal border"></th>

                </tr>
            </thead>
            <tbody class="table-light text-center">

                <tr class="">
                    <th class="fs-6 fw-normal border">{{ $service->service_name }}</th>
                    <th class="fs-6 fw-normal border">{{ number_format($service->service_price) }}</th>
                    <th class="fs-6 fw-normal border">{{ $service->service_type_name }}</th>



                    <th class="fs-6 fw-normal border">
                        <a class="btn btn-info btn-sm" href="{{ route('service.edit',$service->service_id) }}">Chỉnh sửa
                            <i class="fas fa-user-edit"></i></a>
                    </th>

                    <th class="fs-6 fw-normal border">

                        <form action="{{ route('service.destroy',$service->service_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $service->service_id }}" class="btn btn-danger btn-sm delete"  type="submit">Xóa
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
