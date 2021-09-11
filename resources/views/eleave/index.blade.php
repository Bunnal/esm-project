@extends('layouts.master')
@section('title', 'Dashboard')
@section('title_page', 'Eleave approval')
@section('sidebar')
    @include('sidebar.eleave')
@endsection
@section('css')
  <link href="{{asset('css/admin/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <style>
    canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
</style>  
@endsection
@section('content')
{{-- <div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('messages.dashboard')</h1>
</div> --}}
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
    <!-- Leave Chart By Month -->
    <div class="col-xl-12 col-md-12 mb-4">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary text-uppercase">@lang('messages.leave_chart_by_monthly')</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
          <canvas id="myAreaChart" width="1155" height="320" class="chartjs-render-monitor" style="display: block; width: 1155px; height: 320px;"></canvas>
        </div>
         
        </div>
      </div>
    </div>
      <!-- Leave Apply By Departments-->
      <div class="col-xl-12 col-md-12 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary text-uppercase">@lang('messages.leave_apply_by_departments')(<?= $datetime->format('Y'); ?>) </h6>
        </div>
        <div class="card-body">
          <div  style="width:90%;">
            <canvas id="canvas"></canvas>
            </div>
        </div>
      </div>
    </div>
    <!-- end Leave Apply By Departments-->
  </div>
</div>
@endsection
@section('js') 
<script src="{{asset('js/ione/chart/Chart.min.js')}}"></script>
<script src="{{asset('js/ione/chart/Chart.bundle.js')}}"></script>
{{-- <script src="{{asset('js/ione/chart/utils.js')}}"></script> --}}
{{-- <script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script> --}}
<script src="http://www.chartjs.org/samples/latest/utils.js"></script>
<script>
  $(document).ready(function() {
    
  // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels:  <?php echo json_encode($Months); ?>,
    datasets: [{
      // label: "Earnings",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data:  <?php echo json_encode($Value); ?>,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
  }
});

});
</script>
<script>
  var chartdata = {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($Depts); ?>,
    // labels: month,
      datasets: [{
      label: 'leave',
      backgroundColor: '#26B99A',
      borderWidth: 1,
      data: <?php echo json_encode($Data); ?>
      }]
    }, //data 
  options: {
      scales: {
        yAxes: [{
          ticks: {
          beginAtZero:true
          }
        }]
      }
    } //option  
  }
  var ctx = document.getElementById('canvas').getContext('2d');
  new Chart(ctx, chartdata);
</script>
@endsection