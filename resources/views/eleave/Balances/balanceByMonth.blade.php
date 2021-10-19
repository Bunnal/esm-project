@extends('layouts.master')
@section('title', 'Eleave')
@section('title_page', 'Eleave')
@section('sidebar')
    @include('sidebar.eleave')
@endsection
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
@section('content')
<div class="card shadow mb-4 mt-3">
    <div class="card-header py-3">
       @lang('messages.balance_by_month')
    </div>
    <br>
  
    <div class="card-body">
      <div class="col-lg-8">
          <form action="{{('getbalancebymonth')}}" method="post"> 
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
                <div class="col-auto my-1">
                  <button type="submit" id="search" class="btn btn-primary">@lang('messages.search')</button>
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
                        <th>@lang('messages.department')</th>
                        <th>@lang('messages.staff_name')</th>
                        <th>@lang('messages.date_application')</th>
                        <th>@lang('messages.start_leave')</th>
                        <th>@lang('messages.end_leave')</th>
                        <th>@lang('messages.day')</th>
                        <th>@lang('messages.leave_type')</th>
                    </tr>
                </thead>
                @if(!$leave_takes->isEmpty())
                @if (($startdate && $enddate )!= '')
                <tbody>
                  @if(count($leave_takes))
                  @foreach ($leave_takes as $item)
                  <tr class='clickable-row' data-toggle="modal" data-target="#showModal" style="cursor:pointer" id="{{$item->id}}" >
                       <td>{{$loop->iteration}}</td>
                       <td>{{$item->department}}</td>
                       <td>{{$item->username}}</td>
                       <td>{{$item->date_app}}</td>
                       <td>{{$item->startdate}}</td>
                       <td>{{$item->enddate}}</td>
                       <td>{{$item->number_day}}</td>
                       <td>{{$item->name}}</td>
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
<div class="modal fade"  id="showModal" tabindex="-1" role="dialog" aria-labelledby="supModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="supModalLabel">@lang('messages.detail')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group row">
              <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.department')&nbsp;:</label>
              <div class="col-sm-8">
                  <input type="text" name="department" id="department" class="form-control" />
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.employee')&nbsp;:</label>
              <div class="col-sm-8">
                  <input type="text" name="username" id="username" class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm"> @lang('messages.sex')&nbsp;:</label>
              <div class="col-sm-8">
                  <input type="text" name="sex" id="sex" class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.date_of_application'):</label>
              <div class="col-sm-8">
                  <input type="text" name="date_app" id="date_app" class="form-control" />
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.hand_over_job'):</label>
              <div class="col-sm-8">
                  <input type="text" name="hand_over_job" id="hand_over_job" class="form-control" />
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.leave_type'):</label>
              <div class="col-sm-8">
                  <input type="text" name="name" id="name" class="form-control"  />
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.start_leave'):</label>
              <div class="col-sm-8">
                  <input type="text" name="startdate" id="startdate" class="form-control"  />
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.end_leave'):</label>
              <div class="col-sm-8">
                  <input type="text" name="enddate" id="enddate" class="form-control"  />
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.number_of_day'):</label>
              <div class="col-sm-8">
                  <input type="text" name="number_day" id="number_day" class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.fullday_or_halfday'):</label>
              <div class="col-sm-8">
                  <input type="text" name="shift"  id="shift" class="form-control" />
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.reasons'):</label>
              <div class="col-sm-8">
                  <textarea name="reasons" id="reasons" cols="30" rows="10" class="form-control"></textarea>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/ione/moment.min.js')}}"></script>
<script src="{{asset('js/ione/bootstrap-datetimepicker.js')}}"></script>
<script>
   $(document).on('click','.clickable-row',function () {
           var id = $(this).attr("id"); 
        $.ajax({
            url:"/balancebymonth/show/"+id,
            method:"GET",
            success: function(leave_take){
                $("#showModal #department").val(leave_take.department.department);
                $("#showModal #username").val(leave_take.username);
                $("#showModal #sex").val(leave_take.Sex);
                $("#showModal #date_app").val(leave_take.date_app);
                $("#showModal #hand_over_job").val(leave_take.hand_over_job);
                $("#showModal #name").val(leave_take.name);
                $("#showModal #startdate").val(leave_take.startdate);
                $("#showModal #enddate").val(leave_take.enddate);
                $("#showModal #shift").val(leave_take.shift);
                $("#showModal #number_day").val(leave_take.number_day);
                $("#showModal #reasons").val(leave_take.reasons);
                
            },
            error:function(err){
                console.log("error"); 
            }
            
           })
         })
</script>
<script>
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