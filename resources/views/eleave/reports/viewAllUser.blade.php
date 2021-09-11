@extends('layout.admin-master')
@section('title', 'Dashboard')
@section('css')
<link href="{{asset('css/admin/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
  .no-border {
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
        <li class="breadcrumb-item active" aria-current="page">@lang('messages.all_user')</li>
    </ol>
</nav>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>@lang('messages.id')</th>
                        <th>@lang('messages.name')</th>
                        <th>@lang('messages.email')</th>
                        <th>@lang('messages.sex')</th>
                        <th>@lang('messages.date_joined')</th>
                        <th>@lang('messages.dept')</th>
                        <th>@lang('messages.position')</th>
                        <th>@lang('messages.role')</th>
                        <th>@lang('messages.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)

                        <tr>
                            <td>{{$user->employee_id}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->Sex}}</td>
                            <td>{{$user->date_joined}}</td>
                            <td>{{$user->department}}</td>
                            <td>{{$user->position}}</td>
                            <td>{{$user->role}}</td>
                            <td> <a style="color: white;" class="btn btn-primary btn-sm mr-1 clickable-row"  data-toggle="modal" data-target="#showleave" style="cursor:pointer" id="{{$user->id}}"><i class="fa fa-eye"></i></a></td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade"  id="showleave" tabindex="-1" role="dialog" aria-labelledby="supModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="supModalLabel">@lang('messages.detail')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body nodata">
          <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.employee_id'):</label>
            <div class="col-sm-8">
                <input type="text" name="employee_id" id="employee_id" class="form-control no-border"   />
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.name'):</label>
            <div class="col-sm-8">
                <input type="text" name="username" id="username" class="form-control no-border" />
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.date_joined'):</label>
            <div class="col-sm-8">
                <input type="text" name="date_joined" id="date_joined" class="form-control no-border"  />
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.annual_leave'):</label>
            <div class="col-sm-8">
                <input type="text" name="annual_leave" id="annual_leave" class="form-control no-border"    />
            </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.annual_leave_take'):</label>
          <div class="col-sm-8">
              <input type="text" name="number_day" id="number_day" class="form-control no-border"  />
          </div>
      </div>
      <div class="form-group row">
          <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.remained_balance'):</label>
          <div class="col-sm-8">
              <input type="text" name="remained_balance" id="remained_balance" class="form-control no-border"   />
          </div>
      </div>
      <div class="form-group row">
          <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-sm">@lang('messages.unpaid_leave_balance'):</label>
          <div class="col-sm-8">
              <input type="text" name="unpaid_leave" id="unpaid_leave" class="form-control no-border" />
          </div>
      </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('js')
<script src="{{asset('js/admin/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/admin/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
       
    });
</script>
<script>
    $(document).on('click','.clickable-row',function (event) { 
         var id = $(this).attr("id"); 
      $.ajax({
          url:"/viewuserleave/"+id,
          method:"GET",
          success: function(data){
               //  console.log(LeaveTake[2]);
                    $("#showleave #employee_id").val(data[3].employee_id);
                    $("#showleave #username").val(data[3].username);
                    $("#showleave #date_joined").val(data[3].date_joined);
                    $("#showleave #annual_leave").val(data[3].annual_leave);
                  if(data)
                  {
                    var leg = data[1].length;
                     var legtest = data[2].length;
                     //sum annual leave take
                     var number_day = 0;
                     for(var i = 0 ; i<leg ; i++)
                     {
                        number_day += data[1][i].leave_numberic.number_day
                     }
                     //annual leave balance
                    var remained_balance = data[3].annual_leave-number_day;
                    //sum unpaid
                    var unpaid_leave = 0;
                     for(var i = 0 ; i<legtest ; i++)
                     {
                      unpaid_leave += data[2][i].leave_numberic.number_day
                     }
                    $("#showleave #number_day").val(number_day);
                    $("#showleave #remained_balance").val(remained_balance);
                    $("#showleave #unpaid_leave").val(unpaid_leave);

                  }
          },
          error:function(err){
              console.log(err); 
          }
          
       })
    })
</script>
@endsection