@extends('layouts.master')
@section('title', 'Eleave')
@section('title_page', 'Eleave')
@section('sidebar')
    @include('sidebar.eleave')
@endsection
@section('css')
<link href="{{asset('css/styles.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<link href="{{asset('css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
    .no-border {
    border: 0;
}
</style>
@endsection
@section('content')
@if( Session::has('modal_message_error'))
    <div class="modal " id="popupmodal" tabindex="-1" role="dialog">
      <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content alert alert-danger">
          <div class="modal-header">
            <strong><i class="fas fa-exclamation-triangle">@lang('messages.alert_message')</i></strong>
          </div>
          <div class="modal-body">
            {{ Session::get('modal_message_error') }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('messages.close')</button>
          </div>
        </div>
      </div>
    </div>
@endif
<div class="card uper mt-3">
    <div class="card-header">@lang('messages.view_own_balance')</div>
    <div class="row p-4">
        <div class="col-lg-8">
            <form action="{{route('getownbalance')}}" method="post">
                @csrf
                <?php
                $annual_leave = $LeaveTake->annual_leave;
                $number_day = $leave_muberics->sum('number_day');
                $remained_balance = $annual_leave-$number_day;
               ?>
                  <?php
                  $annual_leave = $LeaveTake->annual_leave;
                  $day = $unpaids->sum('number_day');
                  $unpaid_leave = $annual_leave-$day;
                 ?>
        
            <div class="form-group row ">
                <div class="col-sm-10">
                    <input type="text" name="startdate" id="datetimepicker"  style="width: 300px; height: 40px;" @if ($startdate != '')
                    value="{{$startdate}}" 
                    @else
                    class="datetimepicker1"
                    @endif  />
                    <button type="submit" class="btn btn-primary" >@lang('messages.search')</button>
                </div>
            </div>
        </form>
            <hr> 
            <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.employee_id'):</label>
                <div class="col-sm-8">
                    <input type="text" name="employee_id" id="employee_id" class="form-control no-border"  value="{{ $LeaveTake->employee_id}}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.name'):</label>
                <div class="col-sm-8">
                    <input type="text" name="username" id="username" class="form-control no-border" value="{{ $LeaveTake->username}}"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.department'):</label>
                <div class="col-sm-8">
                    <input type="text" name="department" id="department" class="form-control no-border" value="{{ $LeaveTake->department}}"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.date_joined'):</label>
                <div class="col-sm-8">
                    <input type="text" name="date_joined" id="date_joined" class="form-control no-border" value="{{ $LeaveTake->date_joined}}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.annual_leave'):</label>
                <div class="col-sm-8">
                    <input type="text" name="annual_leave" id="annual_leave" class="form-control no-border" value="{{ $LeaveTake->annual_leave}}"   />
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.annual_leave_take'):</label>
                <div class="col-sm-8">
                    <input type="text" name="number_day" id="number_day" class="form-control no-border"  value="{{$number_day}}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.remained_balance'):</label>
                <div class="col-sm-8">
                    <input type="text" name="remained_balance" id="remained_balance" class="form-control no-border" value="{{$remained_balance}}"  />
                </div>
            </div>
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.unpaid_leave_balance'):</label>
                <div class="col-sm-8">
                    <input type="text" name="unpaid_leave" id="unpaid_leave" class="form-control no-border" value="{{ $day}}" />
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
<script>
    var today = new Date();
    // var month = today.getMonth()+1;
    // var day = today.getDate();
    var output = today.getFullYear();
    $(".datetimepicker1").val(output);
    $('#datetimepicker').datetimepicker({
        format:' yyyy' ,
        startView: "decade", 
        minView: "decade",
        autoclose:true,
    }).on('changeDate', function(ev){
            $('.datetimepicker1').datetimepicker('setStartDate', ev.output);
        });  
 
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#popupmodal').modal();
        setTimeout(function() {
                  $('#popupmodal').modal('hide');
              }, 4000);
    });
  </script>
@endsection