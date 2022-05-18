<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng nhập</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/adminlte.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/alt/adminlte.core.min.css" /></head>
{{-- <style>
    body {
        background-image: url("https://i.ibb.co/CmHsgcB/bg.jpg");
        background-color: #cccccc;
    }
</style> --}}
<body class="hold-transition login-page" style="background-image: url('https://i.ibb.co/CmHsgcB/bg.jpg'); height: 412px;background-size: cover;">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
      <h2 class="lead display-5 text-center">Hệ thống quản lý khách sạn</h2>
    <div class="card-body login-card-body">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
        </div>
        @endforeach
      <form action="{{ route('auth') }}" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="email_phone" placeholder="Email">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">

            <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">

          <!-- /.col -->
          <div class="col-6 d-flex justify-content-center">
            @csrf
            <button class="btn btn-primary" type="submit">Đăng nhập</button>          </div>
          <!-- /.col -->
        </div>
      </form>


      <!-- /.social-auth-links -->


    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
{{-- <script src="../../plugins/jquery/jquery.min.js"></script> --}}
<!-- Bootstrap 4 -->
{{-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
<!-- AdminLTE App -->

</body>
</html>
