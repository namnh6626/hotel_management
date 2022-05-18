@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Chi tiết hóa đơn quỹ</h1>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-primary" href="{{ route('budget-invoice.index') }}">Danh sách hóa đơn</a>
            </div>
            <div class="col d-flex justify-content-end ">
                <a href="{{ route('budget-invoice.edit', $budgetInvoice->budget_invoice_id) }}" class="btn btn-info btn-sm mr-2">Chỉnh sửa <i
                        class="fas fa-edit"></i></a>
                <a id="delete-link" href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                <form class="d-none" action="{{ route('budget-invoice.destroy', $budgetInvoice->budget_invoice_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="delete" type="submit"></button>
                </form>
            </div>
        </div>
    </div>


</div>

<section class="content">
    <div class="container-fluid">
        <table class="display data-show cell-border text-center">
            <thead class="border">
                <tr>
                    <th>Tên hóa đơn</th>
                    <th>Loại hóa đơn</th>
                    <th>Loại quỹ</th>
                    <th>Nhân viên</th>
                    <th>Số tiền</th>
                    <th>Ngày lập hóa đơn</th>

                </tr>
            </thead>
            <tbody class="border">

                <tr class="">
                    <td>{{ $budgetInvoice->budget_invoice_name }}</td>
                    <td>{{ $budgetInvoice->invoice_type->budget_invoice_type_name }}</td>
                    <td>{{ $budgetInvoice->budget_info->budget_name }}</td>
                    <td><a class="btn btn-success btn-sm" href="{{ route('user.show', $budgetInvoice->user_id) }}"> {{ $budgetInvoice->user_info->user_name }}</a></td>
                    <td>{{ number_format($budgetInvoice->amount_of_money) }}</td>
                    <td>{{ date_format(date_create($budgetInvoice->date_created_invoice),'d-m-Y H:i:s') }}</td>
                </tr>


            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>



@endsection
