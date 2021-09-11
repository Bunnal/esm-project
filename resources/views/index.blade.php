@extends('layouts.main-master')
@section('title', 'Dashboard')
{{-- @section('sidebar')
    @include('sidebar.left_sidebar')
@endsection --}}
@section('content')
<div class="row">

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <a href="{{route("eleave")}}">
        <div class="small-box bg-info">
          <div class="inner"><h3>150</h3><p>Leave approval</p></div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </a>
    </div>

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
    </div>

</div>
@endsection