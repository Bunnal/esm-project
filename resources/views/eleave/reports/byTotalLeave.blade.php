@extends('layout.admin-master')
@section('title', 'Report | Dashboard ')
@section('css')
<link href="{{asset('css/admin/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('css/ione/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<style>
    .form-control {
    border: 0;
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
        @lang('messages.report_total_take_leave')
    </div>
    <br>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form action="{{('searchbytotalleave')}}" method="post"> 
                @csrf
                    <div class="form-row align-items-center">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="sr-only" for="inlineFormInputGroupUsername">Year</label>
                                <div class="input-group">
                                <input type="text" name="startdate" id="datetimepicker" style="width: 300px; height: 40px;" @if ($year != '')
                                value="{{$year}}" 
                                @else
                                class="datetimepicker1"
                                @endif  
                                />
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary mr-1">@lang('messages.search')</button>
                                <button class="btn btn-success mr-1 export_to_excel">@lang('messages.export')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th>@lang('messages.name')</th>
                      <th>@lang('messages.qty')</th>
                      <th>@lang('messages.annual')</th>
                      <th>@lang('messages.balance')</th>
                      <th>@lang('messages.unpaid')</th>
                      <th>@lang('messages.marriage')</th>
                      <th>@lang('messages.paternity')</th>
                      <th>@lang('messages.maternity')</th>
                      <th>@lang('messages.special')</th>
                      <th>@lang('messages.public_holiday')</th>
                      <th>@lang('messages.other')</th>
                      <th>@lang('messages.total_leave')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count( $leave_takes ) >= 1)
                    @foreach ( $leave_takes  as $key => $item)
                   @php
                      $annual_leave = $item->annual_leave;
                      $annualTake = 0 ;
                      $annuals = DB::table('leave_takes')->whereYear('startdate', date('Y'))->where('leave_type_id',1)->where('user_id',$item->user_id)->get();
                      $unpaidTake = 0 ;
                      $unpaids = DB::table('leave_takes')->whereYear('startdate', date('Y'))->where('leave_type_id',2)->where('user_id',$item->user_id)->get();
                      $marraiageTake = 0 ;
                      $marriages = DB::table('leave_takes')->whereYear('startdate', date('Y'))->where('leave_type_id',3)->where('user_id',$item->user_id)->get();
                      $paternityTake = 0 ;
                      $paternities = DB::table('leave_takes')->whereYear('startdate', date('Y'))->where('leave_type_id',4)->where('user_id',$item->user_id)->get();
                      $maternityTake = 0 ;
                      $maternities = DB::table('leave_takes')->whereYear('startdate', date('Y'))->where('leave_type_id',5)->where('user_id',$item->user_id)->get();
                      $specaiTake = 0;
                      $specails = DB::table('leave_takes')->whereYear('startdate', date('Y'))->where('leave_type_id',6)->where('user_id',$item->user_id)->get();
                      $publicHolidayTake = 0;
                      $publicHolidays = DB::table('leave_takes')->whereYear('startdate', date('Y'))->where('leave_type_id',7)->where('user_id',$item->user_id)->get();
                      $otherTake = 0;
                      $others = DB::table('leave_takes')->whereYear('startdate', date('Y'))->where('leave_type_id',12)->where('user_id',$item->user_id)->get();

                   @endphp
                        <tr >
                            <td>{{$item->username}}</td>
                            <td>{{$item->annual_leave}}</td>
                            @foreach ( $annuals as $day_stop)
                                @php
                                $get_number_day = DB::table('leave_numberics')->where('id',$day_stop->leave_numberic_id)->first();
                                  $annualTake +=$get_number_day->number_day
                                @endphp
                            @endforeach
                            <td class="sum">
                                {{$annualTake}}
                            </td>
                            <td> {{$item->annual_leave - $annualTake}}</td>
                            @foreach ( $unpaids as $unpaid)
                            @php
                              $get_number_day = DB::table('leave_numberics')->where('id',$unpaid->leave_numberic_id)->first();
                               $unpaidTake += $get_number_day->number_day
                            @endphp
                            @endforeach
                            <td class="sum">
                                {{$unpaidTake}}
                            </td>
                            @foreach ($marriages as  $Marriage)
                            @php
                              $get_number_day = DB::table('leave_numberics')->where('id',$Marriage->leave_numberic_id)->first();
                               $marraiageTake += $get_number_day->number_day
                            @endphp
                            @endforeach
                            <td class="sum">
                                {{ $marraiageTake}}
                            </td>
                            @foreach ($paternities as $paternity)
                            @php
                             $get_number_day = DB::table('leave_numberics')->where('id',$paternity->leave_numberic_id)->first();
                             $paternityTake += $get_number_day->number_day
                            @endphp
                            @endforeach
                           <td class="sum">{{ $paternityTake}}</td>
                            @foreach ($maternities as $maternity)
                            @php
                               $get_number_day = DB::table('leave_numberics')->where('id',$maternity->leave_numberic_id)->first();
                                $maternityTake +=$get_number_day->number_day
                            @endphp
                            @endforeach
                           <td class="sum">{{ $maternityTake}}</td>
                           @foreach ($specails as $specail)
                               @php
                               $get_number_day = DB::table('leave_numberics')->where('id',$specail->leave_numberic_id)->first();
                                $specaiTake += $get_number_day->number_day
                               @endphp
                           @endforeach
                           <td class="sum">{{$specaiTake}}</td>
                           @foreach ($publicHolidays as $publicHoliday)
                                @php
                                $get_number_day = DB::table('leave_numberics')->where('id',$publicHoliday->leave_numberic_id)->first();
                                $publicHolidayTake +=  $get_number_day->number_day
                                @endphp
                            @endforeach
                            <td  class="sum">{{$publicHolidayTake}}</td>
                            @foreach ($others as $other)
                                @php
                                $get_number_day = DB::table('leave_numberics')->where('id',$other->leave_numberic_id)->first();
                                $otherTake += $get_number_day->number_day
                                @endphp
                            @endforeach
                            <td class="sum">{{$otherTake}}</td>

                            <td  id='totalleave'></td>

                         </tr>
                    @endforeach
                    @endif
                </tbody>
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
        //Total all leave type         
        $('tr').each(function()
        {
            var Toatal = 0;
            $(this).find('.sum').each(function(){
                var LeaveTypes = $(this).text();
                if(LeaveTypes.length !== 0)
                {
                    Toatal +=parseFloat(LeaveTypes);
                }
            });
            $(this).find('#totalleave').html(Toatal);
        });
    });
 </script>
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

@endsection