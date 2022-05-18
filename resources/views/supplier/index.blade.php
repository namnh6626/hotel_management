@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách nhà cung cấp</h1>
            </div>

        </div>
    </div>
    <div class="container-fluid">

        <div class="row mb-2 ">

            <div class="col-md-4">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add" type="button">Thêm
                 mới</button>
            </div>

        </div>

    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="datatable display cell-border text-center">
            <thead>
                <tr>
                    <th>Tên nhà cung cấp</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($suppliers as $supplier)
                <tr class="">
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->supplier_phone }}</td>
                    <td>{{ $supplier->supplier_address }}</td>


                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#edit{{ $supplier->supplier_id }}">Chỉnh sửa
                            <i class="fas fa-edit"></i></button>
                    </td>

                    <td>
                        <a  class="btn btn-danger btn-sm delete" onclick="confirmDelete('Xác nhận xóa?', '', '', '#delete{{ $supplier->supplier_id }}')"><i
                            class="far fa-trash-alt"></i></a>
                        <form class="d-none" action="{{ route('supplier.destroy',$supplier->supplier_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $supplier->supplier_id }}" class="btn btn-danger btn-sm"
                                type="submit">
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

    {{-- Modal add --}}
    <div class="modal fade" id="add" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">

            <form action="{{ route('supplier.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm nhà cung cấp
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên nhà cung cấp</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="name" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Số điện thoại</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="tel" name="phone" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Địa chỉ</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="address" required />
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
    @foreach ($suppliers as $supplier)

    <div class="modal fade" id="edit{{ $supplier->supplier_id }}" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">

            <form action="{{ route('supplier.update', $supplier->supplier_id) }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Cập nhật thông tin nhà cung cấp
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên nhà cung cấp</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value="{{ $supplier->supplier_name }}" type="text" name="name" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Số điện thoại</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value="{{ $supplier->supplier_phone }}" type="tel" name="phone" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Địa chỉ</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " value="{{ $supplier->supplier_address }}" type="text" name="address" required />
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

@section('script')

<script type="text/javascript">


</script>
@endsection
