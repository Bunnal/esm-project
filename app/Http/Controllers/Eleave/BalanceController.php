<?php

namespace App\Http\Controllers\Ione\Eleave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User\User;
use App\Models\User\UserDepartment;
use App\Models\Eleave\LeaveDay;
use App\Models\Eleave\LeaveType;
use App\Models\Eleave\LeaveTake;
use App\Models\Eleave\LeaveNumberic;
use App\Http\Controllers\CheckPermissionController;
use Session; 


class BalanceController extends Controller
{
   
    public function index()
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $startdate ="";
        $unpaids = LeaveTake::has('leave_numberic')->whereYear('startdate', date('Y'))->where('leave_type_id',2)->where('user_id',auth()->id())->get();
        foreach(  $unpaids as $key =>  $unpaid)
        {
            $unpaids [$key]['number_day'] = $unpaid->leave_numberic->number_day;
        }
        $leave_muberics = LeaveTake::has('leave_numberic')->whereYear('startdate', date('Y'))->where('leave_type_id',1)->where('user_id',auth()->id())->get();
        foreach( $leave_muberics as $key => $leave_muberic)
        {
            $leave_muberics[$key]['number_day'] = $leave_muberic->leave_numberic->number_day;
        }

        $LeaveTake = LeaveTake::whereYear('startdate', date('Y'))->where('user_id',auth()->id())->latest()->first();
        if($LeaveTake != null){
            $LeaveTake ['department'] = $LeaveTake->department->department;
            $LeaveTake ['username'] = $LeaveTake->user->username;
            $LeaveTake ['employee_id'] = $LeaveTake->user->employee_id;
            $LeaveTake ['date_joined'] = $LeaveTake->user->date_joined;
            $LeaveTake ['annual_leave'] = $LeaveTake->user->annual_leave;
            $LeaveTake ['number_day'] = $LeaveTake->leave_numberic->number_day;
        }
        else
        {
            // Session::flash('flash_message', 'User successfully added!');
            return redirect()->route('leave')->with('modal_message_error', trans('messages.you_are_not_yet_to_take_leave'));
            // return redirect()->back();
        }
        return view('ione.eleave.balances.index',compact('LeaveTake','leave_muberics','unpaids','startdate'));
    }
    public function getOwnBalance(Request $request)
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $startdate = $request->startdate;
        $leave_muberics = LeaveTake::has('leave_numberic')->whereYear('startdate', $startdate)->where('leave_type_id',1)->where('user_id',auth()->id())->get();
        foreach( $leave_muberics as $key => $leave_muberic)
        {
            $leave_muberics[$key]['number_day'] = $leave_muberic->leave_numberic->number_day;
        }
        $unpaids = LeaveTake::has('leave_numberic')->whereYear('startdate',$startdate)->where('leave_type_id',3)->where('user_id',auth()->id())->get();
        foreach(  $unpaids as $key =>  $unpaid)
        {
            $unpaids [$key]['number_day'] = $unpaid->leave_numberic->number_day;
        }
        $LeaveTake = LeaveTake::whereYear('startdate', $startdate)->where('user_id',auth()->id())->latest()->first();
        if($LeaveTake != null )
        {
           
            $LeaveTake ['department'] = $LeaveTake->department->department;
            $LeaveTake ['user_department_id'] = $LeaveTake->user->user_department_id;
            $LeaveTake ['username'] = $LeaveTake->user->username;
            $LeaveTake ['employee_id'] = $LeaveTake->user->employee_id;
            $LeaveTake ['date_joined'] = $LeaveTake->user->date_joined;
            $LeaveTake ['annual_leave'] = $LeaveTake->user->annual_leave;
            $LeaveTake ['number_day'] = $LeaveTake->leave_numberic->number_day;
        }
        else
        {
            return redirect()->route('ownbalance')->with('modal_message_error', 'You never to take leave!');
        }
        return view('ione.eleave.balances.index',compact('LeaveTake','leave_muberics','unpaids','startdate'));
    }
    public function balanceByMonth()
    {

        $startdate ="";
        $enddate  ="";
        // $this->CheckPermission(1);
        $leave_takes =  LeaveTake::select("leave_takes.*")->whereBetween('startdate', [$startdate, $enddate])->where('user_id',auth()->id())->get();
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
           $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
        }
        return view('ione.eleave.balances.balance_by_month',compact('leave_takes','startdate','enddate'));

    }

    public function getBalanceByMonth(Request $request)
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $leave_takes = LeaveTake::select("leave_takes.*")->whereBetween('startdate', [$startdate, $enddate])->where('user_id',auth()->id())->get();
        // $leave_takes =  LeaveTake::whereBetween( 'startdate',[$startdate,$enddate])->whereYear('startdate', date('Y-m-d'))->where('user_id',auth()->id())->get();
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
          $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
        }
        return view('ione.eleave.balances.balance_by_month',compact('leave_takes','startdate','enddate'));
    }
    public function show($id)
   {
        // check userpermissio
        // $this->CheckPermission(1);

        $LeaveTake = $this->getAllUserFieldById($id);
        return response()->json($LeaveTake);
   }
   public function getAllUserFieldById($id)
    { 
        // check userpermissio
        // $this->CheckPermission(1);

        $LeaveTake = LeaveTake::find($id);
        $LeaveTake ['department'] = $LeaveTake->department->department;
        $LeaveTake ['username'] = $LeaveTake->user->username;
        $LeaveTake ['Sex'] = $LeaveTake->user->Sex;
        $LeaveTake ['shift'] = $LeaveTake->leave_day->shift;
        $LeaveTake ['name'] = $LeaveTake->leave_type->name;
        $LeaveTake ['number_day'] = $LeaveTake->leave_numberic->number_day;
        return $LeaveTake ;
    }
   
    

}
