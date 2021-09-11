@extends('layouts.master')
@section('title', 'Eleave')
@section('title_page', 'Eleave')
@section('sidebar')
    @include('sidebar.eleave')
@endsection
@section('content')
<?php
$datetime = new DateTime('now', new DateTimeZone('Asia/Phnom_Penh'));
?> 
<div class="row">
    <!-- Departments  card -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <a href="{{route('leave')}}" class="text-xs font-weight-bold text-success text-uppercase nav-link">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-uppercase">@lang('messages.leave_apply_today')</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <p>{{ $countToday}}</p>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-chart-bar fa-2x mb-1 text-success" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Departments card -->
    <!-- Postion card -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <a  href="{{route('leave')}}" class="text-xs font-weight-bold text-primary text-uppercase  mb-1 nav-link">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-uppercase">@lang('messages.leave_apply_weekly')</div>
                <div class="row no-gutters align-items-center">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                  <p>{{$countWeekly}}</p>
                </div>
              </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-chart-area fa-2x mb-1 text-primary" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Position card -->
     <!-- Postion card -->
     <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <a  href="{{route('leave')}}" class="text-xs font-weight-bold text-info text-uppercase  mb-1 nav-link">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-uppercase">@lang('messages.leave_apply_monthly')</div>
                <div class="row no-gutters align-items-center">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                  <p>{{ $countMonthly }}</p>
                </div>
              </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-chart-line fa-2x mb-1 text-info" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
</div>
@endsection