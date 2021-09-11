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
}
