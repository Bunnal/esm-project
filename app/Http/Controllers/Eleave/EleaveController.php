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
Use App\Models\User\UserMenu;
Use App\Models\User\Menu;
use App\Http\Controllers\CheckPermissionController;
use DB;
use Carbon\Carbon;

class EleaveController extends Controller
{
    public function index()
    {
        // check userpermissio
        // $this->CheckPermission(1);
        $countToday = LeaveTake::whereDate('startdate', Carbon::today())->get()->count();
        // $countToday  = LeaveTake::whereDay('startdate', date('dd'))->get()->count();
        $date = new \DateTime();
        $date->modify('-4 DAY');
        $formatted_date = $date->format('Y-m-d');
        $countWeekly  = LeaveTake::whereDate('startdate','>',  $formatted_date)->get()->count();
        $countMonthly= LeaveTake::whereMonth('startdate',date('m'))->get()->count();
        $countPanding = LeaveTake::where('sup_approval','pending')->orwhere('hod_approval','pending')->orwhere('hoj_approval','pending')->get()->count();
        $leaveDept = LeaveTake::all();
        foreach($leaveDept  as $key => $value)
        {
            $leaveDept [$key]['department'] = UserDepartment::select('department')->where('id',$value->user_department_id)->first()->department;
         
        }
        $countSPS = LeaveTake::where('user_department_id',1)->whereYear('startdate',date('Y'))->get()->count();
        $countDistribution = LeaveTake::where('user_department_id',2)->whereYear('startdate',date('Y'))->get()->count();
        $countAccount= LeaveTake::where('user_department_id',3)->whereYear('startdate',date('Y'))->get()->count();
        $countEcommerce = LeaveTake::where('user_department_id',4)->whereYear('startdate',date('Y'))->get()->count();
        $countAdminHRLogistics  = LeaveTake::where('user_department_id',5)->whereYear('startdate',date('Y'))->get()->count();
        $countCloud  = LeaveTake::where('user_department_id',6)->whereYear('startdate',date('Y'))->get()->count();
        $countBuildingLeasing = LeaveTake::where('user_department_id',7)->whereYear('startdate',date('Y'))->get()->count();
        $countRetail  = LeaveTake::where('user_department_id',8)->whereYear('startdate',date('Y'))->get()->count();
        $countOther  = LeaveTake::where('user_department_id',9)->whereYear('startdate',date('Y'))->get()->count();
        $dept = array('PSP','Distribution','Account','Ecommerce','Admin/HR/Logistics','Cloud','Building&Leasing','Retail','Other');
        $data  = array( $countSPS,$countDistribution,$countAccount,$countEcommerce,$countAdminHRLogistics,$countCloud,$countBuildingLeasing,$countRetail,$countOther );

        $countJan = LeaveTake::whereMonth('startdate',1)->whereYear('startdate',date('Y'))->get()->count();
        $countFeb = LeaveTake::whereMonth('startdate',2)->whereYear('startdate',date('Y'))->get()->count();
        $countMar = LeaveTake::whereMonth('startdate',3)->whereYear('startdate',date('Y'))->get()->count();
        $countApr = LeaveTake::whereMonth('startdate',4)->whereYear('startdate',date('Y'))->get()->count();
        $countMay = LeaveTake::whereMonth('startdate',5)->whereYear('startdate',date('Y'))->get()->count();
        $countJun = LeaveTake::whereMonth('startdate',6)->whereYear('startdate',date('Y'))->get()->count();
        $countJul = LeaveTake::whereMonth('startdate',7)->whereYear('startdate',date('Y'))->get()->count();
        $countAug = LeaveTake::whereMonth('startdate',8)->whereYear('startdate',date('Y'))->get()->count();
        $countSep = LeaveTake::whereMonth('startdate',19)->whereYear('startdate',date('Y'))->get()->count();
        $countOct = LeaveTake::whereMonth('startdate',10)->whereYear('startdate',date('Y'))->get()->count();
        $countNov = LeaveTake::whereMonth('startdate',11)->whereYear('startdate',date('Y'))->get()->count();
        $countDec = LeaveTake::whereMonth('startdate',12)->whereYear('startdate',date('Y'))->get()->count();
        $month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
        $value =array($countJan,$countFeb,$countMar,$countApr,$countMay,$countJun,$countJul,$countAug,$countSep,$countOct,$countNov,$countDec );
        //  dd($value);
        return view('eleave.index',['Depts' => $dept, 'Data' => $data,'Months' => $month,'Value' => $value],compact('countToday','countWeekly','countMonthly','countPanding','leaveDept'));
        
    }

    public function viewLeaveBy($viewleavetype)
    {
        $countToday = LeaveTake::whereDate('startdate', Carbon::today())->get();
        $date = new \DateTime();
        $date->modify('-4 DAY');
        $formatted_date = $date->format('Y-m-d');
        switch ($viewleavetype) {
            case 'day':
                $leave_takes = LeaveTake::whereDate('startdate', Carbon::today())->orderByDesc('id')->get(); 
                return $this->getDataToDisplay($leave_takes);
                break;
            case 'week':
                $leave_takes = LeaveTake::whereDate('startdate','>',  $formatted_date)->orderByDesc('id')->get(); 
                return $this->getDataToDisplay($leave_takes);
                break;
            case 'month':
                $leave_takes = LeaveTake::whereMonth('startdate',date('m'))->orderByDesc('id')->get(); 
                return $this->getDataToDisplay($leave_takes);
                break;
            default:
                return abort(404);
                break;
        }
    }

    public function getDataToDisplay($leave_takes)
    {
        $results = UserMenu::where('user_id',auth()->user()->id)->where('enable','1')->get()->unique('menu_id');
        foreach($results as $key => $result)
        {
            $results[$key]['name'] = Menu::select('name')->where('id',$result->menu_id)->first()->name;
            $results[$key]['link'] = Menu::select('link')->where('id',$result->menu_id)->first()->link;
        }  
        foreach($leave_takes as $key => $leave_take)
        {
          $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
          $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
          $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
          $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
          $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
            
       }
       return view('eleave.leaves.disleavebytype',compact('leave_takes','results'));
    }
}
