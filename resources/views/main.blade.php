<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý khách sạn</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">




    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/adminlte.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/alt/adminlte.components.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/alt/adminlte.core.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/alt/adminlte.extra-components.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/alt/adminlte.light.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/alt/adminlte.pages.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/alt/adminlte.plugins.min.css" />


    {{-- date picker --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    {{-- typeahead search --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>

    {{-- toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

    {{-- sweet alert --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.1/dist/sweetalert2.all.min.js"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- DataTable --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/date-1.1.1/kt-2.6.4/r-2.2.9/rg-1.1.4/sp-1.4.0/sl-1.3.4/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/date-1.1.1/kt-2.6.4/r-2.2.9/rg-1.1.4/sp-1.4.0/sl-1.3.4/datatables.min.js"
        defer></script>

    {{-- timepicker --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    {{-- <script src="https://cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>






    @yield('links')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            {{-- <!-- Brand Logo -->
            {{-- <a href="index3.html" class="brand-link">

            </a> --}}
            <a href="/room-diagram" class="brand-link text-center">
                Quản lý khách sạn
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <a href="{{ route('user-info') }}" class="d-block">
                        <div class="image">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/User-avatar.svg"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                    </a>
                    <div class="info">
                        <a href="{{ route('user-info') }}" class="d-block">{{ auth()->user()->user_name }}</a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('room.diagram') }}" class="nav-link ">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Sơ đồ phòng
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link ">
                                <i class="nav-icon fas fa-bed"></i>
                                <p>
                                    Quản lý phòng
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('room.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách phòng</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('booking.today-checkin') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách checkin hôm nay</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('booking.tomorrow-checkin') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách checkin ngày mai</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('booking.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách đặt phòng</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('bill.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Hóa đơn phòng</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('room.room-rented') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Phòng đang thuê</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('booking.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Đặt phòng</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('bill.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nhận phòng</p>
                                    </a>
                                </li>



                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Công suất phòng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.export') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Số lượng xuất kho</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Quản lý nhân viên
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách nhân viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm mới nhân viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('shift.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thống kê ca làm việc</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    Quản lý thu chi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('budget-invoice.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm mới hóa đơn</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('budget-invoice.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách hóa đơn</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon far fa-id-card"></i>
                                <p>
                                    Quản lý khách hàng
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('customer.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách khách hàng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('customer.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm mới khách hàng</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Thống kê
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/tables/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Tables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/tables/data.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DataTables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/tables/jsgrid.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>jsGrid</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-glass-martini-alt"></i>
                                <p>
                                    Quản lý dịch vụ
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('service.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm mới dịch vụ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('service.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách dịch vụ</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>
                                    Quản lý kho
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('warehouse-receipt.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách hóa đơn</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('warehouse-receipt.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm mới hóa đơn</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('product.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách tồn kho</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('shift.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-sync-alt"></i>
                                <p>
                                    Giao ca
                                </p>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Cấu hình
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('room.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm phòng mới</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('floor.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tầng khách sạn</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('measure.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Đơn vị nguyên liệu</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('service-type.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Loại dịch vụ</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('room-type.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Loại phòng</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('product-type.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Loại mặt hàng trong kho</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('supplier.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nhà cung cấp</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('shift-type.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Loại ca làm việc</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('budget.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quỹ khách sạn</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            {{-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0-rc
            </div> --}}
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        {{-- modal lg --}}
        @yield('modal')
    </div>
    <!-- ./wrapper -->
    @yield('script')


    <script type="text/javascript">
        $(document).ready(function(){
    $.datetimepicker.setLocale('vi');
    $('.datetimepicker').datetimepicker({
        autoclose:true,
        format: 'd/m/Y H:i',
        step:15,
    });

    $('.timedatetimepicker').datetimepicker({
        autoclose:true,
        datepicker:false,
        format: 'H:i',
        step:15,
    })


});


$(document).ready(function(){
    $('.datatable').DataTable({
        "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
        },
    });


    $('.data-show').DataTable({
        "language":{
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/vi.json"
        },
        paging:false,
        searching:false,
        info:false,
        ordering:false
    })
})



    $(document).ready(function(){
        $('#delete-link').on('click', function(){
            confirmDelete('Xác nhận xóa?', '', 'question', '#delete')
        })

        $('#cancel-link').on('click', function(){
            confirmCancel('Xác nhận hủy?', '', 'question', '#cancel')
        })
        // $('li a').on('click', function(){
        //     $("li a").removeClass("active");
        //     $(this).addClass('active')


        // })
        var i = 0
        $('ul li a').each(function() {
            var isActive = this.pathname === location.pathname;
            if($(this).attr('href') === window.location.href){

                $(this).addClass('active')
                $(this).parent().addClass('active')
                var liParent = $(this).parent().parent().parent()
                var a = liParent.find('a')[0]
                // console.log(a.pathname);
                if(a.pathname != '/room-diagram'){
                    a.classList.add('active')

                }
                // a.addClass('active')
                $(this).parent().parent().css('display','block')
                // console.log(liParent.find('a')[0])
            }
            // console.log($(this).attr('href'))
            // console.log(window.location.href)
            // $(this).parent().toggleClass('active', isActive);
        });
        // console.log(location.pathname);



    })

    function clickBtn(id){
        confirmDelete('Xác nhận xóa?', '', 'question', '#delete' + id)
    }
    //timepicker
    $('.timepicker').timepicker({
        zindex: 9999999,//insure work in modal
        timeFormat: 'HH:mm',
        interval: 15,
        minTime: '0',
        maxTime: '23',
        defaultTime: '00',
        startTime: '00:00',
        // dynamic: true,
        dropdown: true,
        scrollbar: false,
        forceRoundTime: true
    });

    // datepicker
    $(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                clearBtn: true,
                language: "vi",
                autoclose: true,
                todayHighlight: true,
                immediateUpdates:true,
                // startDate: date,
                weekStart:1

            });

            $('.datepicker').datepicker("setDate", new Date());
        });

    // class search
    var route = "{{ url('autocomplete-search') }}";
    $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    var arr = [];
                    data.forEach(element => {
                        var id = element.cus_id;
                        var name = element.cus_name;
                        var phone = element.phone;
                        var citizenId = element.citizen_id;
                        var push = id + ' - ' + name + ' - ' +  phone + ' - ' + citizenId;
                        arr.push(push);
                    });
                    return process(arr);
                });
            },
            updater:function (item) {
                var customerInfo = item.split(" - ")

                document.getElementById('customerId').setAttribute('value',customerInfo[0]);

                document.getElementById('customerName').innerHTML = customerInfo[1];
                document.getElementById('customerPhone').innerHTML = customerInfo[2];
                document.getElementById('customerCitizenId').innerHTML = customerInfo[3];
            }
        });

        var routeUser = "{{ url('autocomplete') }}"
        $('#search-user').typeahead({
            source: function (query, process) {
                return $.get(routeUser, {
                    query: query
                }, function (data) {
                    var arr = [];
                    console.log(data)
                    data.forEach(element => {
                        var id = element.user_id;
                        var name = element.user_name;
                        var phone = element.phone;
                        var email = element.user_email
                        var push = id + ' - ' + name + ' - ' +  phone + ' - ' + email;
                        arr.push(push);
                    });

                    return process(arr);
                });
            },
            updater:function (item) {
                var userInfo = item.split(" - ")

                document.getElementById('userId').setAttribute('value',userInfo[0]);

                document.getElementById('userName').innerHTML = userInfo[1];
                // document.getElementById('userPhone').innerHTML = userInfo[2];
                // document.getElementById('userEmail').innerHTML = userInfo[3];
            }
        });

        //sweet alert
    function clickAlert(title, text, background, icon){
            Swal.fire({
            title: title,
            toast:true,
            showConfirmButton:false,
            text: text,
            // type: 'error',
            position:'top',
            showCloseButton: true,
            background:background,
            icon:icon,
            timer:6000,
        })
        }

    function confirmDelete(title, text, icon, deleteBtnId){
            Swal.fire({
                title: title,
                background:"#fa4b3e",
                showConfirmButton:true,
                showCancelButton:true,
                text: text,
                position:'center',
                showCloseButton: true,
                icon:icon,
                confirmButtonText:'Xóa',
                cancelButtonText:"Quay lại",
                focusCancel:true,
            }).then((result) => {
                if(result.isConfirmed){
                    $(deleteBtnId).click();
                }
            });

    }

    function confirmCancel(title, text, icon, deleteBtnId){
            Swal.fire({
                title: title,
                background:"#fac506",
                color:"blue",
                showConfirmButton:true,
                showCancelButton:true,
                text: text,
                position:'center',
                showCloseButton: true,
                icon:icon,
                confirmButtonText:'Hủy',
                cancelButtonText:"Quay lại",
                focusCancel:true,
            }).then((result) => {
                if(result.isConfirmed){
                    $(deleteBtnId).click();
                }
            });

    }

        function formatToMoney(inputId){
            let inputValue = document.getElementById(inputId).value;
            let number = Number(inputValue.replace(/[^0-9.-]+/g,""));
            document.getElementById(inputId).value = new Intl.NumberFormat('vn-VN').format(number);
        }

        function repayMoney(totalId, customerPayId, repayId){
            let total = document.getElementById(totalId).value;
            let cusPayValue = document.getElementById(customerPayId).value;
            let cusPay = Number(cusPayValue.replace(/[^0-9.-]+/g,""));

            let valueRepay = cusPay - total;
            document.getElementById(repayId).value = new Intl.NumberFormat('vn-VN').format(valueRepay) + ' VND';
        }

        function deleteElement(rowId, inputId) {
            if(document.getElementById(inputId)){
                document.getElementById(inputId).remove();
            }
            document.getElementById(rowId).remove();

        }

        function orderTableRow(tableId){
        var rows = document.getElementById(tableId).querySelectorAll('tbody > tr');
        var order = 1
        if(rows.length > 0){
            rows.forEach(function(row){
                if(row.querySelectorAll('td,th').length > 1){
                    row.querySelector('td,th').innerHTML = order;
                }
                order++;
            })
        }
    }

    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/js/adminlte.min.js"
        integrity="sha512-pbrNMLSckfh8yEOr2o1RT+4zMU3Sj7+zP3BOY6nFVI/FLnjTRyubNppLbosEt4nvLCcdsEa8tmKhH3uqOYFXKg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- date picker --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.vi.min.js">
    </script>



    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- sweet alert --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"
        integrity="sha512-XVz1P4Cymt04puwm5OITPm5gylyyj5vkahvf64T8xlt/ybeTpz4oHqJVIeDtDoF5kSrXMOUmdYewE4JS/4RWAA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    {{-- bootstrap --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    {{-- datetimepicker --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
    <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
</body>

</html>
