<?php

namespace App\Http\Controllers\Eleave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\User\UserDepartment;
use App\Models\Eleave\LeaveDay;
use App\Models\Eleave\LeaveType;
use App\Models\Eleave\LeaveTake;
use App\Models\Eleave\LeaveNumberic;
use App\Http\Controllers\CheckPermissionController;
Use App\Models\User\Menu;
Use App\Models\User\UserMenu;


class LeaveDisapprovalController extends Controller
{
    public function index()
    {
 
      // check userpermissio
      // $this->CheckPermission(1);
      $results = UserMenu::where('user_id',auth()->user()->id)->where('enable','1')->get()->unique('menu_id');
            foreach($results as $key => $result)
            {
                $results[$key]['name'] = Menu::select('name')->where('id',$result->menu_id)->first()->name;
                $results[$key]['link'] = Menu::select('link')->where('id',$result->menu_id)->first()->link;
            }
      $leave_takes = LeaveTake::
                                where('sup_approval','pending')
                                ->orwhere('hod_approval','pending')
                                ->orwhere('hoj_approval','pending')
                                ->whereDate(Carbon::now(),'>=3','startdate')->orderByDesc('startdate')->get();  
    //  dd( $leave_takes);
     foreach($leave_takes as $key => $leave_take)
     {
       $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
       $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
       $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
       $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
       $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
         
     }
      return view('eleave.leavedisapprovals.index',compact('leave_takes','results'));
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
      //  $this->CheckPermission(1);
 
         $LeaveTake = LeaveTake::find($id);
         $LeaveTake ['department'] = $LeaveTake->department->department;
         $LeaveTake ['username'] = $LeaveTake->user->username;
         $LeaveTake ['gender'] = $LeaveTake->user->gender;
         $LeaveTake ['shift'] = $LeaveTake->leave_day->shift;
         $LeaveTake ['name'] = $LeaveTake->leave_type->name;
         $LeaveTake ['number_day'] = $LeaveTake->leave_numberic->number_day;
         return $LeaveTake ;
     }
     public function updateDisapproval(Request $request, $id)
     {
          // check userpermissio
          // $this->CheckPermission(1);
          $data = 'approved';
          $result = LeaveTake::where('id',$id)->update(['hod_approval' => $data,'hoj_approval' => $data,'sup_approval' => $data]);
         if($result){ 
             $arr = array('msg' => 'Approval Successfully!', 'hod_approval' => 'approved');
         }
           return response()->json( $arr);
          
     }
     public function destroy($id)
     {
         // check userpermissio
        //  $this->CheckPermission(1);
 
         LeaveTake::where('id',($id))->delete();
         return redirect('/leavedisapproval');
     }
}
