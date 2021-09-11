@extends('layouts.master')
@section('title', 'Leave Detail')
@section('css')
<link href="{{asset('css/ione/styles.css')}}" rel="stylesheet">
@endsection
@section('sidebar')
    @include('sidebar.eleave')
@endsection
@section('content')
 <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('eleave')}}">Eleave</a></li>
        <li class="breadcrumb-item active" aria-current="page">Leave Detail</li>
    </ol>
</nav>
<div class="card uper">
    <div class="card-header">
     Leave Detail
    </div>
    <div class="row p-4">
        <div class="col-lg-8">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Office/Department</label>
                        <input type="text" name="department" class="form-control"  readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Name of Employee</label>
                        <input type="text" name="username" class="form-control"  readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>sex</label>
                        <input type="text" name="sex" class="form-control"  readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date of Application</label>
                        <input type="date" name="username" class="form-control"  readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label >Number of Days<sup style="color:red">*</sup></label>
                        <input type="number" name="days" class="form-control" placeholder="Please input number of your leave"  readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Full Day or Half Day</label>
                        <select name="sex"  class="form-control" disabled>
                            <option >Full Day</option>
                            <option >Half Day</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Type of Leave</label>
                        <select name="sex"  class="form-control" disabled>
                            <option >Annual Leave</option>
                            <option >Sick Leave</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Hand Over Job</label>
                        <select name="sex"  class="form-control" disabled>
                            <option >Admin</option>
                            <option >User</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Start Duration of Leave</label>
                        <input type="date" class="form-control" name="startdate"  readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>End Duration of Leave</label>
                        <input type="date" class="form-control" name="startdate"  readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Reasons</label>
                        <textarea name="Reasons" id="Reasons" cols="30" rows="10" placeholder="Reasons"  class="form-control" readonly></textarea>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let maxAge = 50
            let minAge = 16
            var currentYear = (new Date).getFullYear();
            let min = `${currentYear - maxAge}-01-01`
            let max = `${currentYear - minAge}-12-31`
        })
    </script>
@endsection