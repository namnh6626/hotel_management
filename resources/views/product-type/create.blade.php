@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm mới khách hàng</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên khách hàng</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="cus_name" required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Ngày sinh</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group date datepicker">
                            <input type="text" class="form-control form-control-sm"
                            name="date_of_birth" required  >
                            <span class="input-group-append">
                                <span class="input-group-text bg-white">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Giới tính</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="genre" id="">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->genre_id }}">{{ $genre->genre_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>



                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Số điện thoại</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="tel" name="phone" required/>
                    </div>

                </div>
                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="date" class="col-form-label">Email</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" type="email" name="cus_email"  required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="date" class="col-form-label">Số CMND/CCCD</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" type="number" name="citizen_id"
                             required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Địa chỉ</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="address"  />
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

