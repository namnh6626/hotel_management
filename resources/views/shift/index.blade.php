@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách ca làm việc</h1>
            </div>

        </div>
    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="display datatable cell-border text-center">
            <thead>
                <tr>
                    <th>Loại ca làm việc</th>
                    <th>Nhân viên</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Thời gian kết thúc</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($shifts as $shift)
                <tr class="">

                    <td>{{ $shift->shift_type_name }}</td>
                    <td><a class="btn btn-sm btn-success" href="{{ route('user.show', $shift->user_id) }}">{{ $shift->user_info->user_name }}</a></td>
                    <td data-sort="{{ $shift->date_start }}">{{ date('d/m/Y H:i', strtotime($shift->date_start)) }}</td>
                    <td data-sort="{{ $shift->date_finish }}">{{ date('d/m/Y H:i', strtotime($shift->date_finish)) }}</td>


                    <td class="d-flex justify-content-center">
                        <a class="btn btn-info btn-sm mr-2"
                            href="{{ route('shift.edit', $shift->shift_id) }}">Chỉnh
                            sửa
                            <i class="fas fa-edit"></i></a>
                        <a  class="btn btn-danger btn-sm delete" onclick="confirmDelete('Xác nhận xóa?', '', '', '#delete{{ $shift->shift_id }}')"><i
                                class="far fa-trash-alt"></i></a>
                        <form style="display: none" action="{{ route('shift.destroy', $shift->shift_id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $shift->shift_id }}" class="btn btn-danger btn-sm delete" type="submit"></button>
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
