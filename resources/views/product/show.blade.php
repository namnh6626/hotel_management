@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thông tin chi tiết sản phẩm</h1>
            </div>

        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col"> <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm">Danh sách sản phẩm</a></div>
            <div class="col">
            </div>
            <div class="col d-flex justify-content-end">
               <div class="px-2">
                <button class="btn btn-info btn-sm " data-bs-toggle="modal"
                data-bs-target="#edit{{ $product->product_id }}">Chỉnh sửa
                <i class="fas fa-edit"></i></button>
               </div>
                <a id="delete-link" href="#" class="btn btn-danger btn-sm delete"><i class="far fa-trash-alt"></i></a>
                <form style="display: none" action="{{ route('product.destroy', $product->product_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="delete" class="btn btn-danger btn-sm delete"
                        type="submit"></button>
                </form>
            </div>

        </div>



    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="display data-show cell-border row-border text-center">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá nhập(VND)</th>
                    <th>Số lượng trong kho</th>
                    <th>Loại sản phẩm</th>
                    <th>Nhà cung cấp</th>
                    <th>Đơn vị</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ number_format($product->import_price) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->product_type_name }}</td>
                    <td>{{ $product->supplier_name }}</td>
                    <td>{{ $product->measure_name }}</td>
                </tr>

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>

{{-- modal edit --}}
<div class="modal fade" id="edit{{ $product->product_id }}" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-top modal-lg">

        <form action="{{ route('product.update', $product->product_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Cập nhật thông tin loại sản phẩm
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row py-3 align-items-center">

                            <div class="col-md-3">
                                <label for="text" class="col-form-label">Tên sản phẩm</label>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control " value="{{ $product->product_name }}" type="text" name="name" required />
                            </div>

                        </div>

                        <div class="row py-3 align-items-center">

                            <div class="col-md-3">
                                <label for="text" class="col-form-label">Giá nhập(VND)</label>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control " value="{{ number_format($product->import_price) }}" type="text" name="price" id="price" required onkeyup="formatToMoney('price')" />
                            </div>

                        </div>

                        <div class="row py-3 align-items-center">

                            <div class="col-md-3">
                                <label for="text" class="col-form-label">Số lượng</label>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control " value="{{ $product->quantity }}" type="number" name="quantity" min="0" step="0.1" required />
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
@endsection
