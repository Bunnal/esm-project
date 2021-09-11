@extends('layouts.main-master')
@section('title', 'Report | Dashboard ')
@section('css')
<link href="{{asset('css/admin/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('css/ione/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<style>
    .pull-right {
       margin-top: 10px;
        float: right;
    }
   .btn-cancel{
    position: absolute;
        bottom: 30px;
        right: 20px;
        width: 200px;
   }
  </style>
@endsection
@section('sidebar')
    @include('sidebar.eleave')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/eleave">@lang('messages.dashboard')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('messages.report')</li>
        </ol>
    </nav>
<div class="card shadow mb-4">
    <div class="card-header py-3">
       @lang('messages.report_take_leave_search_by_name')
    </div>
    <br>
    <div class="card-body">
        <div class="col-lg-8">
            <form action="{{('searchbyusername')}}" method="post"> 
              @csrf
                <div class="form-row align-items-center">
                    <div class="col-sm-3 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">@lang('messages.start_date')</label>
                          <div class="input-group date ">
                              <input type="text" class="form-control" name="startdate" id="from" placeholder="yyyy-mm-dd" @if($startdate != '') value="{{$startdate}}" @endif required/>
                              <div class="input-group-append icondate">
                                  <div class="input-group-text"><i class="fa fa-calendar inline_btn"></i></div>
                              </div>
                          </div>
                    </div>
                  <div class="col-sm-3 my-1">
                      <label class="sr-only" for="inlineFormInputGroupUsername">@lang('messages.end_date')</label>
                      <div class="input-group date ">
                          <input type="text" class="form-control" name="enddate" id="to" placeholder="yyyy-mm-dd" @if($enddate != '') value="{{$enddate}}" @endif required/>
                          <div class="input-group-append icondate_to">
                              <div class="input-group-text"><i class="fa fa-calendar inline_btn"></i></div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-3 my-1">
                    <label class="sr-only" for="inlineFormInputGroupUsername">@lang('messages.user_name')</label>
                    <div class="input-group">
                      <select name="user_id"  class="form-control" @if($username != '') value="{{$username}}" @endif required>
                        @foreach( $users as $user)
                         <option @if($user->id == $username) selected @endif value="{{$user->id}}">{{$user->username}}</option>
                        @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">@lang('messages.search')</button>
                  </div>
                  <div class="col-auto my-1">
                    <button class="btn btn-success export_to_excel">@lang('messages.export')</button>
                  </div>
                </div>
              </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>@lang('messages.no.')</th>
                        <th>@lang('messages.staff_name')</th>
                        <th>@lang('messages.department')</th>
                        <th>@lang('messages.start_leave')</th>
                        <th>@lang('messages.end_leave')</th>
                        <th>@lang('messages.date_application')</th>
                        <th>@lang('messages.hand_over_job')</th>
                        <th>@lang('messages.day')</th>
                        <th>@lang('messages.shift')</th>
                        <th>@lang('messages.leave_type')</th>
                        <th>@lang('messages.reasons')</th>
                    </tr>
                </thead>
                @if(!$leave_takes->isEmpty())
                @if (($startdate && $enddate && $username )!= '')
                <tbody>
                  @if(count($leave_takes) >= 1)
                  @foreach ($leave_takes as $item)
                  <tr >
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->username}}</td>
                      <td>{{$item->department}}</td>
                      <td>{{$item->startdate}}</td>
                      <td>{{$item->enddate}}</td>
                      <td>{{$item->date_app}}</td>
                      <td>{{$item->hand_over_job}}</td>
                      <td>{{$item->number_day}}</td>
                      <td>{{$item->shift}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->reasons}}</td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
                @endif
                @else
                <tr>
                  <td colspan="25"><p class="text-center">@lang('messages.no_data_available_in_table')</p></td>
                </tr>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/ione/moment.min.js')}}"></script>
<script src="{{asset('js/ione/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('js/admin/tableExport.min.js')}}"></script>
<script src="{{asset('js/admin/xlsx.core.min.js')}}"></script>
 <script>
        $(document).ready(function() {
           $(".export_to_excel").click(function(){
               $('table').tableExport({type:'excel',
                    mso: {fileFormat:'xlsx'}});
                })
       
       
    });
    //datetimepicker
    $('.icondate').click(function(){
          $("#from").focus();
        })
        $('.icondate_to').click(function(){
            $("#to").focus();
        })
        $('#from').datetimepicker({
            clear: "Clear",
            format: 'yyyy-mm-dd',
            minView:'month',
            autoclose:true,
            showClear:true,
            todayBtn: true,
           pickerPosition: "bottom-left",
        }).on('changeDate', function(ev){
            $('#to').datetimepicker('setStartDate', ev.date);
        });
        $('#to').datetimepicker({
            clear: "Clear",
            format: 'yyyy-mm-dd',
            minView:'month',
            autoclose:true,
            todayBtn: true,
            pickerPosition: "bottom-left",
        }).on('changeDate', function(ev){
            $('#from').datetimepicker('setEndDate', ev.date);
        });
 </script>

@endsection