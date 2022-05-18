@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Chi tiết nhân viên</h1>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row mb-2 ">

            <div class="col-md-4">
                <a class="btn btn-primary btn-sm" href="{{ route('user.index') }}">Danh sách nhân viên</a>
            </div>

        </div>
    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="table table-hover border fs-6 fw-normal">
            <thead class="table-light text-center">
                <tr>
                    <th class="fs-6 fw-normal border">Tên nhân viên</th>
                    <th class="fs-6 fw-normal border">Email</th>
                    <th class="fs-6 fw-normal border">Số điện thoại</th>
                    <th class="fs-6 fw-normal border">Chức vụ</th>
                    <th class="fs-6 fw-normal border">Trạng thái</th>
                    <th class="fs-6 fw-normal border"></th>
                    <th class="fs-6 fw-normal border"></th>
                </tr>
            </thead>
            <tbody class="table-light text-center">

                <tr class="">
                    <th class="fs-6 fw-normal border">{{ $user->user_name }}</th>
                    <th class="fs-6 fw-normal border">{{ $user->user_email }}</th>
                    <th class="fs-6 fw-normal border">{{ $user->phone }}</th>
                    <th class="fs-6 fw-normal border">{{ $user->role_name }}</th>
                    @if ($user->is_active)
                    <th class="fs-6 fw-normal border">{{ 'Làm việc' }} </th>
                    @else
                    <th class="fs-6 fw-normal border">{{ 'Nghỉ việc' }} </th>
                    @endif





                    <th class="fs-6 fw-normal border">
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#edit{{ $user->user_id }}">Chỉnh sửa
                            <i class="fas fa-user-edit"></i></button>
                    </th>

                    <th class="fs-6 fw-normal border">
                        <a  class="btn btn-danger btn-sm delete" onclick="confirmDelete('Xác nhận xóa?', '', '', '#delete{{ $user->user_id }}')"><i
                            class="far fa-trash-alt"></i></a>
                        <form class="d-none" action="{{ route('user.destroy',$user->user_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $user->user_id }}" class="btn btn-danger btn-sm" type="submit">Xóa
                                <i class="far fa-trash-alt"></i></button>
                        </form>
                    </th>
                </tr>


            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>





    {{-- Modal edit --}}

    <div class="modal fade" id="edit{{ $user->user_id }}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">

            <form action="{{ route('user.update', $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Cập nhật thông tin nhân viên
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên nhân viên</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " value="{{ $user->user_name }}" type="text" name="name" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Email</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " value="{{ $user->user_email }}" type="text" name="email" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Số điện thoại</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " value=" {{ $user->phone }}" type="text" name="phone" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Chức vụ</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select" name="role" id="">
                                        <option value="{{ $user->role_id }}">{{ $user->role_name }}</option>

                                        @foreach ($roles as $role)
                                        @if ($role->role_id == $user->role_id)
                                        @continue
                                        @endif
                                        <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
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
                                        @if ($user->is_active)
                                        <option value="1">Làm việc</option>
                                        <option value="0">Nghỉ việc</option>
                                        @else
                                        <option value="0">Nghỉ việc</option>
                                        <option value="1">Làm việc</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Mật khẩu</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="password" name="password" required />
                                </div>
                            </div>

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Nhập lại mật khẩu</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="password" name="password_confirm" required />
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


</section>




@endsection
