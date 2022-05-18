@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách nhân viên</h1>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row mb-2 ">

            <div class="col-md-4">
                <a class="btn btn-primary btn-sm" href="{{ route('user.create') }}">Thêm
                    mới</a>
            </div>

        </div>
    </div>

</div>

<section class="content">
    <div class="container-fluid">

        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
        </div>
        @endforeach
        <table class="display datatable text-center cell-border">
            <thead>
                <tr>
                    <th>Tên nhân viên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Chức vụ</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                <tr class="">
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->user_email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->role_name }}</td>
                    @if ($user->is_active)
                    <td>{{ 'Làm việc' }} </td>
                    @else
                    <td>{{ 'Nghỉ việc' }} </td>
                    @endif




                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('user.show', $user->user_id) }}">Chi tiết
                            <i class="fas fa-info"></i></a>
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
            <form action="{{ route('user.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm nhân viên
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên nhân viên</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="name" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Email</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="email" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Số điện thoại</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="phone" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Chức vụ</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select" name="role" id="">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->role_id }}">{{ $role->role_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Trạng thái</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select" name="is_active" id="">
                                        <option value="1">Làm việc</option>
                                        <option value="0">Nghỉ việc</option>
                                    </select>
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


</section>




@endsection
