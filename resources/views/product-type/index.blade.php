@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách loại sản phẩm</h1>
            </div>

        </div>
    </div>
    <div class="container-fluid">

        <div class="row mb-2 ">

            <div class="col-md-4">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add" type="button">Thêm
                    loại sản phẩm</button>
            </div>

        </div>

    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="table table-hover border fs-6 fw-normal">
            <thead class="table-light text-center">
                <tr>
                    <th class="fs-6 fw-normal border">STT</th>
                    <th class="fs-6 fw-normal border">Tên loại sản phẩm</th>

                    <th class="fs-6 fw-normal border"></th>
                    <th class="fs-6 fw-normal border"></th>
                </tr>
            </thead>
            <tbody class="table-light text-center">
                @php
                $order = 1;
                @endphp
                @foreach ($productTypes as $productType)
                <tr class="">
                    <th class="fs-6 fw-normal border">{{ $order }}</th>
                    <th class="fs-6 fw-normal border">{{ $productType->product_type_name }}</th>


                    <th class="fs-6 fw-normal border">
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#edit{{ $productType->product_type_id }}">Chỉnh sửa
                            <i class="fas fa-user-edit"></i></button>
                    </th>

                    <th class="fs-6 fw-normal border">

                        <form action="{{ route('product-type.destroy',$productType->product_type_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $productType->product_type_id }}" class="btn btn-danger btn-sm"
                                type="submit">Xóa
                                <i class="far fa-trash-alt"></i></button>
                        </form>
                    </th>
                </tr>
                @php
                $order++;
                @endphp
                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>

    {{-- Modal add --}}
    <div class="modal fade" id="add" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">
            <form action="{{ route('product-type.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm loại sản phẩm
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên loại sản phẩm</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="name" required />
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Quay
                            lại</button>
                        <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Thêm mới</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal edit --}}
    @foreach ($productTypes as $productType)

    <div class="modal fade" id="edit{{ $productType->product_type_id }}" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">
            <form action="{{ route('product-type.update', $productType->product_type_id) }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Cập nhật thông tin loại sản phẩm
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên loại sản phẩm</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value="{{ $productType->product_type_name }}"
                                        type="text" name="name" required />
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Quay
                            lại</button>
                        <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endforeach

</section>




@endsection
