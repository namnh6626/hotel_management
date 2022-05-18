@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm mới nhân viên</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="container-fluid">
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $error }}</strong>
                </div>
                @endforeach
                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên nhân viên</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="name" required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Số điện thoại</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="phone" required/>

                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Email</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="email" required/>

                    </div>

                </div>



                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Chức vụ</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="role" id="">
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>                    </div>

                </div>
                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="date" class="col-form-label">Mật khẩu</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" type="password" name="password"  required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="date" class="col-form-label">Nhập lại mật khẩu</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" type="password" name="password_confirmation"  required/>
                    </div>

                </div>

            </div>


            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Thêm mới</button>
                </div>
                <div class="col"></div>
            </div>
        </form>
    </div>


</section>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">
    $(function () {
        let date = new Date();
        date.setDate(date.getDate());
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            clearBtn: true,
            language: "vi",
            autoclose: true,
            todayHighlight: true,
            toggleActive: true,
            immediateUpdates:true,
            startDate: date,
            weekStart:1
        });

        $('.datepicker').datepicker("setDate", date);
    });

</script>

@endsection
