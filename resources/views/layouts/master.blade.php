<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>ESM | @yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  {{-- <link rel="stylesheet" href="{{asset("fonts/all.min.css")}}"> --}}
  <!-- Theme style -->
  @yield('css')
  <link rel="stylesheet" href="{{asset("css/esmstyle.css")}}">
  <style>

  .brand-text {
      font-size: 1rem;
      font-weight: 800;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: .05rem;
  }
  </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('header.navbar')
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary">
    <a href="#" class="brand-link text-center text-uppercase font-weight-light"><h1 class="brand-text font-weight-light" style="font-size: 1.5rem;">@yield('title_page')</h1></a>
    @yield('sidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content pt-1 pb-2">
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
@yield('js')
</body>
</html>
