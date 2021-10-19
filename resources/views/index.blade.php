@extends('layouts.main-master')
@section('title', 'Dashboard')
@section('css')
    <style>
      .h-90{
        height: 90%;
      }
    </style>
{{-- @section('sidebar')
    @include('sidebar.left_sidebar')
@endsection --}}
@section('content')
<div class="row">

    <div class="col-lg-3 col-12">
      <a href="{{route("eleave")}}">
        <div class="small-box callout callout-info h-90">
          <div class="inner text-info text-uppercase"><b>ELeave</b></div>
          <div class="icon">
            <i class="far fa-file-word text-info mt-2" style="font-size: 25px"></i>
          </div>
        </div>
      </a>
    </div>
{{-- 
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>

          <p>Contract approval</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>44</h3>

          <p>Payment approval</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>

          <p>Borrow items approval</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div> --}}

</div>
@endsection