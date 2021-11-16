@extends('layouts.master')
@section('title', 'Eleave')
@section('title_page', 'Eleave')
@section('sidebar')
    @include('sidebar.eleave')
@endsection
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
<!-- Show Error if delete own account -->
<div class="text-center">
    @if (session('msg'))
        <div class="alert alert-danger">
            <h5>{{ session('msg') }}</h5>
        </div>
    @endif
</div>
<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3">
      <h5>@lang('messages.disapproval')</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>@lang('messages.no.')</th>
                        <th>@lang('messages.staff_name')</th>
                        <th>@lang('messages.date_application')</th>
                        <th>@lang('messages.start_leave')</th>
                        <th>@lang('messages.end_leave')</th>
                        <th>@lang('messages.day')</th>
                        <th>@lang('messages.leave_type')</th>
                        <th>@lang('messages.hand_over_job')</th>
                        @foreach ($results as $key)
                        @if ($key->name == 'Approval') 
                        <th>@lang('messages.approval')</th>
                        @endif
                        @endforeach
                        <th>@lang('messages.action')</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($leave_takes as $item)
                           <tr   class="delete{{$item->id}}"  >
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->date_app}}</td>
                                <td>{{$item->startdate}}</td>
                                <td>{{$item->enddate}}</td>
                                <td>{{$item->number_day}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->hand_over_job}}</td>
                                @foreach ($results as $key)
                                @if ($key->name == 'Approval') 
                                <td>
                                    @if($item->hod_approval == 'pending' || $item->hoj_approval =='pending' || $item->sup_approval == 'pending')
                                    <a style="color: white;" class="btn btn-primary btn-sm btn-block remove hodModal update{{$item->id}}" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#hodModal">
                                        pending
                                    </a>
                                    @else
                                    <a style="color: white;" class="btn btn-success btn-sm btn-block disabled " href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#hodModal" disable >
                                      approved
                                    </a>
                                    @endif
                                </td>
                                @endif
                                @endforeach
                                <td class="flex-container">
                                    <a style="color: white;" class="btn btn-info btn-sm mr-1 clickable-row mb-1"  data-toggle="modal" data-target="#showModal" style="cursor:pointer" id="{{$item->id}}"><i class="fa fa-eye"></i></a>
                                    @foreach ($results as $key)
                                    @if ($key->name == 'Edit') 
                                    <a  class="btn btn-primary btn-sm mr-1 mb-1" href="{{route('editleave',$item->id)}}"><i class="far fa-edit"></i></a>
                                    @elseif ($key->name == 'Delete')
                                    <a style="color: white;" class="btn btn-danger btn-sm  delete_leave mb-1" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></a>
         
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
                
                <button class="btn btn-primary yes_btn" >@lang('messages.yes')</button>
            </div>
        </div>
    </div>
</div>
@endif
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
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.department'):</label>
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
                    <p name="name" id="name" class="form-control no-border"></p>
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
                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.full_day_or_half_day'):</label>
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

  {{-- Approval Modal for admin--}}
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
                <label class="col-form-label">@lang('messages.approval'):</label>
                <select class="form-control " name="hod_approval" id="hod_approval" >
                    <option value="approved">approved</option>
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
                    url:"{{route('deleteleavedisapproval')}}/"+id,
                    method:"get",
                    success: function() {
                        $('.delete'+id).remove();
                        $('#deleteModal').modal('hide');
                    },
                    error:function(e){
                      console.log(e);
                    }
                })
            })
    });
    $(document).on('click','.clickable-row',function () {
           var id = $(this).attr("id"); 
        $.ajax({
            url:"{{route('showdisapproved')}}/"+id,
            method:"GET",
            success: function(leave_take){
                $("#showModal #department").text(leave_take.department.department);
                $("#showModal #username").text(leave_take.username);
                $("#showModal #gender").text(leave_take.gender);
                $("#showModal #date_app").text(leave_take.date_app);
                $("#showModal #hand_over_job").text(leave_take.hand_over_job);
                $("#showModal #name").text(leave_take.name);
                $("#showModal #startdate").text(leave_take.startdate);
                $("#showModal #enddate").text(leave_take.enddate);
                $("#showModal #shift").text(leave_take.shift);
                $("#showModal #number_day").text(leave_take.number_day);
                $("#showModal #reasons").text(leave_take.reasons);
                
            },
            error:function(err){
                console.log("error"); 
            }
            
         })

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
          $.ajax({
              url:"{{route('updatedisapproval')}}/"+id,
              method:"post",
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
    
</script>
@endsection