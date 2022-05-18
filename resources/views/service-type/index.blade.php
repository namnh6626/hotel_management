@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách loại dịch vụ</h1>
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
        <table class="display datatable cell-border text-center">
            <thead>
                <tr>
                    <th>Tên loại dịch vụ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($serviceTypes as $type)
                <tr class="">

                    <td>{{ $type->service_type_name }}</td>

                    <td class="d-flex justify-content-center">

                        <a class="btn btn-info btn-sm mr-2"
                            href="{{ route('service-type.edit', $type->service_type_id) }}">Chỉnh
                            sửa
                            <i class="fas fa-edit"></i></a>
                        <a  class="btn btn-danger btn-sm delete" onclick="confirmDelete('Xác nhận xóa?', '', '', '#delete{{ $type->service_type_id }}')"><i
                                class="far fa-trash-alt"></i></a>
                        <form style="display: none" action="{{ route('service-type.destroy', $type->service_type_id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $type->service_type_id }}" class="btn btn-danger btn-sm delete" type="submit"></button>
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


{{-- Modal add --}}
<div class="modal fade" id="add" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-top modal-lg">

        <form action="{{ route('service-type.store') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm loại dịch vụ
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="container-fluid">

                        <div class="row py-3 align-items-center">

                            <div class="col-md-3">
                                <label for="text" class="col-form-label">Tên loại dịch vụ</label>
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
                    <button type="button" class="btn btn-light" data-bs-target="" data-bs-toggle="modal" onclick="">Quay
                        lại</button>

                </div>
            </div>
        </form>
    </div>
</div>


@endsection
