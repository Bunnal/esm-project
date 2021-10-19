
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EMS Project</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <link rel="stylesheet" href="{{asset("css/esmstyle.min.css")}}">
    @yield('css')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <span class="brand-text font-weight-light">EApproval Management System</span>
      </a>
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown">
          <a class="" data-toggle="dropdown" href="#">
            <div class="user-panel mr-3">
              <div class="image">
                {{-- <img src="https://i1.sndcdn.com/avatars-6H5MKgzDgzDNhDUW-L2oatw-t500x500.jpg" class="img-circle" alt="User Image"> --}}
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
            <a href="{{route('logout')}}" class="dropdown-item"><i class="fas fa-power-off mr-3"></i>Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
       @yield('content')
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
