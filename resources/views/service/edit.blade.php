@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cập nhật thông tin dịch vụ</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('service.update',$service->service_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên dịch vụ</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " value="{{ $service->service_name }}" type="text" name="service_name" required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Giá(VND)</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" id="price" value="{{ number_format($service->service_price) }}"  name="price" onkeyup="formatToMoney('price')" required/>

                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Loại dịch vụ</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="service_type" id="">
                            <option value="{{ $service->service_type_id }}">{{ $service->service_type_name }}</option>
                            @foreach ($serviceTypes as $type)
                            @if ($service->service_type_id == $type->service_type_id)
                                @continue
                            @endif
                                <option value="{{ $type->service_type_id }}">{{ $type->service_type_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>


            </div>


            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Cập nhật</button>
                </div>
                <div class="col"></div>
        </form>
    </div>
    </div>


</section>

@endsection

