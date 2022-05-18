@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm mới loại hóa đơn quỹ</h1>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add">Thêm mới</button>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('budget-invoice-type.store') }}" method="POST">
            @csrf
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên loại hóa đơn</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="name" required/>
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


