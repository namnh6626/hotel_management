@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách dịch vụ</h1>
            </div>

        </div>
    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="display datatable cell-border text-center">
            <thead>
                <tr>
                    <th>Tên dịch vụ</th>
                    <th>Giá(VND)</th>
                    <th>Loại dịch vụ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($services as $service)
                <tr class="">

                    <td>{{ $service->service_name }}</td>
                    <td>{{ number_format($service->service_price) }}</td>
                    <td>{{ $service->service_type_name }}</td>



                    <td class="d-flex justify-content-center">
                        <a class="btn btn-info btn-sm mr-2"
                            href="{{ route('service.edit', $service->service_id) }}">Chỉnh
                            sửa
                            <i class="fas fa-edit"></i></a>
                        <a  class="btn btn-danger btn-sm delete" onclick="confirmDelete('Xác nhận xóa?', '', '', '#delete{{ $service->service_id }}')"><i
                                class="far fa-trash-alt"></i></a>
                        <form style="display: none" action="{{ route('service.destroy', $service->service_id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $service->service_id }}" class="btn btn-danger btn-sm delete" type="submit"></button>
                        </form>

                    </td>


                </tr>

                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>
</section>


@endsection
