@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách hóa đơn</h1>
            </div>

        </div>
    </div>
    {{-- <div class="container-fluid">
        <form action="{{ route('customer.search') }}" method="GET">
            <div class="row mb-2 ">
                <div class="col-md-4">
                    <input class="form-control form-control-sm" name="search" type="text" placeholder="Search">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-sm" type="submit">Tìm kiếm</button>
                </div>

            </div>
            @csrf
        </form>
    </div> --}}

</div>

<section class="content">
    <div class="container-fluid">


        <div class="row py-4">
            <table class="display cell-border datatable text-center" id="datatable">
                <thead>
                    <tr>
                        <th>Tên hóa đơn</th>
                        <th>Ngày thanh toán</th>
                        <th>Tên khách hàng</th>
                        <th>Nhân viên</th>
                        <th>Ghi chú</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-light text-center">
                    @foreach ($bills as $bill)
                    <tr class="">
                        <td data-sort="{{ $bill->bill_id }}">{{ $bill->bill_name }}</td>
                        <td data-sort="{{ $bill->date_payment }}">
                            @if ($bill->date_payment)
                            {{ date('d/m/Y H:i', strtotime($bill->date_payment)) }}
                            @else
                                {{ "" }}
                            @endif
                        </td>
                        <td>{{ $bill->cus_info->cus_name }}</td>
                        <td>{{ $bill->user_info->user_name }}</td>

                        <td>{{ $bill->note }}</td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('bill.show', $bill->bill_id) }}">Chi tiết
                                <i class="fas fa-info"></i></a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="row py-4">
        </div>
    </div>
</section>

@endsection



