@extends('layouts.master')
@section('title', 'Dashboard')
@section('title_page', 'Eleave')
@section('css')
<link href="{{asset('css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
  .no-border {
  border: 0;
}
.flex-container{
  display: flex;
  flex-wrap: nowrap;
}
</style>
@endsection
@section('sidebar')
    @include('sidebar.eleave')
@endsection
@section('content')
{{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/eleave">@lang('messages.dashboard')</a></li>
        <li class="breadcrumb-item active" aria-current="page">@lang('messages.leave')</li>
    </ol>
</nav> --}}
<!-- Show Error if delete own account -->
{{-- <div class="text-center">
    @if (session('msg'))
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>    
            <h6>{{ session('msg') }}</h6>
        </div>
    @endif
</div> --}}
@if( Session::has('modal_message_error'))
    <div class="modal " id="popupmodal" tabindex="-1" role="dialog">
      <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content alert alert-danger">
          <div class="modal-header">
            <strong><i class="fas fa-exclamation-triangle"> @lang('messages.alert_message')</i></strong>
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
<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
        <div class="form-group">
            <a href="{{ route('createleave') }}"><button class="btn btn-success btn-sm mr-1 mb-2"><i class="fas fa-plus-circle"></i> @lang('messages.new_leave')</button></a>
            <a href="{{ route('ownbalance') }}"><button class="btn btn-primary  btn-sm mr-1 mb-2"><i class="fa fa-chart-bar"></i> @lang('messages.view_own_balance')</button></a>
            <a href="{{ route('balancebymonth') }}"><button class="btn btn-primary btn-sm mb-2"><i class="fa fa-chart-bar"></i> @lang('messages.balance_by_month')</button></a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" >
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>@lang('messages.name')</th>
                        <th>@lang('messages.date')</th>
                        <th>@lang('messages.start')</th>
                        <th>@lang('messages.end')</th>
                        <th>@lang('messages.day')</th>
                        <th>@lang('messages.type')</th>
                        <th>@lang('messages.hand_over')</th>
                        <th>@lang('messages.job')</th>
                        @foreach ($results as $key)
                        @if ($key->name == 'SupApproval') 
                        <th>@lang('messages.sup')</th>
                        @elseif ($key->name == 'HodApproval')
                        <th>HOD/BOD</th>
                        @endif
                        @endforeach
                        <th>@lang('messages.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leave_takes as $key => $item)
                        <tr  class="delete{{$item->id}}" id="remove{{$item->id}}"  data-id="{{$item->id}}">
                            <td>{{$item->username}}</td>
                            <td>{{$item->date_app}}</td>
                            <td>{{$item->startdate}}</td>
                            <td>{{$item->enddate}}</td>
                            <td>{{$item->number_day}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->hand_over_job}}</td>
                            <td>
                                @if($item->hoj_approval == 'pending')
                                <a style="color: white;" class="btn btn-primary btn-sm btn-block hojModal beforeHoj{{$item->id}}"  data-id="{{$item->id}}" @if (auth()->user()->username == $item->hand_over_job )
                                    data-toggle="modal" data-target="#hojModal"
                                @endif>
                                {{$item->hoj_approval}} 
                                <br>
                                {{$item->hand_over_job}}</a>
                                @else
                                <a style="color: white;" class="btn btn-success btn-sm btn-block disabled " href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#hojModal">
                                  {{$item->hoj_approval}}
                                  <br>
                                  {{$item->hand_over_job}}
                                </a>
                                @endif
                            </td>
                            @foreach ($results as $key)
                            @if ($key->name == 'SupApproval') 
                            <td>
                                @if($item->sup_approval === 'pending')
                                <a style="color: white;" class="btn btn-primary btn-sm btn-block supModal beforeSup{{$item->id}}"  data-id="{{$item->id}}" @if (auth()->user()->username == $item->sup)
                                  data-toggle="modal" data-target="#supModal"
                                @endif>
                                {{$item->sup_approval}}
                                <br>
                                {{$item->sup}}
                                </a>
                                @else
                                <a style="color: white;" class="btn btn-success btn-sm btn-block disabled" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#supModal">
                                  {{$item->sup_approval}}
                                  <br>
                                 {{$item->sup}}
                                </a>
                                @endif  
                            </td>
                            @elseif ($key->name == 'HodApproval')
                            <td>
                                @if($item->hod_approval == 'pending')
                                <a style="color: white;" class="btn btn-primary btn-sm btn-block remove hodModal update{{$item->id}}" href="#" data-id="{{$item->id}}" @if (auth()->user()->username  == $item->hod ) 
                                  data-toggle="modal" data-target="#hodModal" 
                                @endif>
                                  {{$item->hod_approval}}
                                  <br>
                                  {{$item->hod}}
                                </a>
                                @else
                                <a style="color: white;" class="btn btn-success btn-sm btn-block disabled " href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#hodModal"  >
                                  {{$item->hod_approval}}
                                  <br>
                                  {{$item->hod}}
                                </a>
                                @endif
                            </td>
                            @endif
                            @endforeach
                            <td class="flex-container">
                              <a style="color: white;" class="btn btn-info btn-sm mr-1 clickable-row"  data-toggle="modal" data-target="#showleave" style="cursor:pointer" id="{{$item->id}}"><i class="fa fa-eye"></i></a>
                              @foreach ($results as $key)
                              @if ($key->name == 'Edit') 
                              <a  class="btn btn-primary btn-sm mr-1" href="{{route('editleave',$item->id)}}"><i class="far fa-edit"></i></a>
                              @elseif ($key->name == 'Delete')
                              <a style="color: white;cusor:pointer" class="btn btn-danger btn-sm  delete_leave" data-id="{{$item->id}}" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
   
                              @endif
                              @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- delete --}}
@if(!$leave_takes->isEmpty())
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('messages.are_you_sure')</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">@lang('messages.select_yes_below_if_you_want_to_delete_this_row')</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('messages.cancel')</button>
                <button class="btn btn-primary yes_btn">@lang('messages.yes')</button>
            </div>
        </div>
    </div>
</div>
@endif
{{-- hojApproval Modal --}}
@if(!$leave_takes->isEmpty())
<div class="modal fade" id="hojModal" tabindex="-1" role="dialog" aria-labelledby="hojModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="supModalLabel">@lang('messages.status_approval')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="#" >
          <div class="form-group">
              <label class="col-form-label">@lang('messages.hand_over_job_approval'):</label>
              <select class="form-control " name="hoj_approval" id="hoj_approval" >
                  <option value="approved">@lang('messages.approved')</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.cancel')</button>
              <button  class="btn btn-primary" id="saveHoj">@lang('messages.ok')</button>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
@endif
{{-- supApproval Modal --}}
@if(!$leave_takes->isEmpty())
<div class="modal fade" id="supModal" tabindex="-1" role="dialog" aria-labelledby="supModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="supModalLabel">@lang('messages.status_approval')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="#"  >
            <div class="form-group">
                <label class="col-form-label">@lang('messages.supervisor_approval'):</label>
                <select id="sup_approval" class="form-control" name="sup_approval" >
                    <option value="approved">@lang('messages.approved')</option>
                  </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.cancel')</button>
                <button  class="btn btn-primary" id="saveSup">@lang('messages.ok')</button>
             </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
  {{-- hodApproval Modal --}}
  @if(!$leave_takes->isEmpty())
  <div class="modal fade" id="hodModal" tabindex="-1" role="dialog" aria-labelledby="hodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="supModalLabel">@lang('messages.status_approval')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="#" >
            <div class="form-group">
                <label class="col-form-label">@lang('messages.head_of_department_approval'):</label>
                <select class="form-control " name="hod_approval" id="hod_approval" >
                    <option value="approved">@lang('messages.approved')</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.cancel')</button>
                <button  class="btn btn-primary remove " id="saveHod" >@lang('messages.ok')</button>
            </div>
          </form>
        </div> 
      </div>
    </div>
  </div>
  @endif
<div class="modal fade"  id="showleave" tabindex="-1" role="dialog" aria-labelledby="supModalLabel" aria-hidden="true">
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
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm ">@lang('messages.department'):</label>
                <div class="col-sm-8">
                    <p name="department" id="department" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.employee'):</label>
                <div class="col-sm-8">
                    <p name="username" id="username" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">Gender:</label>
                <div class="col-sm-8">
                    <p name="gender" id="gender" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.date_application'):</label>
                <div class="col-sm-8">
                    <p name="date_app" id="date_app" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.hand_over_job'):</label>
                <div class="col-sm-8">
                    <p name="hand_over_job" id="hand_over_job" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.leave_type'):</label>
                <div class="col-sm-8">
                    <p name="name" id="name" class="form-control no-border" ></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.start_leave'):</label>
                <div class="col-sm-8">
                    <p name="startdate" id="startdate" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.end_leave'):</label>
                <div class="col-sm-8">
                    <p name="enddate" id="enddate" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.number_of_day'):</label>
                <div class="col-sm-8">
                    <p name="number_day" id="number_day" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.fullday_or_halfday'):</label>
                <div class="col-sm-8">
                    <p name="shift"  id="shift" class="form-control no-border"></p>
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.reasons'):</label>
                <div class="col-sm-8">
                    <textarea name="reasons" id="reasons" cols="30" rows="10" class="form-control no-border" readonly></textarea>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script src="{{asset('js/datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "order": []
        });
        var id;
           $(document).on('click','.delete_leave',function () {
               id =  $(this).data('id');
            })
            $('.yes_btn').click(function(){
                $.ajax({
                    url:"leave/delete/"+id,
                    method: "get",
                    success: function() {
                        $('.delete'+id).remove();
                        $('#deleteModal').modal('hide');
                    },
                })
            })
    });
    $(document).on('click','.clickable-row',function (event) {
         
           var id = $(this).attr("id"); 
           var text = "";
        $.ajax({
            url:"leave/show/"+id,
            method:"GET",
            success: function(LeaveTake ){
              if(LeaveTake.department.length > 1) {
                LeaveTake.department.forEach(element => {
                  text+= element.department+ " , "
                });
                }else {
                  text+= LeaveTake.department[0].department;
                }
                console.log(LeaveTake);
                $("#showleave #department").text(text);
                $("#showleave #username").text(LeaveTake.username);
                $("#showleave #gender").text(LeaveTake.gender);
                $("#showleave #date_app").text(LeaveTake.date_app);
                $("#showleave #hand_over_job").text(LeaveTake.hand_over_job);
                $("#showleave #name").text(LeaveTake.name);
                $("#showleave #startdate").text(LeaveTake.startdate);
                $("#showleave #enddate").text(LeaveTake.enddate);
                $("#showleave #shift").text(LeaveTake.shift);
                $("#showleave #number_day").text(LeaveTake.number_day);
                $("#showleave #reasons").text(LeaveTake.reasons);
                
            },
            error:function(err){
                console.log("error"); 
            }
            
         })

         })
          var id ;
        //Hoj Update
        $(".hojModal").click(function(){
          id = $(this).attr('data-id');
        })
        $('#saveHoj').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            var formdata = new FormData();
              formdata.append("hoj_approval",$("#hojModal #hoj_approval").val());
            $.ajax({
              url:"leave/update_hoj_approval/"+id,
              method:"post",
              data:formdata,
              processData:false,
              contentType:false,
              success:function (data) {  
                  $('#hojModal').modal('hide');     
                  $('.beforeHoj'+id).removeClass('btn btn-primary btn-sm btn-block hojModal');
                  $('.beforeHoj'+id).addClass('btn btn-success btn-sm btn-block disabled');
                  $('.beforeHoj'+id).text(data.hoj_approval)
              },
              error:function (err) {
                  console.log(err);
              }
            });
        })
        //Sup update
        $(".supModal").click(function(){
          id = $(this).attr('data-id');
        })
        $('#saveSup').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          var formdata = new FormData();
            formdata.append("sup_approval",$("#supModal #sup_approval").val());
          $.ajax({
              url:"leave/update_sup_approval/"+id,
              method:"post",
              data:formdata,
              processData:false,
              contentType:false,
              success:function (data) {  
                  $('#supModal').modal('hide');     
                  $('.beforeSup'+id).removeClass('btn btn-primary btn-sm btn-block supModal');
                  $('.beforeSup'+id).addClass('btn btn-success btn-sm btn-block disabled');
                  $('.beforeSup'+id).text(data.sup_approval)
              },
              error:function (err) {
                  console.log(err);
              }
            });
          })
      //Hod Update
        $(".hodModal").click(function(){
            id = $(this).attr('data-id');
          })
          $('#saveHod').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          var formdata = new FormData();
          formdata.append("hod_approval",$("#hodModal #hod_approval").val());
          $.ajax({
              url:"leave/update_hod_approval/"+id,
              method:"post",
              data:formdata,
              processData:false,
              contentType:false,
              success:function (data) {  
                  $('#hodModal').modal('hide');     
                  $('.update'+id).removeClass('btn btn-primary btn-sm btn-block hodModal');
                  $('.update'+id).addClass('btn btn-success btn-sm btn-block disabled');
                  $('.update'+id).text(data.hod_approval)
                  // $('.update'+id).parents('tr').remove();
                  // remove(data);
              },
              error:function (err) {
                  console.log(err);
              }
            });
          })
          //remove row when sup,hod,hoj =='approved'
          jQuery( "tr" ).each(function( index ) {
          if (jQuery( this ).css('display') == 'none'){
            jQuery(this).remove();
            
          }
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