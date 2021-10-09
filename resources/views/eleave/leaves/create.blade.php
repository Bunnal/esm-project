@extends('layouts.master')
@section('title', 'Create Leave')
@section('title_page', 'Eleave')
@section('css')
<link href="{{asset('css/styles.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<link href="{{asset('css/chosen.css')}}" rel="stylesheet"/>
<style>
    .inline_btn{
        display: inline-block;
        position: relative;
    }
    .chosen-container-multi .chosen-choices{
        background-color: #d1d3e2 !important;
    }
</style>
@endsection
@section('sidebar')
    @include('sidebar.eleave')
@endsection
@section('content')
 {{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user">@lang('messages.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{route('leave')}}">@lang('messages.leave')</a></li>
        <li class="breadcrumb-item active" aria-current="page">@lang('messages.create')</li>
    </ol>
</nav> --}}

<div class="card uper">
    <div class="card-header">
       @lang('messages.create_new_leave')
    </div>
    <div class="row p-4">
        <div class="col-lg-8">
        <form action="{{route('storeleave')}}" method="POST" enctype="multipart/form-data" data-toggle="validator" role="form">
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
                <?php
                    $datetime = new DateTime('now', new DateTimeZone('Asia/Phnom_Penh'));
                ?> 
                 <input name="email" type="hidden" value="{{auth()->user()->email}}">
                 <input name="hod_email" type="hidden" value="{{auth()->user()->hod_email}}">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('messages.office_or_department')</label>
                        <input name="user_department_id" type="hidden" value="{{auth()->user()->user_department_id}}">
                        <select class="chosen-select form-control" multiple disabled>
                            @foreach($departments as $key => $department)
                                <option  selected>{{$department->department}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('messages.employee')</label>
                        <input type="text" name="username" class="form-control" value="{{auth()->user()->username}}" readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <input type="text" name="gender" class="form-control" value="{{auth()->user()->gender}}" readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('messages.date_of_application')</label>
                        <input type="datetime" name="date_app" class="form-control"  value="<?= $datetime->format('Y-m-d H:i:s'); ?>" readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 {{ $errors->has('hand_over_job') ? ' has-error' : '' }}">
                        <label>@lang('messages.hand_over_job')<sup style="color:red">*</sup></label>
                        <select name="hand_over_job"  class="form-control" required>
                            <option value="" selected hidden >@lang('messages.choose_one')</option>
                            @foreach ($handoverjobs as $handoverjob)
                                <option @if(old('username') == $handoverjob->username) selected @endif value="{{$handoverjob->username}}">{{$handoverjob->username}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('hand_over_job'))
                            <span class="help-block">
                                <strong>{{ $errors->first('hand_over_job') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('messages.leave_type')<sup style="color:red">*</sup></label>
                        <input type="hidden" class="form-control"  value="Unpaid" id="unpaid">
                        <select name="name"  class="form-control" id="leavetype" required>
                            @foreach($leavetypes as $leavetype)
                               <option @if(old('name') == $leavetype->name) selected @endif value="{{$leavetype->name}}">{{$leavetype->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 {{ $errors->has('sup') ? ' has-error' : '' }}">
                        <label>@lang('messages.supervisor')</label>
                        @if(auth()->user()->role_id == 4)
                        <select name="sup"  class="form-control" disabled >
                            <option value="" selected hidden >Default</option>
                        </select>
                        @else
                        <select name="sup"  class="form-control">
                            <option value="" selected hidden >@lang('messages.choose_one')</option>
                            @foreach($supervisors as  $sup)
                                <option @if(old('username') == $sup->username) selected @endif value="{{$sup->username}}">{{$sup->username}}</option>
                            @endforeach
                        </select>
                        @endif
                        @if ($errors->has('sup'))
                            <span class="help-block">
                                <strong>{{ $errors->first('sup') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('hod') ? ' has-error' : '' }}">
                        <label>HOD/BOD<sup style="color:red">*</sup></label>
                        <select name="hod"  class="form-control" required>
                            <option value="" selected hidden >@lang('messages.choose_one')</option>
                            @foreach($hods as $hod)
                                <option @if(old('username') == $hod->username) selected @endif value="{{$hod->username}}">{{$hod->username}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('hod'))
                            <span class="help-block">
                                <strong>{{ $errors->first('hod') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang('messages.start_duration_of_leave')<sup style="color:red">*</sup></label>
                        <div class="form-group">
                            <div class='input-group date'>
                                <input type='text' class="form-control" name="startdate" readonly id="from"  required/>
                                <div class="input-group-append icondate">
                                    <div class="input-group-text"><i class="fa fa-calendar inline_btn"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 ">
                        <label>@lang('messages.end_duration_of_leave')<sup style="color:red">*</sup></label>
                        <div class="input-group date ">
                            <input type="text" class="form-control" name="enddate" id="to" readonly required/>
                            <div class="input-group-append icondate_to">
                                <div class="input-group-text"><i class="fa fa-calendar inline_btn"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="day">@lang('messages.number_day')<sup style="color:red">*</sup></label>
                        <select class="form-control " name="number_day"  required>
                          @foreach( $leavenumberics as  $leavenumberic)
                            <option @if(old('number_day') == $leavenumberic->number_day) selected @endif value="{{$leavenumberic->number_day}}">{{$leavenumberic->number_day}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="day">@lang('messages.fullday_or_halfday')<sup style="color:red">*</sup></label>
                        <select class="form-control" name="shift"  required>
                          @foreach($leavedays as $leaveday)
                          <option @if(old('shift') == $leaveday->shift) selected @endif value="{{$leaveday->shift}}">{{$leaveday->shift}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>@lang('messages.reasons')<sup style="color:red">*</sup></label>
                        <textarea name="reasons" id="reasons" cols="30" rows="10" placeholder="Reasons"  class="form-control @error('Reasons') is-invalid @enderror"></textarea>
                        @if ($errors->has('Reasons'))
                        <span class="text-danger">{{ $errors->first('Reasons')}}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" >@lang('messages.submit')</button>
                    <button class="btn btn-danger" type="reset" value="Reset">@lang('messages.reset')</button>
                </div>
      
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>

    <script>
       var today = new Date();
       var month = today.getMonth()+1;
       var day = today.getDate();
       var output = today.getFullYear() + '-' +
       (month<10 ? '0' : '') + month + '-' +
        (day<10 ? '0' : '') + day;
        $("#datetimepicker").val(output);
        // new here 
        $('.icondate').click(function(){
            $("#from").focus();
        })
        $('.icondate_to').click(function(){
            $("#to").focus();
        })
        //
        $('#from').datetimepicker({
            clear: "Clear",
            format: 'yyyy-mm-dd',
            minView:'month',
            autoclose:true,
            showClear:true,
            todayBtn: true,
             pickerPosition: "bottom-left",
            // startDate : today,  
        }).on('change', function(ev){

            // $('#to').datetimepicker('setStartDate', ev.date);
            var selected = $(this).val();
            //  var date =  document.getElementById('from').value; 
            var today = new Date();
            var month = today.getMonth()+1;
            var day = today.getDate();
            var output = today.getFullYear() + '-' +
            (month<10 ? '0' : '') + month + '-' +
             (day<10 ? '0' : '') + day;
            console.log(output);
              if(output >  selected)  
              {  
                 $('#leavetype').hide();
                 $('#unpaid').attr('type','text');
                 $('#unpaid').attr('name', 'name');

              } 
              else{
                $('#unpaid').hide();
                $('#leavetype').show();
                $('#unpaid').attr('name', '');
               
              }
        });
        $('#to').datetimepicker({
            clear: "Clear",
            format: 'yyyy-mm-dd',
            minView:'month',
            autoclose:true,
            todayBtn: true,
            pickerPosition: "bottom-left",
            // startDate : today
        }).on('changeDate', function(ev){
            $('#from').datetimepicker('setEndDate', ev.date);
        });
        
    </script>
    <script src="{{asset('js/chosen.js')}}" ></script>
    <script>
         $(".chosen-select").chosen()
    </script>
@endsection