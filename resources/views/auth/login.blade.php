@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>ESM </b>Login</a>
    </div>
    <!-- /.login-logo -->
    <div class="card  rounded">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="#" method="post">

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-info w-100 text-center mt-4 mb-4">Sign in</button>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection
