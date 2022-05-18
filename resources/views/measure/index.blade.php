@extends('main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Danh sách đơn vị</h1>
            </div>

        </div>
    </div>
    <div class="container-fluid">

        <div class="row mb-2 ">

            <div class="col-md-4">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add" type="button">Thêm
                    mới</button>
            </div>

        </div>

    </div>

</div>

<section class="content">
    <div class="container-fluid">
        <table class="datatable display cell-border text-center">
            <thead>
                <tr>
                    <th>Tên đơn vị</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($measures as $measure)
                <tr class="">
                    <td>{{ $measure->measure_name }}</td>
                    <td class="d-flex justify-content-center">
                        <button class="btn btn-info btn-sm mr-2" data-bs-toggle="modal"
                            data-bs-target="#edit{{ $measure->measure_id }}">Chỉnh sửa
                            <i class="fas fa-edit"></i></button>
                        <a id="delete-link{{ $measure->measure_id }}" href="#" class="btn btn-danger btn-sm" onclick="clickBtn('{{ $measure->measure_id }}')"><i class="far fa-trash-alt"></i></a>
                        <form class="d-none" action="{{ route('measure.destroy', $measure->measure_id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="delete{{ $measure->measure_id }}" type="submit"></button>
                        </form>
                    </td>


                </tr>

                @endforeach

            </tbody>
        </table>

        <div class="row py-4">
        </div>
    </div>

    {{-- Modal add --}}
    <div class="modal fade" id="add" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">

            <form action="{{ route('measure.store') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Thêm đơn vị
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên đơn vị</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control " type="text" name="name" required />
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Quay
                            lại</button>
                        <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Thêm mới</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal edit --}}
    @foreach ($measures as $measure)

    <div class="modal fade" id="edit{{ $measure->measure_id }}" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-top modal-lg">

            <form action="{{ route('measure.update', $measure->measure_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Cập nhật thông tin đơn vị
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="row py-3 align-items-center">

                                <div class="col-md-3">
                                    <label for="text" class="col-form-label">Tên đơn vị</label>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" value="{{ $measure->measure_name }}" type="text"
                                        name="name" required />
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Quay
                            lại</button>
                        <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal"
                            onclick="">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endforeach

</section>




@endsection

@section('script')

<script type="text/javascript">


</script>
@endsection
