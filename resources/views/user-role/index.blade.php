@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách chức vụ</h1>
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
                    <th>Tên chức vụ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($roles as $role)
                <tr class="">
                    <td>{{ $role->role_name }}</th>

                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#edit{{ $role->role_id }}">Chỉnh sửa
                            <i class="fas fa-edit"></i></button>
                            <a  class="btn btn-danger btn-sm delete" onclick="confirmDelete('Xác nhận xóa?', '', '', '#delete{{ $role->role_id }}')"><i
                                class="far fa-trash-alt"></i></a>
                            <form class="d-none" action="{{ route('role.destroy',$role->role_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button id="delete{{ $role->role_id }}" class="btn btn-danger btn-sm" type="submit">Xóa
                                    <i class="far fa-trash-alt"></i></button>
                            </form>
                    </th>


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
            <form action="{{ route('role.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm chức vụ
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên chức vụ</label>
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

    {{-- Modal edit --}}
    @foreach ($roles as $role)

    <div class="modal fade" id="edit{{ $role->role_id }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">

            <form action="{{ route('role.update', $role->role_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Cập nhật chức vụ
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên chức vụ</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " value="{{ $role->role_name }}" type="text" name="name" required />
                                </div>
                            </div>




                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Cập nhật</button>
                        <button type="button" class="btn btn-light" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Quay
                            lại</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    @endforeach

</section>




@endsection
