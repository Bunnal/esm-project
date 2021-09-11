<?php

namespace App\Http\Controllers\Ione\Eleave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserDepartment;
use App\Models\Eleave\LeaveDay;
use App\Models\Eleave\LeaveType;
use App\Models\Eleave\LeaveTake;
use App\Models\Eleave\LeaveNumberic;
use App\Models\User\Position;
use App\Models\User\Role;
Use App\Models\User\UserServiceGrade;
use App\Http\Controllers\CheckPermissionController;
use DB;
class ReportController extends Controller
{
    function index(){
      // check userpermissio
      // $this->CheckPermission(1);

        $startdate = "";
        $enddate = "";
        $leave_takes = LeaveTake::all();
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
          $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
        }
        return view('ione.eleave.reports.index',compact('leave_takes','startdate','enddate'));

    }
    function search(Request $request)
    {
      // check userpermissio
      // $this->CheckPermission(1);

        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $leave_takes = LeaveTake::select("leave_takes.*")->whereBetween('startdate', [$request->startdate, $request->enddate])->get();
        // $leave_takes = LeaveTake::whereBetween( 'startdate',[$startdate,$enddate])->whereYear('startdate', date('Y-m-d'))->get();
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
          $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
        }
        return view('ione.eleave.reports.index',compact('leave_takes','startdate','enddate'));
    }
    function getByUserName()
    {
       // check userpermissio
      //  $this->CheckPermission(1);

        $startdate = "";
        $enddate = "";
        $username ="";
        $users = User::all();
        $leave_takes = LeaveTake::all();
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
          $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
        }
        return view('ione.eleave.reports.byUserName',compact('leave_takes','startdate','enddate','username','users'));

    }
    function searchByUserName(Request $request)
    {

        // check userpermissio
        // $this->CheckPermission(1);

        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $username = $request->user_id;
        $users = User::all();
        $leave_takes = LeaveTake::select("leave_takes.*")->whereBetween('startdate', [$request->startdate, $request->enddate])->where('user_id', $username)->get();
        // $leave_takes = LeaveTake::whereBetween('startdate',[$startdate,$enddate])->whereYear('startdate',date('Y-m-d'))->where('user_id', $username)->get();
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
          $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
        }
        return view('ione.eleave.reports.byUserName',compact('leave_takes','startdate','enddate','username','users'));
    }
    function getByLeaveType()
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $startdate = "";
        $enddate = "";
        $leave_type ="";
        $leaveTypes =  LeaveType::all();
        $leave_takes = LeaveTake::all();
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
          $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
        }
      return view('ione.eleave.reports.byLeaveType',compact('leave_takes','startdate','enddate','leave_type','leaveTypes'));

    }
    function searchByLeaveType(Request $request)
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $leave_type = $request->leave_type_id;
        $leaveTypes =  LeaveType::all();
        $leave_takes = LeaveTake::select("leave_takes.*")->whereBetween('startdate', [$request->startdate, $request->enddate])->where('leave_type_id',$leave_type)->get();
        // $leave_takes = LeaveTake::whereBetween('startdate',[$startdate,$enddate])->whereYear('startdate',date('Y-m-d'))->where('leave_type_id',$leave_type)->get();
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
          $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
        }
      return view('ione.eleave.reports.byLeaveType',compact('leave_takes','startdate','enddate','leave_type','leaveTypes'));
    }
    function getByNeverTakeLeave()
    {
      // check userpermissio
      // $this->CheckPermission(1);

      $year = "";
      $neverleaves = User::whereNotExists(function($query)
      {
          $query->from('leave_takes')
                ->whereRaw('users.id =leave_takes.user_id')
                ->whereYear('leave_takes.startdate', date('Y'));
      })
      ->get();
    //  dd($neverleaves);
      foreach($neverleaves as $key => $neverleave)
      {
        
        $neverleaves[$key]['department'] = UserDepartment::select('department')->where('id',$neverleave->user_department_id)->first()->department;
        $neverleaves[$key]['position'] = Position::select('position')->where('id',$neverleave->position_id)->first()->position;
        $neverleaves[$key]['role'] = Role::select('role')->where('id',$neverleave->role_id)->first()->role;
        $neverleaves[$key]['service_grade'] = UserServiceGrade::select('service_grade')->where('id',$neverleave->user_service_grade_id)->first()->service_grade;
      }
      return view('ione.eleave.reports.byNeverTakeLeave',compact('neverleaves','year'));
    }
    function searchByNeverTakeLeave(Request $request)
    {
      // check userpermissio
      // $this->CheckPermission(1);

      $year = $request->startdate;
      $neverleaves = User::whereNotExists(function($query) use ($year)
      {
          $query->from('leave_takes')
                ->whereRaw('users.id =leave_takes.user_id')
                ->whereYear('leave_takes.startdate',$year);
               
      })
      ->get(); 
      foreach($neverleaves as $key => $neverleave)
      {
        
        $neverleaves[$key]['department'] = UserDepartment::select('department')->where('id',$neverleave->user_department_id)->first()->department;
        $neverleaves[$key]['position'] = Position::select('position')->where('id',$neverleave->position_id)->first()->position;
        $neverleaves[$key]['role'] = Role::select('role')->where('id',$neverleave->role_id)->first()->role;
        $neverleaves[$key]['service_grade'] = UserServiceGrade::select('service_grade')->where('id',$neverleave->user_service_grade_id)->first()->service_grade;
          
      }
      return view('ione.eleave.reports.byNeverTakeLeave',compact('neverleaves','year'));

    }
    function getByTotalLeave()
    {
      // check userpermissio
      // $this->CheckPermission(1);
      $year = "";
      $leave_takes  = LeaveTake::groupBy()->whereYear('startdate', date('Y'))->get()->unique(['user_id']);
      // dd( $leave_takes);
      foreach($leave_takes as $key => $leave_take)
      {
        $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
        $leave_takes[$key]['annual_leave'] = User::select('annual_leave')->where('id',$leave_take->user_id)->first()->annual_leave;
        $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
        $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
        // $leave_takes[$key]['annuals'] = DB::table('leave_takes')->whereYear('date_app', date('Y'))->where('leave_type_id',1)->where('user_id',$leave_take->user_id)->get();
        $leave_takes[$key]['annual_leave'] = User::select('annual_leave')->where('id',$leave_take->user_id)->first()->annual_leave;
                     
      } 
      return view('ione.eleave.reports.byTotalLeave',compact('leave_takes','year'));
      
    }

    function searchByTotalLeave(Request $request)
    {
      // check userpermissio
      // $this->CheckPermission(1);
      $year = $request->startdate;
      // dd( $year);
      $leave_takes  = LeaveTake::groupBy()->whereYear('startdate', $year)->get()->unique(['user_id']);
      foreach($leave_takes as $key => $leave_take)
      {
        $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
        $leave_takes[$key]['annual_leave'] = User::select('annual_leave')->where('id',$leave_take->user_id)->first()->annual_leave;
        $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
        $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
        $leave_takes[$key]['annual_leave'] = User::select('annual_leave')->where('id',$leave_take->user_id)->first()->annual_leave;
      }
      return view('ione.eleave.reports.byTotalLeave',compact('leave_takes','year'));
    }
    function viewAllUser()
    {
      // check userpermissio
      // $this->CheckPermission(1);

      $users = User::orderBy('username')->get();
      // $users = User::with('leavetake')->get();
    //  dd($data);
      foreach($users as $key => $user)
      {
          $users[$key]['department'] = $user->department->department;
          $users[$key]['position'] = $user->position->position;
          $users[$key]['role'] = $user->role->role;
      }
      return view('ione.eleave.reports.viewAllUser',compact('users'));
    }
    function viewUserLeave($id)
    {
      // check userpermissio
      // Controller;

      // $LeaveTake = LeaveTake::where('user_id',$id)->get();
      $unpaids = LeaveTake::has('leave_numberic')->whereYear('startdate', date('Y'))->where('leave_type_id',2)->where('user_id',$id)->get();
      foreach(  $unpaids as $key =>  $unpaid)
      {
          $unpaids [$key]['number_day'] = $unpaid->leave_numberic->number_day;
      }
      $leave_muberics = LeaveTake::has('leave_numberic')->whereYear('startdate', date('Y'))->where('leave_type_id',1)->where('user_id',$id)->get();

      foreach( $leave_muberics as $key => $leave_muberic)
      {
          $leave_muberics[$key]['number_day'] = $leave_muberic->leave_numberic->number_day;
      }
      $LeaveTake = LeaveTake::whereYear('startdate', date('Y'))->where('user_id',$id)->latest()->first();

      if($LeaveTake ){
        $LeaveTake ['number_day'] = $LeaveTake->leave_numberic->number_day;
      }
       $users = User::find($id);

      return response()->json([ $LeaveTake,$leave_muberics,$unpaids,$users]);

    }
    
}
