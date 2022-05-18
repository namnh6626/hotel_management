@extends('main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Giao ca</h1>
            </div>

        </div>



    </div>
</div>
<section class="content">
    <div class="container-fluid">



        <form action="{{ route('shift.finish') }}" method="get">
            @csrf

                    <table class="data-show row-border cell-border hover" id="bill-info">
                        <thead>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>

                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Tên nhân viên</label>
                                </th>
                                <td>

                                    {{auth()->user()->user_name }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    <label for="date" class="col-form-label">Email</label>
                                </th>
                                <td id="">
                                    {{auth()->user()->user_email }}
                                </td>
                            </tr>



                        </tbody>
                    </table>

            <div class="row py-3">
                <div class="col"></div>
                <div class="col d-flex">
                    <button type="submit" style="margin: 0 auto" class="btn btn-primary ">Giao ca</button>
                </div>
                <div class="col"></div>
            </div>


        </form>




    </div>


</section>

@endsection



