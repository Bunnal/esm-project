@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>ESM </b>Project</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body rounded-lg shadow-md">
        <p class="login-box-msg">Sign in</p>
        @if (session('msg'))
            <div class="alert alert-danger" role="alert">
                {{session('msg')}}
            </div>
        @endif
        <form action="{{route('login.action')}}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" value = "{{old('email')}}" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
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
