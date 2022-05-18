@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thêm mới hóa đơn quỹ</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('budget-invoice.store') }}" method="POST">
            @csrf
            <div class="container-fluid">



                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Tên nhân viên</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " value="{{ auth()->user()->user_name }}" type="text"
                            name="" readonly />
                    </div>

                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Loại hóa đơn</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="invoice_type" id="">
                            @foreach ($budgetInvoiceTypes as $budgetInvoiceType)
                            <option value="{{$budgetInvoiceType->budget_invoice_type_id }}">{{ $budgetInvoiceType->budget_invoice_type_name }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Loại quỹ</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-select" name="budget_type" id="">
                            @foreach ($budgets as $budget)
                            <option value="{{$budget->budget_id }}">{{ $budget->budget_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Số tiền(VND)</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" id="amount"  name="amount" onkeyup="formatToMoney('amount')" required/>

                    </div>
                </div>



                <div class="row py-3 align-items-center">

                    <div class="col-md-3">
                        <label for="text" class="col-form-label">Ghi chú</label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control " type="text" name="note" required/>
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

@endsection
