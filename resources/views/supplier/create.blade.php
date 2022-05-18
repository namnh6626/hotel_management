@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm mới nhà cung cấp</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('supplier.store') }}" method="POST">
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


                <div class="row py-3">
                    <div class="col"></div>
                    <div class="col d-flex">
                        <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Thêm mới</button>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection


