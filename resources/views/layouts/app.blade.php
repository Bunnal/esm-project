<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> ESM | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- Font Awesome Icons -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
 {{-- <link rel="stylesheet" href="{{asset("fonts/all.min.css")}}"> --}}
 <!-- Theme style -->
 <link rel="stylesheet" href="{{asset("css/esmstyle.min.css")}}">
 <style>
   .login-page{
     background-color:#f8f8fb !important;
   }
 </style>

</head>
<body class="hold-transition login-page">
    @yield('content')
<!-- jQuery -->
<script src="{{asset("js/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("js/esm.min.js")}}"></script>

</body>
</html>
