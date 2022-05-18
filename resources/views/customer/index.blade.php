@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách khách hàng</h1>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <a href="{{ route('customer.create') }}" class="btn btn-sm btn-primary">Thêm mới</a>
            </div>

        </div>
    </div>


</div>

<section class="content">
    <div class="container-fluid">
        <table class="datatable display text-center cell-border">
            <thead class="table-light text-center">
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-light text-center">

                @foreach ($customers as $customer)
                <tr class="">
                    <td>{{ $customer->cus_name }}</td>
                    <td>{{ $customer->genre_name}}</td>
                    <td data-sort="{{ $customer->date_of_birth }}">{{ date('d/m/Y', strtotime($customer->date_of_birth)) }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->cus_email }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('customer.show',$customer->cus_id) }}">Chi tiết
                            <i class="fas fa-info"></i></a>
                    </td>

                    {{-- <td>
                        <a class="btn btn-info btn-sm" href="{{ route('customer.edit',$customer->cus_id) }}">Chỉnh sửa
                            <i class="fas fa-user-edit"></i></a>
                    </td>

                    <td>

                        <form action="{{ route('customer.destroy',$customer->cus_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $customer->cus_id }}" class="btn btn-danger btn-sm" type="submit">Xóa
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
