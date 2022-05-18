@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm mới dịch vụ</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('service.store') }}" method="POST">
            @csrf
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên dịch vụ</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="service_name" required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Giá(VND)</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" id="price"  name="price" onkeyup="formatToMoney('price')" required/>

                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Loại dịch vụ</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="service_type" id="">
                            @foreach ($serviceTypes as $type)
                                <option value="{{ $type->service_type_id }}">{{ $type->service_type_name }}</option>
                            @endforeach
                        </select>
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

