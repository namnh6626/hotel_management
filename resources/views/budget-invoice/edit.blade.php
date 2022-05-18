@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cập nhật thông tin hóa đơn quỹ</h1>
            </div>

        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">


        <form action="{{ route('budget-invoice.update',  $budgetInvoice->budget_invoice_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid">

                <div class="row py-2">
                    <div class="col-4">
                        <label for="text" class="col-form-label">Tìm nhân viên</label>

                    </div>

                    <div class="col-6 ms-3">
                        <input type="text" id="search-user" class="form-control">
                    </div>
                </div>


                </tr>
                <input type="hidden" id="userId" name="user_id" value="{{ $budgetInvoice->user_id }}">

                <table class="data-show cell-border">
                    <thead class="d-none">
                        <th></th>
                        <th></th>
                    </thead>
                    <tr>
                        <th>
                            <label for="text" class="col-form-label">Tên hóa đơn</label>
                        </th>
                        <td>
                            {{ $budgetInvoice->budget_invoice_name }}
                        </td>
                    </tr>

                    <tr>

                        <th>
                            <label for="text" class="col-form-label">Tên nhân viên</label>
                        </th>
                        <td id="userName">
                            {{ $budgetInvoice->user_info->user_name }}
                        </td>

                    </tr>

                    <tr>

                        <th>
                            <label for="text" class="col-form-label">Loại hóa đơn</label>
                        </th>
                        <td>
                            <select class="form-select" name="invoice_type" id="">
                                <option value="{{ $budgetInvoice->budget_invoice_type_id }}">{{
                                    $budgetInvoice->budget_invoice_type_name }}</option>

                                @foreach ($budgetInvoiceTypes as $budgetInvoiceType)

                                @if ($budgetInvoiceType->budget_invoice_type_id ==
                                $budgetInvoice->budget_invoice_type_id)
                                @continue
                                @endif

                                <option value="{{$budgetInvoiceType->budget_invoice_type_id }}">{{
                                    $budgetInvoiceType->budget_invoice_type_name }}</option>
                                @endforeach
                            </select>
                        </td>


                    </tr>

                    <tr>

                        <th>
                            <label for="text" class="col-form-label">Loại quỹ</label>
                        </th>
                        <td>
                            <select class="form-select" name="budget_type" id="">
                                <option value="{{ $budgetInvoice->budget_id }}">{{ $budgetInvoice->budget_name }}
                                </option>

                                @foreach ($budgets as $budget)

                                @if ($budget->budget_id == $budgetInvoice->budget_id)
                                @continue
                                @endif

                                <option value="{{$budget->budget_id }}">{{ $budget->budget_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>

                        <th>
                            <label for="text" class="col-form-label">Số tiền(VND)</label>
                        </th>
                        <td>
                            <input class="form-control" id="amount" name="amount"
                                value="{{ number_format($budgetInvoice->amount_of_money) }}"
                                onkeyup="formatToMoney('amount')" required />
                        </td>
                    </tr>



                    <tr>

                        <th>
                            <label for="text" class="col-form-label">Ghi chú</label>
                        </th>
                        <td>
                            <input class="form-control " value="{{ $budgetInvoice->invoice_note }}" type="text"
                                name="note" required />
                        </td>
                    </tr>
                </table>

            </div>


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
