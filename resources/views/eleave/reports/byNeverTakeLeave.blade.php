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
      @lang('messages.report_all_user_never_take_leave')
    </div>
    <br>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
            <form action="{{('nevertakeleave')}}" method="post"> 
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
                      <th>@lang('messages.employee_id')</th>
                      <th>@lang('messages.user_name')</th>
                      <th>@lang('messages.gender')</th>
                      <th>@lang('messages.dob')</th>
                      <th>@lang('messages.email')</th>
                      <th>@lang('messages.hod_email')</th>
                      <th>@lang('messages.phone')</th>
                      <th>@lang('messages.hod_phone')</th>
                      <th>@lang('messages.annual_leave')</th>
                      <th>@lang('messages.date_joined')</th>
                      <th>@lang('messages.dept')</th>
                      <th>@lang('messages.position')</th>
                      <th>@lang('messages.role')</th>
                      <th>@lang('messages.service_grade')</th>
                    </tr>
                </thead>
                @if(!$neverleaves->isEmpty())
                @if (($year )!= '')
                <tbody>
                  @if(count($neverleaves) >= 1)
                  @foreach ($neverleaves  as $item)
                  <tr >
                    <td>{{$item->employee_id}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->Sex}}</td>
                    <td>{{$item->DOB}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->hod_email}}</td>
                    <td>{{$item->phone_number}}</td>
                    <td>{{$item->hod_phone}}</td>
                    <td>{{$item->annual_leave}}</td>
                    <td>{{$item->date_joined}}</td>
                    <td>{{$item->department}}</td>
                    <td>{{$item->position}}</td>
                    <td>{{$item->role}}</td>
                    <td>{{$item->service_grade}}</td>
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