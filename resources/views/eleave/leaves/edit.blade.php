@extends('layouts.master')
@section('title', 'Edit Leave')

@section('css')
<link href="{{asset('css/ione/styles.css')}}" rel="stylesheet">
<link href="{{asset('css/ione/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<link href="{{asset('css/admin/chosen.css')}}" rel="stylesheet"/>
<style>
    .chosen-container-multi .chosen-choices{
        background-color: #d1d3e2 !important;
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
        <li class="breadcrumb-item active" aria-current="page">@lang('messages.update')</li>
    </ol>
</nav>
@if( Session::has('modal_message_success'))
    <div class="modal " id="popupmodal" tabindex="-1" role="dialog">
      <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content alert alert-success">
          <div class="modal-header">
            <strong><i class="fas fa-exclamation-triangle">@lang('messages.alert_message')</i></strong>
          </div>
          <div class="modal-body">
            {{ Session::get('modal_message_success') }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">@lang('messages.close')</button>
          </div>
        </div>
      </div>
    </div>
@endif
<div class="card uper">
    <div class="card-header">
        @lang('messages.update_leave')
    </div>
    <div class="row p-4">
        <div class="col-lg-8">
            <form action="{{route('updateleave', $leavetake->id)}}" method="POST"  enctype="multipart/form-data" > 
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('messages.office_or_department')</label>
                        <input type="hidden" name="user_department_id" class="form-control" value="{{$leavetake->department}}" readonly/>
                        <select class="chosen-select form-control" multiple disabled>
                            @foreach($departments as $key => $department)
                                <option  selected >{{$department->department}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('messages.employee')</label>
                        <input type="text" name="username" class="form-control" value="{{$leavetake->username}}"  readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('messages.sex')</label>
                        <input type="text" name="Sex" class="form-control"  value="{{$leavetake->Sex}}" readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('messages.date_of_application')</label>
                        <input type="datetime" name="date_app"  class="form-control"  value="{{$leavetake->date_app}}" readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('messages.hand_over_job')</label>
                        <select name="hand_over_job"  class="form-control" required>
                            @foreach ($handoverjobs as $handoverjob)
                                <option @if($leavetake->hand_over_job == $handoverjob->username) selected @endif value="{{$handoverjob->username}}">{{$handoverjob->username}}</option>
                            @endforeach
                           
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('messages.leave_type')</label>
                        <select name="name"  class="form-control" required>
                            @foreach($leavetypes as $leavetype)
                                <option @if($leavetake->name == $leavetype->name) selected @endif value="{{$leavetype->name}}">{{$leavetype->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('messages.supervisor')</label>
                        <select name="sup"  class="form-control">
                            <option value="" selected hidden >@lang('messages.choose_one')</option>
                            @foreach ($supervisors as $supervisors)
                                <option @if($leavetake->sup == $supervisors->username) selected @endif value="{{$supervisors->username}}">{{$supervisors->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>HOD/BOD</label>
                        <select name="hod"  class="form-control" required>
                            @foreach ($hods as $hod)
                                <option @if($leavetake->hod == $hod->username) selected @endif value="{{$hod->username}}">{{$hod->username}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">   
                    <div class="form-group col-md-6">
                        <label>@lang('messages.start_duration_of_leave')</label>
                        <div class="input-group date">
                            <input type="text" id="from" class="form-control" name="startdate"   value="{{ $leavetake->startdate }}"  required/>
                            <div class="input-group-append icondate">
                                <div class="input-group-text"><i class="fa fa-calendar inline_btn"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 ">
                        <label>@lang('messages.end_duration_of_leave')</label>
                        <div class="input-group date" >
                            <input type="text" id="to" class="form-control" name="enddate"  value="{{ $leavetake->enddate }}"  required/>
                            <div class="input-group-append icondate_to">
                                <div class="input-group-text"><i class="fa fa-calendar inline_btn"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="day">@lang('messages.number_day'):</label>
                        <select class="form-control " name="number_day"  required>
                            @foreach($leavenumberics as $l)
                             <option @if($leavetake->number_day == $l->number_day) selected @endif value="{{$l->number_day}}">{{$l->number_day}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="day">@lang('messages.fullday_or_halfday'):</label>
                        <select class="form-control " name="shift"  required>
                        @foreach($leavedays as $leaveday)
                          <option @if($leavetake->shift == $leaveday->shift) selected @endif value="{{$leaveday->shift}}">{{$leaveday->shift}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>@lang('messages.reasons')</label>
                        <textarea name="reasons" id="reasons" cols="30" rows="10" placeholder="Reasons"  class="form-control @error('Reasons') is-invalid @enderror" value="{{ $leavetake->reasons}}">{{ $leavetake->reasons}}</textarea>
                        @if ($errors->has('Reasons'))
                        <span class="text-danger">{{ $errors->first('Reasons')}}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" >@lang('messages.save')</button>
                    {{-- <a href="javascript: window.history.go(-1)" class="btn btn-primary ">@lang('messages.back')</a> --}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/ione/moment.min.js')}}"></script>
<script src="{{asset('js/ione/bootstrap-datetimepicker.js')}}"></script>
        <script>
            var today = new Date();
            var month = today.getMonth()+1;
            var day = today.getDate();
            var output = today.getFullYear() + '/' +
            (month<10 ? '0' : '') + month + '/' +
             (day<10 ? '0' : '') + day;
             $("#datetimepicker").val(output);

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
                //  startDate : today,
                //  useCurrent: false ,
             }).on('changeDate', function(ev){
                 $('#to').datetimepicker('setStartDate', ev.date);
             });
             $('#to').datetimepicker({
                 clear: "Clear",
                 format: 'yyyy-mm-dd',
                 minView:'month',
                 autoclose:true,
                 pickerPosition: "bottom-left",
                //  startDate : today
             }).on('changeDate', function(ev){
                 $('#from').datetimepicker('setEndDate', ev.date);
             });
             
         </script>
         <script src="{{asset('js/admin/chosen.js')}}" ></script>
         <script>
              $(".chosen-select").chosen()
         </script>
         
         <script type="text/javascript">
            $(document).ready(function() {
                $('#popupmodal').modal();
                setTimeout(function() {
                          $('#popupmodal').modal('hide');
                      }, 3000);
            });
          </script>
@endsection