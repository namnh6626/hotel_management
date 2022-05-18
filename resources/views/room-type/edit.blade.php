@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cập nhật loại phòng</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('room-type.update',$roomType->room_type_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên loại phòng</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" value="{{ $roomType->type_name }}" name="type_name" required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Giá(VND)</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" id="price" value="{{ number_format($roomType->price) }}" name="price" onkeyup="formatToMoney('price')" required/>

                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Số khách</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" value="{{ $roomType->guest_number }}" type="number" name="guest_number" required/>

                    </div>

                </div>



                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Mô tả</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " value="{{ $roomType->room_des }}" type="text" name="description" required/>
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

