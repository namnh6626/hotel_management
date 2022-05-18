@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách hóa đơn quỹ</h1>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('budget-invoice.create') }}" class="btn btn-sm btn-primary" >Thêm mới</a>
            </div>
        </div>
    </div>


</div>

<section class="content">
    <div class="container-fluid">
        <table class="display datatable text-center cell-border">
            <thead>
                <tr>
                    <th>Tên hóa đơn</th>
                    <th>Loại hóa đơn</th>
                    <th>Loại quỹ</th>
                    <th>Nhân viên</th>
                    <th>Ngày lập hóa đơn</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($budgetInvoices as $budgetInvoice)
                <tr class="">
                    <td>{{ $budgetInvoice->budget_invoice_name }}</td>
                    <td>{{ $budgetInvoice->budget_invoice_type_name }}</td>
                    <td>{{ $budgetInvoice->budget_name }}</td>
                    <td>{{ $budgetInvoice->user_name }}</td>
                    <td data-sort="{{ $budgetInvoice->date_created_invoice }}">{{ date("d/m/Y H:i:s",strtotime($budgetInvoice->date_created_invoice)) }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('budget-invoice.show',$budgetInvoice->budget_invoice_id) }}">Chi tiết
                            <i class="fas fa-info"></i></a>
                    </td>

                    {{-- <td>
                        <a class="btn btn-info btn-sm" href="{{ route('budget-invoice.edit',$budgetInvoice->budget_invoice_id) }}">Chỉnh sửa
                            <i class="fas fa-user-edit"></i></a>
                    </td> --}}

                    {{-- <td>

                        <form action="{{ route('budget-invoice.destroy',$budgetInvoice->budget_invoice_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $budgetInvoice->budget_invoice_id }}" class="btn btn-danger btn-sm" type="submit">Xóa
                                <i class="far fa-trash-alt"></i></button>
                        </form>
                    </td> --}}
                </tr>

                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>



@endsection
