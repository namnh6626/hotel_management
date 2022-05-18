@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cập nhật thông tin khách hàng</h1>
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
        <form action="{{ route('customer.update',$customer->cus_id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="container-fluid">

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên khách hàng</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="cus_name" value="{{ $customer->cus_name }}" required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Giới tính</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="genre" id="">
                            @if ($customer->genre_id)
                                <option value="{{ $customer->genre_id }}">{{ $customer->genre_name }}</option>
                            @endif
                            @foreach ($genres as $genre)
                            @if ($genre->genre_id == $customer->genre_id)
                                @continue;
                            @endif
                                <option value="{{ $genre->genre_id }}">{{ $genre->genre_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Ngày sinh</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group date datepicker" id="checkin">
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
                        <label for="text" class="col-form-label">Số điện thoại</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="tel" name="phone" value="{{ $customer->phone }}" required/>
                    </div>

                </div>
                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="date" class="col-form-label">Email</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" type="email" name="cus_email" value="{{ $customer->cus_email }}" required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="date" class="col-form-label">Số CMND/CCCD</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" type="number" name="citizen_id"
                            value="{{ $customer->citizen_id }}" required/>
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Địa chỉ</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="address" value="{{ $customer->address }}" required/>
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


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">
    let customer = {!! json_encode($customer) !!};
    $(function () {
        let date
        if(customer.date_of_birth){
            date = new Date(customer.date_of_birth)
            console.log(date);
        }else{
             date = new Date();
        }
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
