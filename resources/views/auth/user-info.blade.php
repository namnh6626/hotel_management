@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thông tin cá nhân</h1>
            </div>

        </div>
        <div class="row">
            <div class="col">
            </div>
            <div class="col d-flex justify-content-end ">
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm mr-2">Đăng xuất <i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>


    </div>
</div>
<section class="content">
    <div class="container-fluid">



        <form action="{{ route('user.update', auth()->id()) }}" method="POST">
            @method('put')
            @csrf

                    <table class="data-show row-border cell-border hover" id="bill-info">
                        <thead>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }} <i class="fa-solid fa-exclamation bg-danger"></i></p>
                            @endforeach
                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Tên nhân viên</label>
                                </th>
                                <td>

                                    <input type="text" class="form-control" id="customerId" name="name" value="{{auth()->user()->user_name }}">
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Email</label>
                                </th>
                                <td id="">
                                    <input type="text" class="form-control" id="customerId" name="email" value="{{auth()->user()->user_email }}">
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Số điện thoại</label>
                                </th>
                                <td id="">
                                    <input type="text" class="form-control" id="customerId" name="phone" value="{{auth()->user()->phone }}">
                                </td>
                            </tr>

                        </tbody>
                    </table>

            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Cập nhật</button>
                </div>
                <div class="col"></div>
            </div>


        </form>




    </div>


</section>

@endsection



