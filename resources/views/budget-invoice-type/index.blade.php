@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách loại hóa đơn quỹ</h1>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add">Thêm mới</button>
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
        <table class="display cell-border datatable text-center">
            <thead>
                <tr>
                    <th >Tên loại hóa đơn quỹ</th>
                    <th ></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($budgetInvoiceTypes as $type)
                <tr class="">
                    <td >{{ $type->budget_invoice_type_name }}</td>


                    <td >
                        <a class="btn btn-info btn-sm" href="{{ route('budget-invoice-type.edit',$type->budget_invoice_type_id) }}">Chỉnh sửa
                            <i class="fas fa-edit"></i></a>
                    </td>


                        {{-- <form action="{{ route('room-type.destroy',$type->budget_invoice_type_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $type->budget_invoice_type_id }}" class="btn btn-danger btn-sm delete" type="submit">Xóa
                                <i class="far fa-trash-alt"></i></button>
                        </form> --}}
                </tr>

                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>


    {{-- Modal add --}}
    <div class="modal fade" id="add" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">
            <form action="{{ route('budget-invoice-type.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm loại hóa đơn
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên loại hóa đơn</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="name" required />
                                </div>

                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Thêm mới</button>
                        <button type="button" class="btn btn-light" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Quay
                            lại</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
