@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách sản phẩm trong kho</h1>
            </div>

        </div>
    </div>
    <div class="container-fluid">

        <div class="row mb-2 ">

            <div class="col-md-4">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add" type="button">Thêm
                    sản phẩm</button>
            </div>

        </div>

    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="display datatable cell-border text-center">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá nhập(VND)</th>
                    <th>Số lượng trong kho</th>
                    <th>Loại sản phẩm</th>
                    <th>Nhà cung cấp</th>
                    <th>Đơn vị</th>
                    <th></th>
                </tr>
            </thead>
            <tbody >

                @foreach ($products as $product)
                <tr class="">
                    <td>{{ $product->product_name }}</td>
                    <td>{{ number_format($product->import_price) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->product_type_name }}</td>
                    <td>{{ $product->supplier_name }}</td>
                    <td>{{ $product->measure_name }}</td>

                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('product.show',$product->product_id) }}">Chi tiết
                            <i class="fas fa-info"></i></i></a>
                    </td>


                    {{-- <th class="fs-6 fw-normal border">
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#edit{{ $product->product_id }}">Chỉnh sửa
                            <i class="fas fa-user-edit"></i></button>
                    </th>

                    <th class="fs-6 fw-normal border">

                        <form action="{{ route('product-type.destroy',$product->product_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $product->product_id }}" class="btn btn-danger btn-sm"
                                type="submit">Xóa
                                <i class="far fa-trash-alt"></i></button>
                        </form>
                    </th> --}}
                </tr>

                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>



    {{-- Modal add --}}
    <div class="modal fade" id="add" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">
            <form action="{{ route('product.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm sản phẩm
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên sản phẩm</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="name" required />
                                </div>

                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Giá nhập</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="price" required />
                                </div>

                            </div>


                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Loại sản phẩm</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select" name="type" id="">
                                        @foreach ($productTypes as $productType)

                                        <option value="{{$productType->product_type_id }}">{{
                                            $productType->product_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên nhà cung cấp</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select" name="supplier" id="">
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->supplier_id }}">{{ $supplier->supplier_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Đơn vị</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select" name="measure" id="">
                                        @foreach ($measures as $measure)
                                        <option value="{{$measure->measure_id }}">{{ $measure->measure_name }}
                                        </option>
                                        @endforeach
                                    </select>
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



</section>




@endsection
