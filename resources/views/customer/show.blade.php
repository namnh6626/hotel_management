@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thông tin chi tiết khách hàng</h1>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-primary" href="{{ route('customer.index') }}">Danh sách khách hàng</a>
            </div>
            <div class="col d-flex justify-content-end ">
                <a href="{{ route('customer.edit', $customer->cus_id) }}" class="btn btn-info btn-sm mr-2">Chỉnh sửa <i
                        class="fas fa-user-edit"></i></a>
                <a id="delete-link" href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                <form class="d-none" action="{{ route('customer.destroy', $customer->cus_id) }}" method="POST">
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
        <table class="data-show cell-border text-center">
            <thead class="table-light text-center">
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Số CMND/CCCD</th>
                    <th>Địa chỉ</th>

                </tr>
            </thead>
            <tbody class="table-light text-center">

                <tr class="">
                    <td>{{ $customer->cus_name }}</td>
                    <td>{{ $customer->genre_name }}</td>
                    <td>{{ date_format(date_create($customer->date_of_birth),'d-m-Y') }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->cus_email }}</td>
                    <td>{{ $customer->citizen_id }}</td>
                    <td>{{ $customer->address }}</td>
                </tr>

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>

@endsection
