<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>ESM | @yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
  {{-- <link rel="stylesheet" href="{{asset("fonts/all.min.css")}}"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("css/esmstyle.min.css")}}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('header.navbar')
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link text-center"><span class="brand-text font-weight-light">ESM</span></a>
    @include('sidebar.left_sidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('footer.master_footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset("js/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("js/esm.min.js")}}"></script>
</body>
</html>
